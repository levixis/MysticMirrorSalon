<?php

namespace App\Http\Controllers;

use App\Exports\RevenueExport;
use App\Mail\AdminPasswordReset;
use App\Models\InstagramPost;
use App\Models\Receipt;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // ---- Password Helpers ----

    private function getAdminPasswordPath()
    {
        return storage_path('app/admin_password.json');
    }

    private function getStoredPassword()
    {
        $path = $this->getAdminPasswordPath();
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            return $data['password_hash'] ?? null;
        }
        return null;
    }

    private function savePassword(string $plainPassword)
    {
        $path = $this->getAdminPasswordPath();
        file_put_contents($path, json_encode([
            'password_hash' => Hash::make($plainPassword),
            'updated_at' => now()->toDateTimeString(),
        ]));
    }

    // ---- Auth ----

    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->username !== 'admin') {
            return back()->withErrors(['credentials' => 'Invalid credentials']);
        }

        $storedHash = $this->getStoredPassword();

        if ($storedHash) {
            // Check against stored hash
            if (Hash::check($request->password, $storedHash)) {
                session(['admin_logged_in' => true]);
                return redirect()->route('admin.dashboard');
            }
        } else {
            // Default password (first time)
            if ($request->password === 'admin123') {
                session(['admin_logged_in' => true]);
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors(['credentials' => 'Invalid credentials']);
    }

    // ---- Password Reset ----

    public function forgotPassword()
    {
        return view('admin.reset-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $adminEmail = config('mail.admin_email');

        if ($request->email !== $adminEmail) {
            return back()->withErrors(['email' => 'This email does not match the admin email on file.']);
        }

        // Generate token (valid for 30 min)
        $token = Str::random(64);
        cache()->put('admin_reset_token', $token, now()->addMinutes(30));

        $resetUrl = route('admin.password.reset', ['token' => $token]);

        if (empty(config('mail.mailers.smtp.password')) && config('mail.default') === 'smtp') {
            return back()->withErrors(['email' => 'Mail password is not configured on the server. Please use the default password (admin123) to login at /admin/login.']);
        }

        try {
            Mail::to($adminEmail)->send(new AdminPasswordReset($resetUrl));
        } catch (\Exception $e) {
            \Log::error('Failed to send reset email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'SMTP Error: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Password reset link sent to your email!');
    }

    public function resetPassword(Request $request, $token)
    {
        $storedToken = cache()->get('admin_reset_token');

        if (!$storedToken || $storedToken !== $token) {
            return redirect()->route('admin.password.forgot')
                ->withErrors(['token' => 'Invalid or expired reset link. Please request a new one.']);
        }

        return view('admin.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $storedToken = cache()->get('admin_reset_token');

        if (!$storedToken || $storedToken !== $request->token) {
            return redirect()->route('admin.password.forgot')
                ->withErrors(['token' => 'Invalid or expired reset link. Please request a new one.']);
        }

        $this->savePassword($request->password);
        cache()->forget('admin_reset_token');

        return redirect()->route('admin.login')
            ->with('success', 'Password updated successfully! Please login with your new password.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $storedHash = $this->getStoredPassword();
        
        // If there's a stored hash, verify current password
        if ($storedHash && !Hash::check($request->current_password, $storedHash)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        
        // If no stored hash, they must be using the default password 'admin123'
        if (!$storedHash && $request->current_password !== 'admin123') {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $this->savePassword($request->new_password);
        
        return back()->with('success', 'Password changed successfully!');
    }

    public function dashboard()
    {
        // Revenue
        $todayRevenue = Receipt::whereDate('created_at', today())->sum('total');
        $monthlyRevenue = Receipt::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Services
        $services = Service::orderBy('gender')->orderBy('name')->get();

        // Instagram Posts
        $instagramPosts = InstagramPost::orderBy('display_order')->latest()->get();

        // Recent receipts
        $recentReceipts = Receipt::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'todayRevenue', 'monthlyRevenue',
            'services', 'instagramPosts', 'recentReceipts'
        ));
    }

    // ---- Receipt / PDF ----

    public function createReceipt()
    {
        $services = Service::orderBy('gender')->orderBy('name')->get();
        return view('admin.receipt_create', compact('services'));
    }

    public function storeReceipt(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'service_ids' => 'required|array|min:1',
            'service_ids.*' => 'exists:services,id',
            'payment_method' => 'required|in:cash,upi,card',
            'discount_percent' => 'nullable|integer|min:0|max:100',
        ]);

        $selectedServices = Service::whereIn('id', $request->service_ids)->get();
        $servicesData = $selectedServices->map(fn($s) => ['name' => $s->name, 'price' => $s->price])->toArray();
        $subtotal = $selectedServices->sum('price');
        $discountPercent = $request->discount_percent ?? 0;
        $discountAmount = intval(round($subtotal * $discountPercent / 100));
        $total = $subtotal - $discountAmount;

        $receipt = Receipt::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'services' => $servicesData,
            'subtotal' => $subtotal,
            'discount_percent' => $discountPercent,
            'total' => $total,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('admin.receipt.pdf', $receipt->id)
            ->with('success', 'Receipt created! PDF is downloading.');
    }

    public function downloadReceipt($id)
    {
        $receipt = Receipt::findOrFail($id);
        $pdf = Pdf::loadView('admin.receipt_pdf', compact('receipt'));
        $filename = 'receipt_' . str_pad($receipt->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($filename);
    }

    // ---- Revenue Export ----

    public function exportRevenue($period)
    {
        if (!in_array($period, ['daily', 'monthly'])) {
            abort(404);
        }

        $filename = $period === 'daily'
            ? 'revenue_' . now()->format('Y-m-d') . '.xlsx'
            : 'revenue_' . now()->format('Y-m') . '.xlsx';

        return Excel::download(new RevenueExport($period), $filename);
    }

    // ---- Service CRUD ----

    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'gender' => 'required|in:men,women',
            'description' => 'nullable|string|max:500',
        ]);

        Service::create($request->only('name', 'price', 'gender', 'description'));

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'gender' => 'required|in:men,women',
            'description' => 'nullable|string|max:500',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->only('name', 'price', 'gender', 'description'));

        return back()->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service deleted successfully!');
    }

    // ---- Instagram Posts ----

    public function storeInstagramPost(Request $request)
    {
        $request->validate([
            'instagram_url' => 'required|url|max:500',
            'thumbnail_url' => 'nullable|url|max:500',
        ]);

        try {
            // Use manually provided thumbnail, or auto-scrape from Instagram
            $thumbnailUrl = $request->thumbnail_url;

            if (empty($thumbnailUrl)) {
                try {
                    $thumbnailUrl = $this->scrapeInstagramThumbnail($request->instagram_url);
                } catch (\Exception $e) {
                    Log::warning('Thumbnail scrape failed: ' . $e->getMessage());
                    $thumbnailUrl = null;
                }
            }

            $maxOrder = InstagramPost::max('display_order') ?? 0;

            InstagramPost::create([
                'instagram_url' => $request->instagram_url,
                'thumbnail_url' => $thumbnailUrl,
                'display_order' => $maxOrder + 1,
            ]);

            $msg = 'Instagram reel added successfully!';
            if ($thumbnailUrl) {
                $msg .= ' Thumbnail auto-fetched.';
            } else {
                $msg .= ' (No thumbnail found — you can add one manually later.)';
            }

            return back()->with('success', $msg);
        } catch (\Exception $e) {
            Log::error('Failed to store Instagram post: ' . $e->getMessage());
            return back()->withErrors(['instagram_url' => 'Failed to add reel: ' . $e->getMessage()]);
        }
    }

    /**
     * Attempt to scrape the og:image thumbnail from an Instagram URL.
     * Uses mobile User-Agent to get server-rendered og:image meta tag.
     * Returns null if scraping fails (graceful fallback).
     */
    private function scrapeInstagramThumbnail(string $url): ?string
    {
        // Strategy 1: Scrape og:image using mobile User-Agent
        // Instagram serves server-rendered meta tags to mobile browsers
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1',
                    'Accept' => 'text/html',
                    'Accept-Language' => 'en-US,en;q=0.5',
                ])
                ->get($url);

            if ($response->successful()) {
                $html = $response->body();

                // Look for og:image meta tag (property before content)
                if (preg_match('/<meta[^>]*property=["\']og:image["\'][^>]*content=["\']([^"\'>]+)["\'][^>]*>/i', $html, $matches)) {
                    return html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
                // Also try reverse order (content before property)
                if (preg_match('/<meta[^>]*content=["\']([^"\'>]+)["\'][^>]*property=["\']og:image["\'][^>]*>/i', $html, $matches)) {
                    return html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
            }
        } catch (\Exception $e) {
            Log::info('Instagram thumbnail scrape failed: ' . $e->getMessage());
        }

        // Strategy 2: Try Instagram oEmbed API as fallback
        try {
            $oembedUrl = 'https://api.instagram.com/oembed/?url=' . urlencode($url) . '&omitscript=true';
            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible)',
                ])
                ->get($oembedUrl);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['thumbnail_url'])) {
                    return $data['thumbnail_url'];
                }
            }
        } catch (\Exception $e) {
            Log::info('Instagram oEmbed failed: ' . $e->getMessage());
        }

        return null;
    }

    public function toggleInstagramPost($id)
    {
        $post = InstagramPost::findOrFail($id);
        $post->update(['is_visible' => !$post->is_visible]);

        $status = $post->is_visible ? 'visible' : 'hidden';
        return back()->with('success', "Instagram post is now {$status}.");
    }

    public function moveInstagramPost($id, $direction)
    {
        $post = InstagramPost::findOrFail($id);

        if ($direction === 'up') {
            // Find the post with the next lower display_order
            $swap = InstagramPost::where('display_order', '<', $post->display_order)
                ->orderBy('display_order', 'desc')
                ->first();
        } else {
            // Find the post with the next higher display_order
            $swap = InstagramPost::where('display_order', '>', $post->display_order)
                ->orderBy('display_order', 'asc')
                ->first();
        }

        if ($swap) {
            $tempOrder = $post->display_order;
            $post->update(['display_order' => $swap->display_order]);
            $swap->update(['display_order' => $tempOrder]);
        }

        return back()->with('success', 'Post reordered.');
    }

    public function deleteInstagramPost($id)
    {
        InstagramPost::findOrFail($id)->delete();
        return back()->with('success', 'Instagram post removed.');
    }

    // ---- Auth ----

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
