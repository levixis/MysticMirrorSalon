<?php

namespace App\Http\Controllers;

use App\Mail\NewAppointmentNotification;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $appointment = Appointment::create($validated);

        // Send notification email to admin
        try {
            $appointment->load('service');
            $adminEmail = config('mail.admin_email', 'admin@mysticmirror.in');
            Mail::to($adminEmail)->send(new NewAppointmentNotification($appointment));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin notification: ' . $e->getMessage());
        }

        return redirect()->route('appointment.success');
    }

    public function success()
    {
        return view('appointments.success');
    }
}

