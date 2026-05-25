@extends('layouts.app')
@section('title', 'Contact Us - Mystic Mirror Salon')

@section('styles')
<style>
    .contact-hero {
        min-height: 40vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        background: var(--bg-primary);
        padding: 3rem 1rem;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: conic-gradient(from 0deg at 50% 50%, transparent 0%, rgba(212,168,67,0.03) 15%, transparent 30%);
        animation: rotate 30s linear infinite;
    }
    @keyframes rotate { to { transform: rotate(360deg); } }
    .contact-hero-content {
        position: relative;
        z-index: 2;
    }
    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        color: var(--gold-primary);
        margin-bottom: 0.5rem;
    }
    .contact-hero p {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        color: var(--text-secondary);
        font-size: 1.15rem;
    }

    .contact-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-top: 2rem;
    }

    .contact-form-card {
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-xl);
        padding: 3rem;
        backdrop-filter: blur(12px);
        position: relative;
        overflow: hidden;
    }
    .contact-form-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
    }
    .contact-form-card h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--gold-primary);
        margin-bottom: 0.5rem;
    }
    .contact-form-card .subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 2rem;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .btn-send {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
        color: var(--bg-primary);
        border: none;
        border-radius: var(--radius-sm);
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }
    .btn-send:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(212,168,76,0.35);
    }

    /* Info Side */
    .contact-info-side {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .info-card {
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-md);
        padding: 2rem;
        transition: var(--transition);
        backdrop-filter: blur(12px);
        position: relative;
        overflow: hidden;
    }
    .info-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(212,168,67,0.03), transparent 40%);
        pointer-events: none;
    }
    .info-card:hover {
        border-color: var(--border-gold-strong);
        transform: translateY(-4px);
        box-shadow: var(--shadow-gold);
    }
    .info-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.8rem;
    }
    .info-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(212,168,67,0.12), rgba(212,168,67,0.03));
        border: 1px solid var(--border-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gold-primary);
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .info-card h3 {
        font-family: 'Playfair Display', serif;
        color: var(--text-primary);
        font-size: 1.1rem;
    }
    .info-card p {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.8;
        padding-left: 3.8rem;
    }
    .info-card a {
        color: var(--gold-primary);
        text-decoration: none;
        transition: var(--transition-fast);
    }
    .info-card a:hover {
        color: var(--gold-light);
    }

    /* Map Embed */
    .map-card {
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 1px solid var(--border-gold);
        flex-grow: 1;
        min-height: 200px;
    }
    .map-card iframe {
        width: 100%;
        height: 100%;
        min-height: 200px;
        border: none;
        filter: grayscale(0.6) contrast(1.1) brightness(0.8);
        transition: filter 0.5s ease;
    }
    .map-card:hover iframe {
        filter: grayscale(0.2) contrast(1.05) brightness(0.9);
    }

    @media (max-width: 768px) {
        .contact-hero h1 { font-size: 2.5rem; }
        .contact-layout { grid-template-columns: 1fr; }
        .contact-form-card { padding: 2rem; }
        .form-row-2 { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<section class="contact-hero">
    <div class="contact-hero-content animate-fadeInUp">
        <h1>Get in Touch</h1>
        <p>We'd love to hear from you — reach out and let's make magic happen</p>
    </div>
</section>

<section class="section" style="padding-top: 1rem;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success animate-fadeInUp" style="max-width: 700px; margin: 0 auto 2rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="contact-layout">
            <!-- Form -->
            <div class="contact-form-card animate-fadeInUp delay-1">
                <h2><i class="fas fa-envelope" style="font-size: 0.9em;"></i> Send Us a Message</h2>
                <p class="subtitle">Fill the form below and we'll get back to you shortly</p>

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Your Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" class="form-control" placeholder="How can we help you? Tell us about the service you're interested in, ask questions, or just say hello..." required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn-send">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>

            <!-- Info Side -->
            <div class="contact-info-side">
                <div class="info-card animate-fadeInUp delay-2">
                    <div class="info-card-header">
                        <div class="info-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>Visit Our Salon</h3>
                    </div>
                    <p>
                        <a href="https://maps.app.goo.gl/mmkBSWgnhphKrmRt9" target="_blank">
                            1st Floor, SCO-1, Puda Complex,<br>
                            Ladowali Road, Jalandhar, 144001
                        </a>
                    </p>
                </div>

                <div class="info-card animate-fadeInUp delay-3">
                    <div class="info-card-header">
                        <div class="info-card-icon"><i class="fas fa-phone"></i></div>
                        <h3>Call Us</h3>
                    </div>
                    <p>
                        <a href="tel:7814748721" style="font-size: 1.2rem; font-weight: 600; font-family: 'Playfair Display', serif;">
                            7814748721
                        </a>
                    </p>
                </div>

                <div class="info-card animate-fadeInUp delay-4">
                    <div class="info-card-header">
                        <div class="info-card-icon"><i class="fas fa-clock"></i></div>
                        <h3>Working Hours</h3>
                    </div>
                    <p>Mon – Sun: 10:00 AM – 8:00 PM</p>
                </div>

                <div class="map-card animate-fadeInUp delay-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3408.123!2d75.576!3d31.326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDE5JzMzLjYiTiA3NcKwMzQnMzMuNiJF!5e0!3m2!1sen!2sin!4v1234567890"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
