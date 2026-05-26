<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Mystic Mirror Salon</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f5f0e8;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 30% 30%, rgba(201,168,76,0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 70% 70%, rgba(201,168,76,0.03) 0%, transparent 50%);
            pointer-events: none;
        }
        .login-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
            border-radius: 20px 20px 0 0;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header .brand {
            font-family: 'Great Vibes', cursive;
            font-size: 2.5rem;
            color: #c9a84c;
            text-shadow: 0 0 20px rgba(201,168,76,0.3);
        }
        .login-header p {
            color: #b0a890;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        .login-header .admin-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(201,168,76,0.1);
            border: 2px solid rgba(201,168,76,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: #c9a84c;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #b0a890;
            font-size: 0.9rem;
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #c9a84c;
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            background: #111;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 8px;
            color: #f5f0e8;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #c9a84c;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
        }
        .form-control::placeholder { color: #555; }
        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #c9a84c, #a08630);
            color: #0a0a0a;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(201,168,76,0.3);
        }
        .error-msg {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #ef4444;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #b0a890;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover { color: #c9a84c; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="admin-icon"><i class="fas fa-user-shield"></i></div>
            <div class="brand">Mystic Mirror</div>
            <p>Admin Panel Login</p>
        </div>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #22c55e; padding: 0.8rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; text-align: center;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->has('credentials'))
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first('credentials') }}
            </div>
        @endif

        <form action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" name="username" placeholder="Enter username" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
        <a href="{{ route('admin.password.forgot') }}" style="display: block; text-align: center; margin-top: 1rem; color: #c9a84c; text-decoration: none; font-size: 0.85rem; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
            <i class="fas fa-key"></i> Forgot Password?
        </a>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Website
        </a>
    </div>
</body>
</html>
