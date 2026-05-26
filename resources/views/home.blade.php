@extends('layouts.app')
@section('title', 'Mystic Mirror - Premium Unisex Salon by Arjeena')

@section('styles')
<style>
    /* === Hero Section === */
    .hero {
        min-height: 92vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        background: var(--bg-primary);
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: conic-gradient(from 0deg at 50% 50%, transparent 0%, rgba(212,168,67,0.03) 15%, transparent 30%, rgba(196,145,123,0.02) 45%, transparent 60%);
        animation: rotate 30s linear infinite;
    }
    .hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background:
            radial-gradient(ellipse 80% 60% at 50% 40%, rgba(212,168,67,0.06) 0%, transparent 60%),
            radial-gradient(ellipse 40% 40% at 20% 80%, rgba(196,145,123,0.04) 0%, transparent 50%),
            radial-gradient(ellipse 40% 40% at 80% 20%, rgba(212,168,67,0.03) 0%, transparent 50%);
    }
    @keyframes rotate {
        to { transform: rotate(360deg); }
    }
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 850px;
        padding: 2rem;
    }
    .hero-badge {
        display: inline-block;
        padding: 0.5rem 2rem;
        border: 1px solid var(--border-gold-strong);
        border-radius: 50px;
        color: var(--gold-primary);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 5px;
        text-transform: uppercase;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out;
        background: var(--gold-subtle);
        backdrop-filter: blur(10px);
    }
    .hero-title {
        font-family: 'Great Vibes', cursive;
        font-size: 6rem;
        color: var(--gold-primary);
        margin-bottom: 0.3rem;
        text-shadow: 0 0 60px rgba(212,168,67,0.2), 0 0 120px rgba(212,168,67,0.1);
        animation: fadeInUp 0.8s ease-out;
        line-height: 1.1;
    }
    .hero-subtitle {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.4rem;
        color: var(--text-secondary);
        margin-bottom: 0.3rem;
        letter-spacing: 8px;
        text-transform: uppercase;
        animation: fadeInUp 1s ease-out;
        font-weight: 400;
    }
    .hero-tagline {
        font-family: 'Great Vibes', cursive;
        font-size: 1.5rem;
        color: var(--gold-light);
        margin-bottom: 2.5rem;
        animation: fadeInUp 1.1s ease-out;
        opacity: 0.8;
    }
    .hero-desc {
        color: var(--text-secondary);
        font-size: 1.05rem;
        margin-bottom: 3rem;
        line-height: 1.9;
        animation: fadeInUp 1.2s ease-out;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .hero-buttons {
        display: flex;
        gap: 1.2rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 1.4s ease-out;
    }
    .hero-discount {
        position: absolute;
        top: 7rem;
        right: 4rem;
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        animation: float 3s ease-in-out infinite;
        box-shadow: 0 8px 40px rgba(231, 76, 60, 0.3), inset 0 -2px 4px rgba(0,0,0,0.2);
        z-index: 3;
        border: 2px solid rgba(255,255,255,0.15);
    }
    .hero-discount .percent {
        font-size: 1.8rem;
        line-height: 1;
        font-family: 'Playfair Display', serif;
    }
    .hero-discount .off {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        opacity: 0.9;
    }

    /* === Ornamental Line beneath hero === */
    .hero-ornament {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 2rem 0;
        color: var(--gold-primary);
        opacity: 0.25;
        font-size: 0.6rem;
        letter-spacing: 4px;
    }
    .hero-ornament::before, .hero-ornament::after {
        content: '';
        width: 60px;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold-primary));
    }
    .hero-ornament::after {
        background: linear-gradient(90deg, var(--gold-primary), transparent);
    }

    /* === Features === */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
    }
    .feature-item {
        text-align: center;
        padding: 2.5rem 1rem;
        border-radius: var(--radius-md);
        border: 1px solid transparent;
        transition: var(--transition);
        position: relative;
    }
    .feature-item:hover {
        border-color: var(--border-gold);
        background: var(--gold-subtle);
    }
    .feature-item .feature-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(212,168,67,0.12), rgba(212,168,67,0.03));
        border: 1px solid var(--border-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        color: var(--gold-primary);
        font-size: 1.2rem;
        transition: var(--transition);
    }
    .feature-item:hover .feature-icon-wrap {
        background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
        color: var(--bg-primary);
        box-shadow: 0 0 30px rgba(212,168,67,0.2);
    }
    .feature-item h4 {
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.4rem;
        font-size: 1rem;
        letter-spacing: 0.3px;
    }
    .feature-item p {
        color: var(--text-muted);
        font-size: 0.8rem;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
    }

    /* === Gender Cards === */
    .gender-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
        margin-top: 2rem;
    }
    .gender-card {
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-xl);
        padding: 3rem 2.5rem;
        text-align: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
    }
    .gender-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
    }
    .gender-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(180deg, rgba(212,168,67,0.03) 0%, transparent 30%);
        pointer-events: none;
    }
    .gender-card:hover {
        transform: translateY(-8px);
        border-color: var(--border-gold-strong);
        box-shadow: var(--shadow-elevated);
    }
    .gender-card .icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(212,168,67,0.1), rgba(212,168,67,0.02));
        border: 1px solid var(--border-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-size: 1.8rem;
        color: var(--gold-primary);
    }
    .gender-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: var(--text-primary);
        margin-bottom: 0.3rem;
        letter-spacing: 0.5px;
    }
    .gender-card .card-subtitle {
        color: var(--text-muted);
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    .gender-card .price-range {
        font-size: 0.85rem;
        color: var(--gold-light);
        font-weight: 600;
        margin-bottom: 1.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .service-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.85rem 0;
        border-bottom: 1px solid rgba(212,168,67,0.08);
        transition: var(--transition-fast);
    }
    .service-row:hover {
        padding-left: 0.5rem;
    }
    .service-row:last-of-type {
        border-bottom: none;
    }
    .service-row .service-name {
        color: var(--text-secondary);
        font-size: 0.88rem;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .service-row .check-icon {
        color: var(--success);
        font-size: 0.7rem;
        opacity: 0.8;
    }
    .service-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--gold-primary);
        white-space: nowrap;
        font-family: 'Playfair Display', serif;
    }

    /* === CTA Section === */
    .cta-section {
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-xl);
        padding: 5rem 3rem;
        text-align: center;
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background:
            radial-gradient(ellipse at 50% 0%, rgba(212,168,67,0.06) 0%, transparent 60%);
        pointer-events: none;
    }
    .cta-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--gold-primary);
        margin-bottom: 0.8rem;
        position: relative;
    }
    .cta-section p {
        color: var(--text-secondary);
        margin-bottom: 2.5rem;
        font-size: 1.1rem;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        position: relative;
    }

    /* === Contact Cards === */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }
    .contact-card {
        text-align: center;
        padding: 2.5rem 1.5rem;
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-md);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
    }
    .contact-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(212,168,67,0.03), transparent 40%);
        pointer-events: none;
    }
    .contact-card:hover {
        border-color: var(--border-gold-strong);
        transform: translateY(-5px);
        box-shadow: var(--shadow-gold);
    }
    .contact-card .contact-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(212,168,67,0.12), rgba(212,168,67,0.03));
        border: 1px solid var(--border-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        color: var(--gold-primary);
        font-size: 1.1rem;
    }
    .contact-card h4 {
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.6rem;
        font-size: 1.05rem;
        color: var(--text-primary);
    }
    .contact-card p {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    /* === Instagram Gallery (Custom Beautiful Design) === */
    .ig-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        max-width: 1100px;
        margin: 0 auto;
    }
    .ig-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(212,168,67,0.15);
        background: linear-gradient(145deg, #111 0%, #0a0a0a 100%);
        transition: all 0.5s cubic-bezier(0.25, 0.1, 0.25, 1);
        cursor: pointer;
        aspect-ratio: 9/16;
        max-height: 480px;
    }
    .ig-card:hover {
        border-color: rgba(212,168,67,0.5);
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 60px rgba(212,168,67,0.15), 0 0 40px rgba(212,168,67,0.05);
    }
    .ig-card-thumbnail {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.6s ease;
    }
    .ig-card:hover .ig-card-thumbnail {
        transform: scale(1.08);
    }
    .ig-card-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(
            180deg,
            rgba(0,0,0,0.1) 0%,
            rgba(0,0,0,0.05) 40%,
            rgba(0,0,0,0.4) 70%,
            rgba(0,0,0,0.85) 100%
        );
        z-index: 1;
        transition: background 0.4s ease;
    }
    .ig-card:hover .ig-card-overlay {
        background: linear-gradient(
            180deg,
            rgba(0,0,0,0.05) 0%,
            rgba(0,0,0,0.0) 40%,
            rgba(0,0,0,0.3) 70%,
            rgba(0,0,0,0.75) 100%
        );
    }
    .ig-card-play {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 64px; height: 64px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: all 0.4s ease;
    }
    .ig-card-play i {
        color: white;
        font-size: 1.5rem;
        margin-left: 4px;
    }
    .ig-card:hover .ig-card-play {
        background: rgba(212,168,67,0.85);
        border-color: var(--gold-primary);
        transform: translate(-50%, -50%) scale(1.15);
        box-shadow: 0 0 30px rgba(212,168,67,0.4);
    }
    .ig-card:hover .ig-card-play i {
        color: #050505;
    }
    .ig-card-info {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1.5rem;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .ig-card-profile {
        display: flex;
        align-items: center;
        gap: 0.7rem;
    }
    .ig-card-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: white;
        font-weight: 700;
        padding: 2px;
    }
    .ig-card-avatar-inner {
        width: 100%; height: 100%;
        border-radius: 50%;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Great Vibes', cursive;
        font-size: 0.9rem;
        color: var(--gold-primary);
    }
    .ig-card-handle {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.9);
        font-weight: 500;
    }
    .ig-card-badge {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.8rem;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        border: 1px solid rgba(255,255,255,0.15);
        transition: all 0.3s ease;
    }
    .ig-card:hover .ig-card-badge {
        background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        border-color: transparent;
    }
    .ig-card-badge i {
        font-size: 0.75rem;
        color: white;
    }
    .ig-card-badge span {
        font-size: 0.7rem;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .ig-card-top {
        position: absolute;
        top: 1rem; right: 1rem;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .ig-reel-tag {
        padding: 0.3rem 0.7rem;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(8px);
        border-radius: 6px;
        font-size: 0.65rem;
        color: rgba(255,255,255,0.8);
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .ig-reel-tag i {
        font-size: 0.6rem;
    }
    .ig-follow-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 2.5rem;
        background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.4s ease;
        box-shadow: 0 4px 20px rgba(225, 48, 108, 0.25);
    }
    .ig-follow-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 32px rgba(225, 48, 108, 0.4);
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 3.5rem; }
        .hero-subtitle { font-size: 1rem; letter-spacing: 4px; }
        .hero-discount { top: 5rem; right: 1rem; width: 85px; height: 85px; }
        .hero-discount .percent { font-size: 1.4rem; }
        .gender-section { grid-template-columns: 1fr; }
        .cta-section { padding: 3rem 1.5rem; }
        .cta-section h2 { font-size: 1.8rem; }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-discount">
        <span class="percent">20%</span>
        <span class="off">Discount</span>
    </div>
    <div class="hero-content">
        <div class="hero-badge">✦ &nbsp; Premium Grooming Experience &nbsp; ✦</div>
        <h1 class="hero-title">Mystic Mirror</h1>
        <p class="hero-subtitle">Unisex Salon</p>
        <p class="hero-tagline">— by Arjeena —</p>
        <p class="hero-desc">
            Experience the art of grooming at Jalandhar's most exclusive unisex salon.
            From classic haircuts to luxury facials — we bring out your finest look.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('contact') }}" class="btn btn-gold">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
            <a href="#services" class="btn btn-outline">
                <i class="fas fa-scissors"></i> Our Services
            </a>
        </div>
    </div>
</section>

<!-- Services Icons -->
<div class="hero-ornament">✦ &nbsp; ALL SERVICES AVAILABLE &nbsp; ✦</div>

<section class="section" style="padding-top: 1rem; padding-bottom: 3rem;">
    <div class="container">
        <div class="features-grid animate-fadeInUp">
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-cut"></i></div>
                <h4>Haircuts</h4>
                <p>Precision styling for every look</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-magic"></i></div>
                <h4>Hair Styling</h4>
                <p>Trending styles & textures</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-user-tie"></i></div>
                <h4>Shaving</h4>
                <p>Classic & modern grooming</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-spa"></i></div>
                <h4>Facials</h4>
                <p>Professional skincare therapy</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-palette"></i></div>
                <h4>Hair Coloring</h4>
                <p>Vibrant colors & highlights</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon-wrap"><i class="fas fa-paint-brush"></i></div>
                <h4>Makeup</h4>
                <p>Bridal & party looks</p>
            </div>
        </div>
    </div>
</section>

<!-- Services by Gender -->
<section id="services" class="section" style="padding-top: 2rem;">
    <div class="container">
        <div class="section-title">
            <h2>Our Packages</h2>
            <div class="divider"></div>
            <p>Premium grooming packages, curated with care</p>
        </div>

        <div class="gender-section">
            <!-- Men's Card -->
            <div class="gender-card animate-fadeInUp delay-1">
                <div class="icon"><i class="fas fa-male"></i></div>
                <h3>Packages for Gents</h3>
                <p class="card-subtitle">Classic grooming with premium treatments</p>
                <div class="price-range">Starting from ₹449/-</div>
                @foreach($menServices->take(4) as $service)
                    <div class="service-row">
                        <span class="service-name">
                            <i class="fas fa-check-circle check-icon"></i>
                            {{ $service->name }}
                        </span>
                        <span class="service-price">₹{{ $service->price }}/-</span>
                    </div>
                @endforeach
                @if($menServices->count() > 4)
                    <div style="text-align: center; color: #888; font-size: 0.82rem; padding: 0.5rem 0 0; font-style: italic;">
                        + {{ $menServices->count() - 4 }} more services
                    </div>
                @endif
                <a href="{{ route('services.men') }}" class="btn btn-outline" style="margin-top: 1.5rem; width: 100%;">
                    View All Services <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                </a>
            </div>

            <!-- Women's Card -->
            <div class="gender-card animate-fadeInUp delay-2">
                <div class="icon"><i class="fas fa-female"></i></div>
                <h3>Packages for Ladies</h3>
                <p class="card-subtitle">Luxurious beauty & hair care treatments</p>
                <div class="price-range">Starting from ₹449/-</div>
                @foreach($womenServices->take(4) as $service)
                    <div class="service-row">
                        <span class="service-name">
                            <i class="fas fa-check-circle check-icon"></i>
                            {{ $service->name }}
                        </span>
                        <span class="service-price">₹{{ $service->price }}/-</span>
                    </div>
                @endforeach
                @if($womenServices->count() > 4)
                    <div style="text-align: center; color: #888; font-size: 0.82rem; padding: 0.5rem 0 0; font-style: italic;">
                        + {{ $womenServices->count() - 4 }} more services
                    </div>
                @endif
                <a href="{{ route('services.women') }}" class="btn btn-outline" style="margin-top: 1.5rem; width: 100%;">
                    View All Services <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div class="cta-section animate-fadeInUp">
            <h2>Ready for a Fresh Look?</h2>
            <p>Get in touch with us and experience the Mystic Mirror difference</p>
            <a href="{{ route('contact') }}" class="btn btn-gold" style="padding: 1rem 3rem; font-size: 0.95rem; position: relative;">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Instagram Reels Gallery -->
@if(isset($instagramPosts) && $instagramPosts->count() > 0)
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div class="section-title">
            <h2><i class="fab fa-instagram" style="font-size: 0.8em;"></i> Follow Our Work</h2>
            <div class="divider"></div>
            <p>See our latest transformations and styles on Instagram</p>
        </div>
        <div class="ig-gallery">
            @foreach($instagramPosts as $index => $post)
                <a href="{{ $post->instagram_url }}" target="_blank" rel="noopener noreferrer" class="ig-card animate-fadeInUp delay-{{ $index + 1 }}" style="text-decoration: none;">
                    <div class="ig-card-thumbnail" style="background-image: url('{{ $post->thumbnail_url ?? '' }}'); background-color: #1a1a1a;"></div>
                    <div class="ig-card-overlay"></div>
                    <div class="ig-card-top">
                        <div class="ig-reel-tag">
                            <i class="fas fa-film"></i> Reel
                        </div>
                    </div>
                    <div class="ig-card-play">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="ig-card-info">
                        <div class="ig-card-profile">
                            <div class="ig-card-avatar">
                                <div class="ig-card-avatar-inner">M</div>
                            </div>
                            <span class="ig-card-handle">mystic.mirror_unisex.salon</span>
                        </div>
                        <div class="ig-card-badge">
                            <i class="fab fa-instagram"></i>
                            <span>View</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 2.5rem;">
            <a href="https://www.instagram.com/mystic.mirror_unisex.salon/" target="_blank" rel="noopener noreferrer" class="ig-follow-btn">
                <i class="fab fa-instagram"></i> Follow Us on Instagram
            </a>
        </div>
    </div>
</section>
@endif

<!-- Contact Info -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div class="section-title">
            <h2>Visit Us</h2>
            <div class="divider"></div>
        </div>
        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h4>Address</h4>
                <p>
                    <a href="https://maps.app.goo.gl/pnhrqVhWQ2rLqNRL7" target="_blank" style="color: var(--text-secondary); text-decoration: none; transition: var(--transition-fast);">
                        1st Floor, SCO-1, Puda Complex,<br>
                        Ladowali Road, Jalandhar, 144001
                    </a>
                </p>
            </div>
            <div class="contact-card">
                <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                <h4>WhatsApp Us</h4>
                <p>
                    <a href="https://wa.me/917814748721" target="_blank" rel="noopener noreferrer" style="color: var(--gold-primary); text-decoration: none; font-size: 1.2rem; font-weight: 600; font-family: 'Playfair Display', serif;">7814748721</a>
                </p>
            </div>
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                <h4>Hours</h4>
                <p>Mon - Sun: 10:00 AM - 8:00 PM</p>
            </div>
        </div>
    </div>
</section>
@endsection
