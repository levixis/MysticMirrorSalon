@extends('layouts.app')
@section('title', 'Book Appointment - Mystic Mirror Salon')

@section('styles')
<style>
    .page-header {
        padding: 4rem 0 2rem;
        text-align: center;
        background: linear-gradient(135deg, rgba(201,168,76,0.05), transparent);
        border-bottom: 1px solid var(--border-gold);
    }
    .page-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: var(--gold-primary);
        margin-bottom: 0.5rem;
    }
    .page-header p {
        color: var(--text-secondary);
        font-size: 1.1rem;
    }
    .booking-form {
        max-width: 600px;
        margin: 3rem auto;
        padding: 3rem;
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-card);
    }
    .booking-form h2 {
        font-family: 'Playfair Display', serif;
        color: var(--gold-primary);
        text-align: center;
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
    }
    .booking-form .subtitle {
        text-align: center;
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .service-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .service-option .price {
        color: var(--gold-primary);
        font-weight: 600;
    }
    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; }
        .booking-form { margin: 2rem 1rem; padding: 2rem 1.5rem; }
    }
</style>
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-calendar-check" style="margin-right: 0.5rem;"></i> Book Appointment</h1>
        <p>Schedule your visit at Mystic Mirror Salon</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form class="booking-form animate-fadeInUp" action="{{ route('appointment.store') }}" method="POST">
            @csrf
            <h2>✨ Reserve Your Slot</h2>
            <p class="subtitle">Fill in your details and we'll confirm your appointment</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="customer_name"><i class="fas fa-user text-gold"></i> Full Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name"
                    placeholder="Enter your full name" value="{{ old('customer_name') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope text-gold"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="your@email.com" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone text-gold"></i> Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Phone number" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="service_id"><i class="fas fa-cut text-gold"></i> Select Service</label>
                <select class="form-control" id="service_id" name="service_id" required>
                    <option value="">-- Choose a service --</option>
                    <optgroup label="👨 Men's Packages">
                        @foreach($services->where('gender', 'men') as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} — ₹{{ $service->price }}/-
                            </option>
                        @endforeach
                    </optgroup>
                    <optgroup label="👩 Women's Packages">
                        @foreach($services->where('gender', 'women') as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} — ₹{{ $service->price }}/-
                            </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="appointment_date"><i class="fas fa-calendar text-gold"></i> Preferred Date</label>
                    <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                        value="{{ old('appointment_date') }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="appointment_time"><i class="fas fa-clock text-gold"></i> Preferred Time</label>
                    <input type="time" class="form-control" id="appointment_time" name="appointment_time"
                        value="{{ old('appointment_time', '10:00') }}" min="10:00" max="20:00" required>
                </div>
            </div>

            <button type="submit" class="btn btn-gold" style="width: 100%; padding: 1rem; font-size: 1.05rem; margin-top: 0.5rem;">
                <i class="fas fa-check-circle"></i> Confirm Booking
            </button>
        </form>
    </div>
</section>
@endsection
