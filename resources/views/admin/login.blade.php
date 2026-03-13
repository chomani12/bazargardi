<!DOCTYPE html>
<html lang="ku" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گەردی بازاڕ - چوونەژوورەوە</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Noto Sans Arabic', sans-serif;
        }

        body {
            background: #0f0f0f;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: linear-gradient(145deg, #1a1a1a, #1e1e1e);
            border: 1px solid rgba(212, 167, 69, 0.15);
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .login-box .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-box .brand img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #D4A745;
            margin-bottom: 16px;
        }

        .login-box .brand h3 {
            color: #D4A745;
            font-weight: 800;
        }

        .login-box .brand p {
            color: #888;
            font-size: 0.9rem;
        }

        .form-control {
            background: #111;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #e0e0e0;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            background: #151515;
            border-color: #D4A745;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.2rem rgba(212, 167, 69, 0.15);
        }

        .form-label {
            color: #aaa;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #D4A745, #B8860B);
            color: #000;
            font-weight: 700;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 167, 69, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="brand">
            <img src="/img/logo.png" alt="گەردی بازاڕ">
            <h3>گەردی بازاڕ</h3>
            <p>پانێلی بەڕێوەبردن</p>
        </div>

        @if($errors->any())
            <div class="alert mb-3">
                <i class="fas fa-exclamation-circle me-2"></i>
                @foreach($errors->all() as $error) {{ $error }} @endforeach
            </div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf
            <div class="mb-3">
                <label class="form-label">ئیمەیڵ</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="admin@GARDIbazar.com" required>
            </div>
            <div class="mb-4">
                <label class="form-label">وشەی نهێنی</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember" style="color: #888; font-size: 0.85rem;">لەبیرم
                    بمێنە</label>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> چوونەژوورەوە
            </button>
        </form>
    </div>
</body>

</html>