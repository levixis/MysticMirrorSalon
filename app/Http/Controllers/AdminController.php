<?php

namespace App\Http\Controllers;

use App\Exports\RevenueExport;
use App\Mail\AppointmentApproved;
use App\Models\Appointment;
use App\Models\InstagramPost;
use App\Models\Receipt;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
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

        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['credentials' => 'Invalid credentials']);
    }

    public function dashboard(Request $request)
    {
        // Appointments
        $query = Appointment::with('service')->latest();

        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        $appointments = $query->get();
        $counts = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'approved' => Appointment::where('status', 'approved')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
        ];

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
            'appointments', 'counts',
            'todayRevenue', 'monthlyRevenue',
            'services', 'instagramPosts', 'recentReceipts'
        ));
    }

    // ---- Appointment Actions ----

    public function approve($id)
    {
        $appointment = Appointment::with('service')->findOrFail($id);
        $appointment->update(['status' => 'approved']);

        try {
            Mail::to($appointment->email)->send(new AppointmentApproved($appointment));
        } catch (\Exception $e) {
            \Log::error('Failed to send approval email: ' . $e->getMessage());
        }

        return back()->with('success', 'Appointment approved and email sent to customer!');
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled.');
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
        ]);

        $selectedServices = Service::whereIn('id', $request->service_ids)->get();
        $servicesData = $selectedServices->map(fn($s) => ['name' => $s->name, 'price' => $s->price])->toArray();
        $total = $selectedServices->sum('price');

        $receipt = Receipt::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'services' => $servicesData,
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
        ]);

        $maxOrder = InstagramPost::max('display_order') ?? 0;

        InstagramPost::create([
            'instagram_url' => $request->instagram_url,
            'display_order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Instagram reel added successfully!');
    }

    public function toggleInstagramPost($id)
    {
        $post = InstagramPost::findOrFail($id);
        $post->update(['is_visible' => !$post->is_visible]);

        $status = $post->is_visible ? 'visible' : 'hidden';
        return back()->with('success', "Instagram post is now {$status}.");
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
