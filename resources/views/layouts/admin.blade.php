<!DOCTYPE html>
<html lang="ku" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'گەردی بازاڕ') - پانێلی بەڕێوەبردن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        body {
            background: #0f0f0f;
            color: #e0e0e0;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a1a 0%, #111 100%);
            border-left: 1px solid rgba(212, 167, 69, 0.2);
            position: fixed;
            right: 0;
            top: 0;
            z-index: 100;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.3);
        }

        .admin-sidebar .brand {
            padding: 24px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(212, 167, 69, 0.15);
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.1), rgba(212, 167, 69, 0.05));
        }

        .admin-sidebar .brand h4 {
            color: #D4A745;
            font-weight: 700;
            margin: 0;
            font-size: 1.3rem;
        }

        .admin-sidebar .brand small {
            color: #888;
            font-size: 0.75rem;
        }

        .admin-sidebar .nav-link {
            color: #aaa;
            padding: 12px 24px;
            font-size: 0.9rem;
            transition: all 0.3s;
            border-right: 3px solid transparent;
            margin: 2px 0;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: #D4A745;
            background: rgba(212, 167, 69, 0.08);
            border-right-color: #D4A745;
        }

        .admin-sidebar .nav-link i {
            width: 24px;
            margin-left: 8px;
            font-size: 1rem;
        }

        .admin-content {
            margin-right: 260px;
            padding: 24px;
        }

        .admin-topbar {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 167, 69, 0.1);
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: -24px -24px 24px;
            border-radius: 0;
        }

        .stat-card {
            background: linear-gradient(135deg, #1a1a1a, #222);
            border: 1px solid rgba(212, 167, 69, 0.15);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: rgba(212, 167, 69, 0.3);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stat-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin: 8px 0 4px;
        }

        .stat-card p {
            color: #888;
            font-size: 0.85rem;
            margin: 0;
        }

        .card-dark {
            background: linear-gradient(135deg, #1a1a1a, #1e1e1e);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
        }

        .card-dark .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 16px 20px;
            color: #D4A745;
            font-weight: 600;
        }

        .table-dark-custom {
            color: #ccc;
        }

        .table-dark-custom thead th {
            background: rgba(212, 167, 69, 0.1);
            color: #D4A745;
            border-color: rgba(255, 255, 255, 0.06);
            font-weight: 600;
        }

        .table-dark-custom td {
            border-color: rgba(255, 255, 255, 0.04);
            vertical-align: middle;
        }

        .table-dark-custom tbody tr:hover {
            background: rgba(212, 167, 69, 0.05);
        }

        .btn-gold {
            background: linear-gradient(135deg, #D4A745, #B8860B);
            color: #000;
            font-weight: 600;
            border: none;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #e0b84f, #c4941f);
            color: #000;
            transform: translateY(-1px);
        }

        .btn-outline-gold {
            border: 1px solid #D4A745;
            color: #D4A745;
        }

        .btn-outline-gold:hover {
            background: #D4A745;
            color: #000;
        }

        .form-control-dark,
        .form-select-dark {
            background: #1a1a1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        .form-control-dark:focus,
        .form-select-dark:focus {
            background: #1e1e1e;
            border-color: #D4A745;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.2rem rgba(212, 167, 69, 0.15);
        }

        /* Global fix: all form controls in admin */
        .form-control,
        .form-select,
        textarea.form-control,
        input.form-control {
            background: #1a1a1a !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }

        .form-control:focus,
        .form-select:focus {
            background: #1e1e1e !important;
            border-color: #D4A745;
            color: #fff !important;
            box-shadow: 0 0 0 0.2rem rgba(212, 167, 69, 0.15);
        }

        .form-control::placeholder {
            color: #666 !important;
        }

        .form-label,
        .form-check-label,
        .text-muted {
            color: #fff !important;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 500;
        }

        .badge-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .badge-confirmed {
            background: rgba(0, 123, 255, 0.15);
            color: #007bff;
        }

        .badge-delivering {
            background: rgba(138, 43, 226, 0.15);
            color: #8a2be2;
        }

        .badge-delivered {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .badge-cancelled {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                min-height: auto;
            }

            .admin-content {
                margin-right: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar d-none d-md-block">
        <div class="brand">
            <h4><i class="fas fa-store"></i> گەردی بازاڕ</h4>
            <small>پانێلی بەڕێوەبردن</small>
        </div>
        <nav class="mt-3">
            <a href="/admin" class="nav-link {{ request()->is('admin') && !request()->is('admin/*') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> داشبۆرد
            </a>
            <a href="/admin/orders" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> داواکاریەکان
            </a>
            <a href="/admin/products" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> بەرهەمەکان
            </a>
            <a href="/admin/categories" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> جۆرەکان
            </a>
            <a href="/admin/sliders" class="nav-link {{ request()->is('admin/sliders*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> سلایدەرەکان
            </a>
            <a href="/admin/settings" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> ڕێکخستنەکان
            </a>
            <hr style="border-color: rgba(255,255,255,0.06); margin: 16px 20px;">
            <a href="/" target="_blank" class="nav-link">
                <i class="fas fa-external-link-alt"></i> بینینی ماڵپەڕ
            </a>
        </nav>
    </div>

    <!-- Content -->
    <div class="admin-content">
        <div class="admin-topbar">
            <h5 class="mb-0" style="color: #ccc;">@yield('page_title', 'داشبۆرد')</h5>
            <div>
                <span class="text-muted me-3"><i class="fas fa-user"></i> {{ auth()->user()->name }}</span>
                <form action="/admin/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-gold">
                        <i class="fas fa-sign-out-alt"></i> دەرچوون
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                style="background: rgba(40,167,69,0.15); color: #28a745;" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" style="background: rgba(220,53,69,0.15); color: #dc3545;">
                <i class="fas fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>