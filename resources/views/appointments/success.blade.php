@extends('layouts.app')
@section('title', 'Booking Confirmed - Mystic Mirror Salon')

@section('styles')
<style>
    .success-container {
        max-width: 550px;
        margin: 5rem auto;
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-gold);
    }
    .success-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(34, 197, 94, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: var(--success);
        animation: scaleIn 0.5s ease-out;
    }
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    .success-container h1 {
        font-family: 'Playfair Display', serif;
        color: var(--gold-primary);
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .success-container p {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 0.5rem;
    }
    .success-container .note {
        background: rgba(201,168,76,0.08);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-sm);
        padding: 1rem;
        margin: 1.5rem 0;
        font-size: 0.9rem;
        color: var(--gold-light);
    }
</style>
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="success-container animate-fadeInUp">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1>Booking Received! ✨</h1>
            <p>Thank you for choosing Mystic Mirror Salon.</p>
            <p>Your appointment request has been submitted successfully.</p>
            <div class="note">
                <i class="fas fa-info-circle"></i>
                Our team will review your appointment and send you a confirmation email once approved.
            </div>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="{{ route('home') }}" class="btn btn-outline">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="{{ route('appointment.create') }}" class="btn btn-gold">
                    <i class="fas fa-plus"></i> Book Another
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
