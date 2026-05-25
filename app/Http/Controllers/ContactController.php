<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        try {
            $adminEmail = config('mail.admin_email', 'genzhelped@gmail.com');
            Mail::to($adminEmail)->send(new ContactFormSubmission($validated));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
            return back()->withInput()->withErrors(['email' => 'Failed to send message. Please try again later.']);
        }

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully! We\'ll get back to you soon.');
    }
}
