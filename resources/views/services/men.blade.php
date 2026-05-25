@extends('layouts.app')
@section('title', "Men's Packages - Mystic Mirror Salon")

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
    .packages-list {
        max-width: 700px;
        margin: 3rem auto;
    }
    .package-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-gold);
        border-radius: var(--radius-md);
        margin-bottom: 1rem;
        transition: var(--transition);
    }
    .package-item:hover {
        background: var(--bg-card-hover);
        border-color: var(--gold-primary);
        transform: translateX(8px);
        box-shadow: var(--shadow-gold);
    }
    .package-info {
        flex: 1;
    }
    .package-info h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        color: var(--text-primary);
        margin-bottom: 0.3rem;
    }
    .package-info p {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }
    .package-check {
        color: var(--success);
        margin-right: 1rem;
        font-size: 1.1rem;
    }
    .package-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gold-primary);
        white-space: nowrap;
    }
    .book-cta {
        text-align: center;
        margin-top: 3rem;
    }
</style>
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <h1><i class="fas fa-male" style="margin-right: 0.5rem;"></i> Packages for Gents</h1>
        <p>Premium grooming packages crafted for the modern gentleman</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="packages-list">
            @foreach($services as $index => $service)
                <div class="package-item animate-fadeInUp delay-{{ $index + 1 }}">
                    <span class="package-check"><i class="fas fa-check-circle"></i></span>
                    <div class="package-info">
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                    <span class="package-price">₹{{ $service->price }}/-</span>
                </div>
            @endforeach
        </div>

        <div class="book-cta">
            <p style="color: var(--text-secondary); margin-bottom: 1rem; font-size: 1.1rem;">
                Love what you see? Book your appointment now!
            </p>
            <a href="{{ route('contact') }}" class="btn btn-gold" style="padding: 1rem 3rem;">
                <i class="fas fa-calendar-check"></i> Book Appointment
            </a>
        </div>
    </div>
</section>
@endsection
