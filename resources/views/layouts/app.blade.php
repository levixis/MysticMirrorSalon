<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mystic Mirror Unisex Salon by Arjeena - Premium grooming services for men and women in Jalandhar. Visit us today!">
    <title>@yield('title', 'Mystic Mirror Salon')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&family=Inter:wght@300;400;500;600;700&family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* === CSS Reset & Variables === */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-primary: #050505;
            --bg-secondary: #0c0c0c;
            --bg-card: rgba(18, 16, 12, 0.8);
            --bg-card-hover: rgba(28, 24, 16, 0.9);
            --bg-glass: rgba(18, 16, 12, 0.6);
            --gold-primary: #d4a843;
            --gold-light: #f0d87a;
            --gold-lighter: #f5e6a8;
            --gold-dark: #9e7b2a;
            --gold-glow: rgba(212, 168, 67, 0.35);
            --gold-subtle: rgba(212, 168, 67, 0.08);
            --rose-gold: #c4917b;
            --champagne: #f7e7ce;
            --text-primary: #f8f4ed;
            --text-secondary: #c2b89e;
            --text-muted: #5a5346;
            --border-gold: rgba(212, 168, 67, 0.18);
            --border-gold-strong: rgba(212, 168, 67, 0.4);
            --success: #34d399;
            --warning: #fbbf24;
            --danger: #f87171;
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --shadow-gold: 0 4px 40px rgba(212, 168, 67, 0.12), 0 0 80px rgba(212, 168, 67, 0.05);
            --shadow-card: 0 12px 48px rgba(0, 0, 0, 0.5), 0 2px 8px rgba(212, 168, 67, 0.05);
            --shadow-elevated: 0 20px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(212, 168, 67, 0.08);
            --transition: all 0.4s cubic-bezier(0.25, 0.1, 0.25, 1);
            --transition-fast: all 0.2s ease;
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* === Premium Background === */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse 60% 50% at 15% 45%, rgba(212, 168, 67, 0.04) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 85% 20%, rgba(196, 145, 123, 0.03) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 50% 90%, rgba(212, 168, 67, 0.02) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4a843' fill-opacity='0.015'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }

        /* === Navigation === */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(5, 5, 5, 0.85);
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            border-bottom: 1px solid var(--border-gold);
            padding: 0 2rem;
            transition: var(--transition);
        }
        .navbar::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 10%;
            width: 80%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            opacity: 0.4;
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 75px;
        }
        .navbar-brand {
            font-family: 'Great Vibes', cursive;
            font-size: 2.2rem;
            color: var(--gold-primary);
            text-decoration: none;
            text-shadow: 0 0 30px rgba(212, 168, 67, 0.25);
            transition: var(--transition);
        }
        .navbar-brand:hover {
            text-shadow: 0 0 40px rgba(212, 168, 67, 0.4);
        }
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            list-style: none;
        }
        .navbar-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            letter-spacing: 0.8px;
            text-transform: uppercase;
            font-family: 'Inter', sans-serif;
            position: relative;
        }
        .navbar-links a::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%; right: 50%;
            height: 1.5px;
            background: var(--gold-primary);
            transition: var(--transition);
            opacity: 0;
        }
        .navbar-links a:hover::after, .navbar-links a.active::after {
            left: 20%; right: 20%;
            opacity: 1;
        }
        .navbar-links a:hover, .navbar-links a.active {
            color: var(--gold-primary);
        }
        .btn-book-nav {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark)) !important;
            color: var(--bg-primary) !important;
            font-weight: 700 !important;
            padding: 0.6rem 1.6rem !important;
            letter-spacing: 1.5px !important;
            border-radius: var(--radius-sm) !important;
            box-shadow: 0 2px 12px rgba(212, 168, 67, 0.2);
        }
        .btn-book-nav::after { display: none !important; }
        .btn-book-nav:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 24px rgba(212, 168, 67, 0.35) !important;
        }

        /* Mobile Menu */
        .menu-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border-gold);
            color: var(--gold-primary);
            font-size: 1.2rem;
            cursor: pointer;
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }
        .menu-toggle:hover {
            background: var(--gold-subtle);
        }

        /* === Buttons === */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.85rem 2.2rem;
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn-gold {
            background: linear-gradient(135deg, var(--gold-primary) 0%, var(--gold-dark) 100%);
            color: var(--bg-primary);
            box-shadow: 0 4px 20px rgba(212, 168, 67, 0.2);
        }
        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(212, 168, 67, 0.35);
        }
        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border-gold-strong);
            color: var(--gold-primary);
            backdrop-filter: blur(10px);
        }
        .btn-outline:hover {
            background: var(--gold-subtle);
            border-color: var(--gold-primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(212, 168, 67, 0.1);
        }
        .btn-success { background: var(--success); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-sm { padding: 0.45rem 1.1rem; font-size: 0.8rem; }

        /* === Section Styling === */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }
        .section {
            padding: 6rem 0;
        }
        .section-title {
            text-align: center;
            margin-bottom: 3.5rem;
        }
        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--gold-primary);
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }
        .section-title p {
            color: var(--text-secondary);
            font-size: 1.05rem;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            letter-spacing: 0.5px;
        }
        .section-title .divider {
            width: 100px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            margin: 1.2rem auto;
            position: relative;
        }
        .section-title .divider::before {
            content: '✦';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--gold-primary);
            font-size: 0.6rem;
            background: var(--bg-primary);
            padding: 0 0.8rem;
        }

        /* === Cards === */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-md);
            padding: 2rem;
            transition: var(--transition);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(212, 168, 67, 0.03), transparent 40%);
            pointer-events: none;
        }
        .card:hover {
            background: var(--bg-card-hover);
            border-color: var(--border-gold-strong);
            transform: translateY(-6px);
            box-shadow: var(--shadow-gold);
        }

        /* === Footer === */
        .footer {
            background: linear-gradient(180deg, var(--bg-primary), var(--bg-secondary));
            border-top: 1px solid var(--border-gold);
            padding: 4rem 0 1.5rem;
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0; left: 20%; right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary), transparent);
            opacity: 0.5;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            margin-bottom: 2.5rem;
        }
        .footer-section h3 {
            font-family: 'Playfair Display', serif;
            color: var(--gold-primary);
            margin-bottom: 1.2rem;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
        }
        .footer-section p, .footer-section a {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.9;
            text-decoration: none;
            transition: var(--transition-fast);
        }
        .footer-section a:hover {
            color: var(--gold-primary);
            padding-left: 4px;
        }
        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(212, 168, 67, 0.1);
            color: var(--text-muted);
            font-size: 0.8rem;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
            letter-spacing: 1px;
        }
        .social-links {
            display: flex;
            gap: 0.8rem;
            margin-top: 0.8rem;
        }
        .social-links a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid var(--border-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-primary);
            transition: var(--transition);
            font-size: 0.9rem;
        }
        .social-links a:hover {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
            color: var(--bg-primary);
            border-color: var(--gold-primary);
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(212, 168, 67, 0.3);
            padding-left: 0 !important;
        }

        /* === Forms === */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .form-control {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: rgba(12, 12, 12, 0.8);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            backdrop-filter: blur(8px);
        }
        .form-control:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(212, 168, 67, 0.1), 0 0 20px rgba(212, 168, 67, 0.05);
        }
        .form-control::placeholder {
            color: var(--text-muted);
            font-style: italic;
        }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23d4a843' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            padding-right: 2.8rem;
        }
        .error-text {
            color: var(--danger);
            font-size: 0.82rem;
            margin-top: 0.4rem;
        }

        /* === Alerts === */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            backdrop-filter: blur(8px);
        }
        .alert-success {
            background: rgba(52, 211, 153, 0.08);
            border: 1px solid rgba(52, 211, 153, 0.25);
            color: var(--success);
        }
        .alert-danger {
            background: rgba(248, 113, 113, 0.08);
            border: 1px solid rgba(248, 113, 113, 0.25);
            color: var(--danger);
        }

        /* === Animations === */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 20px rgba(212, 168, 67, 0.1); }
            50% { box-shadow: 0 0 40px rgba(212, 168, 67, 0.2); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.9s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        .delay-5 { animation-delay: 0.5s; opacity: 0; }

        /* === Utilities === */
        .text-gold { color: var(--gold-primary); }
        .text-center { text-align: center; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-4 { margin-top: 1rem; }
        .mb-4 { margin-bottom: 1rem; }

        /* === Status Badges === */
        .badge {
            display: inline-block;
            padding: 0.3rem 0.85rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badge-pending {
            background: rgba(251, 191, 36, 0.1);
            color: var(--warning);
            border: 1px solid rgba(251, 191, 36, 0.25);
        }
        .badge-approved {
            background: rgba(52, 211, 153, 0.1);
            color: var(--success);
            border: 1px solid rgba(52, 211, 153, 0.25);
        }
        .badge-cancelled {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger);
            border: 1px solid rgba(248, 113, 113, 0.25);
        }

        /* === Premium Gold Ornament Dividers === */
        .ornament {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            color: var(--gold-primary);
            opacity: 0.4;
            font-size: 0.7rem;
            letter-spacing: 3px;
        }
        .ornament::before, .ornament::after {
            content: '';
            flex: 1;
            max-width: 100px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-primary));
        }
        .ornament::after {
            background: linear-gradient(90deg, var(--gold-primary), transparent);
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            .menu-toggle { display: flex; align-items: center; justify-content: center; }
            .navbar-links {
                position: fixed;
                top: 75px;
                left: 0;
                right: 0;
                background: rgba(5, 5, 5, 0.98);
                backdrop-filter: blur(30px);
                flex-direction: column;
                padding: 1rem;
                gap: 0.25rem;
                transform: translateY(-120%);
                transition: var(--transition);
                border-bottom: 1px solid var(--border-gold);
            }
            .navbar-links.active {
                transform: translateY(0);
            }
            .navbar-links a {
                width: 100%;
                text-align: center;
                padding: 0.8rem;
            }
            .navbar-links a::after { display: none; }
            .section-title h2 { font-size: 2.2rem; }
            .container { padding: 0 1.2rem; }
            .section { padding: 4rem 0; }
        }

        /* === Scrollbar === */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--gold-dark), var(--gold-primary));
            border-radius: 3px;
        }

        /* === Selection === */
        ::selection {
            background: rgba(212, 168, 67, 0.3);
            color: var(--text-primary);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">Mystic Mirror</a>
            <button class="menu-toggle" onclick="document.querySelector('.navbar-links').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('services.men') }}" class="{{ request()->routeIs('services.men') ? 'active' : '' }}">Men</a></li>
                <li><a href="{{ route('services.women') }}" class="{{ request()->routeIs('services.women') ? 'active' : '' }}">Women</a></li>
                <li><a href="{{ route('contact') }}" class="btn-book-nav">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 75px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3 style="font-family: 'Great Vibes', cursive; font-size: 2rem;">Mystic Mirror</h3>
                <p style="font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1rem;">
                    Premium unisex salon offering the finest grooming experience in Jalandhar. Where style meets elegance.
                </p>
                <div class="social-links">
                    <a href="https://www.instagram.com/mystic.mirror_unisex.salon/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61574437286498" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/917814748721" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <p><a href="{{ route('services.men') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Men's Services</a></p>
                <p><a href="{{ route('services.women') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Women's Services</a></p>
                <p><a href="{{ route('contact') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Contact Us</a></p>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p style="margin-bottom: 0.5rem;">
                    <a href="https://maps.app.goo.gl/pnhrqVhWQ2rLqNRL7" target="_blank" style="color: var(--text-secondary); text-decoration: none;">
                        <i class="fas fa-map-marker-alt text-gold" style="width: 16px;"></i>
                        1st Floor, SCO-1, Puda Complex,<br>
                        <span style="padding-left: 20px;">Ladowali Road, Jalandhar, 144001</span>
                    </a>
                </p>
                <p><i class="fab fa-whatsapp text-gold" style="width: 16px;"></i> <a href="https://wa.me/917814748721" target="_blank" rel="noopener noreferrer" style="color: var(--gold-primary); font-weight: 500;">7814748721</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Mystic Mirror Salon. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
