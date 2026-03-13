<!DOCTYPE html>
<html lang="ku" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ' GARDI BAZAR - Gardi Bazar')</title>
    <meta name="description"
        content="@yield('description', 'گەردى بازاڕ بازاڕ - باشترین شوێن بۆ کڕینی گۆشتی تازە بە نرخی گونجاو')">
    @yield('og_tags')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#1a1a1a">
    <style>
        :root {
            --dark: #0f0f0f;
            --dark2: #1a1a1a;
            --dark3: #222;
            --red: #8B0000;
            --red2: #C41E3A;
            --gold: #D4A745;
            --gold2: #B8860B;
            --text: #e0e0e0;
            --text2: #aaa;
        }

        * {
            font-family: 'Noto Sans Arabic', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--dark);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        /* Navbar */
        .main-nav {
            background: rgba(15, 15, 15, 0.97);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 167, 69, 0.12);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-brand img {
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--gold);
        }

        .nav-brand h5 {
            color: var(--gold);
            font-weight: 800;
            margin: 0;
            font-size: 1.2rem;
        }

        .nav-brand small {
            color: var(--text2);
            font-size: 0.7rem;
            display: block;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-links a {
            color: var(--text2);
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--gold);
            background: rgba(212, 167, 69, 0.08);
        }

        .cart-badge {
            background: var(--red2);
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            top: -8px;
            right: -4px;
        }

        /* Hero Slider */
        .hero-slider {
            position: relative;
            overflow: hidden;
            border-radius: 0 0 24px 24px;
        }

        .hero-slide {
            height: 500px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            position: relative;
        }

        .hero-slide::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.2) 60%, rgba(0, 0, 0, 0.1) 100%);
        }

        .hero-slide .caption {
            position: relative;
            z-index: 2;
            padding: 40px;
            width: 100%;
        }

        .hero-slide .caption h2 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Product Card */
        .product-card {
            background: linear-gradient(145deg, var(--dark2), var(--dark3));
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 167, 69, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .product-card .card-img {
            height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .product-card .card-img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 26, 26, 0.6) 0%, transparent 50%);
        }

        .product-card .card-body {
            padding: 20px;
        }

        .product-card .card-body h5 {
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 6px;
        }

        .product-card .card-body .cat-name {
            color: var(--gold);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .product-card .card-body .price {
            color: var(--gold);
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-top: 8px;
        }

        .product-card .card-body .price small {
            font-size: 0.7rem;
            color: var(--text2);
            font-weight: 400;
        }

        .product-card .card-actions {
            padding: 0 20px 20px;
        }

        .featured-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
            background: var(--red2);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Category Card */
        .cat-card {
            background: linear-gradient(145deg, var(--dark2), var(--dark3));
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s;
            display: block;
        }

        .cat-card:hover {
            transform: translateY(-4px);
            border-color: rgba(212, 167, 69, 0.2);
        }

        .cat-card .icon {
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 12px;
        }

        .cat-card h6 {
            color: #fff;
            font-weight: 600;
            margin: 0;
        }

        /* Section titles */
        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .section-title h2 {
            color: #fff;
            font-weight: 800;
            font-size: 1.6rem;
            margin: 0;
        }

        .section-title .line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to left, transparent, rgba(212, 167, 69, 0.3));
        }

        /* Buttons */
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            color: #000;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            transition: all 0.3s;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 167, 69, 0.3);
            color: #000;
        }

        .btn-red {
            background: linear-gradient(135deg, var(--red2), var(--red));
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
        }

        .btn-red:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(196, 30, 58, 0.3);
        }

        .btn-outline-gold {
            border: 1px solid var(--gold);
            color: var(--gold);
            border-radius: 12px;
            padding: 10px 24px;
            transition: all 0.3s;
            background: transparent;
        }

        .btn-outline-gold:hover {
            background: var(--gold);
            color: #000;
        }

        /* Footer */
        .main-footer {
            background: linear-gradient(180deg, var(--dark2), #111);
            border-top: 1px solid rgba(212, 167, 69, 0.1);
            padding: 48px 0 24px;
            margin-top: 80px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .footer-logo img {
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--gold);
        }

        .footer-logo h5 {
            color: var(--gold);
            font-weight: 800;
            margin: 0;
        }

        .footer-links a {
            color: var(--text2);
            display: block;
            padding: 4px 0;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .social-links a {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text2);
            transition: all 0.3s;
            margin-left: 8px;
            font-size: 1.1rem;
        }

        .social-links a:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(212, 167, 69, 0.08);
        }

        /* Cart */
        .cart-table {
            color: var(--text);
        }

        .cart-table th {
            color: var(--gold);
            border-color: rgba(255, 255, 255, 0.06);
        }

        .cart-table td {
            border-color: rgba(255, 255, 255, 0.04);
            vertical-align: middle;
        }

        .form-control-dark {
            background: var(--dark2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text);
            border-radius: 10px;
        }

        .form-control-dark::placeholder {
            color: #666 !important;
            opacity: 1;
        }

        .form-control-dark:focus {
            background: var(--dark3);
            border-color: var(--gold);
            color: var(--text);
            box-shadow: 0 0 0 0.2rem rgba(212, 167, 69, 0.15);
        }

        .form-label {
            color: #ccc !important;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        /* Glassmorphism box */
        .glass-box {
            background: rgba(26, 26, 26, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 32px;
        }

        /* Status badges */
        .status-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-confirmed {
            background: rgba(0, 123, 255, 0.15);
            color: #007bff;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-delivering {
            background: rgba(138, 43, 226, 0.15);
            color: #8a2be2;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-delivered {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-cancelled {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-slide {
                height: 300px;
            }

            .hero-slide .caption h2 {
                font-size: 1.5rem;
            }

            .nav-links {
                gap: 2px;
            }

            .nav-links a {
                padding: 6px 10px;
                font-size: 0.8rem;
            }

            .product-card .card-img {
                height: 160px;
            }
        }

        /* Mobile bottom nav */
        .mobile-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            background: rgba(15, 15, 15, 0.97);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(212, 167, 69, 0.12);
            padding: 8px 0;
        }

        .mobile-nav a {
            color: var(--text2);
            text-align: center;
            font-size: 0.7rem;
            padding: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            transition: color 0.3s;
        }

        .mobile-nav a.active,
        .mobile-nav a:hover {
            color: var(--gold);
        }

        .mobile-nav a i {
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .mobile-nav {
                display: flex;
                justify-content: space-around;
            }

            .main-nav .nav-links {
                display: none;
            }

            body {
                padding-bottom: 70px;
            }
        }

        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>

<body>
    @php $cartCount = count(session('cart', [])); @endphp

    <!-- Navbar -->
    <nav class="main-nav">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="nav-brand">
                    <img src="/img/logo.png" alt="گەردی بازاڕ">
                    <div>
                        <h5>گەردی بازاڕ</h5>
                        <small>Gardi Bazar</small>
                    </div>
                </a>
                <div class="nav-links">
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> سەرەکی</a>
                    <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}"><i
                            class="fas fa-box"></i> بەرهەمەکان</a>
                    <a href="/track" class="{{ request()->is('track*') ? 'active' : '' }}"><i class="fas fa-search"></i>
                        شوێنکەوتن</a>
                    <a href="/about" class="{{ request()->is('about*') ? 'active' : '' }}"><i
                            class="fas fa-info-circle"></i> دەربارە</a>
                    <a href="/cart" class="{{ request()->is('cart*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> سەبەتە
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash messages -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                style="background: rgba(40,167,69,0.15); color: #28a745;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="background: rgba(220,53,69,0.15); color: #dc3545;">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo">
                        <img src="/img/logo.png" alt="گەردی بازاڕ">
                        <h5>گەردی بازاڕ</h5>
                    </div>
                    <p class="text-muted" style="font-size: 0.9rem; line-height: 1.8;">
                        {{ $settings['about_text'] ?? 'باشترین شوێن بۆ کڕینی گۆشتی تازە' }}
                    </p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3" style="color: var(--gold); font-weight: 700;">لینکەکان</h6>
                    <div class="footer-links">
                        <a href="/">سەرەکی</a>
                        <a href="/products">بەرهەمەکان</a>
                        <a href="/track">شوێنکەوتنی داواکاری</a>
                        <a href="/about">دەربارە</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3" style="color: var(--gold); font-weight: 700;">پەیوەندی</h6>
                    <p class="text-muted mb-2"><i class="fas fa-phone me-2" style="color: var(--gold)"></i>
                        {{ $settings['phone'] ?? '' }}</p>
                    <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-2" style="color: var(--gold)"></i>
                        {{ $settings['address'] ?? '' }}</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3" style="color: var(--gold); font-weight: 700;">سۆشیال میدیا</h6>
                    <div class="social-links">
                        @if(!empty($settings['facebook_url']))
                            <a href="{{ $settings['facebook_url'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($settings['instagram_url']))
                            <a href="{{ $settings['instagram_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($settings['tiktok_url']))
                            <a href="{{ $settings['tiktok_url'] }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.06);">
            <div class="text-center text-muted" style="font-size: 0.8rem;">
                <p class="mb-0">© {{ date('Y') }} گەردی بازاڕ. هەموو مافەکان پارێزراون.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Nav -->
    <div class="mobile-nav">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> سەرەکی</a>
        <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}"><i class="fas fa-box"></i>
            بەرهەم</a>
        <a href="/cart" class="{{ request()->is('cart*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> سەبەتە
            @if($cartCount > 0) ({{ $cartCount }}) @endif
        </a>
        <a href="/track" class="{{ request()->is('track*') ? 'active' : '' }}"><i class="fas fa-search"></i>
            شوێنکەوتن</a>
        <a href="/about" class="{{ request()->is('about*') ? 'active' : '' }}"><i class="fas fa-info-circle"></i>
            دەربارە</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>