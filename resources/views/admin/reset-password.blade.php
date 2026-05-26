<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Mystic Mirror Salon</title>
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
        .card {
            position: relative;
            width: 100%;
            max-width: 420px;
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, transparent, #c9a84c, transparent);
            border-radius: 20px 20px 0 0;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .header .icon {
            width: 60px; height: 60px;
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
        .header .brand {
            font-family: 'Great Vibes', cursive;
            font-size: 2.5rem;
            color: #c9a84c;
        }
        .header p { color: #b0a890; font-size: 0.9rem; margin-top: 0.5rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #b0a890;
            font-size: 0.9rem;
        }
        .input-wrapper { position: relative; }
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
        .btn {
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
        .btn:hover {
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
        .success-msg {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.3);
            color: #22c55e;
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
    <div class="card">
        <div class="header">
            <div class="icon"><i class="fas fa-key"></i></div>
            <div class="brand">Mystic Mirror</div>
            <p>{{ isset($token) ? 'Set New Password' : 'Forgot Password' }}</p>
        </div>

        @if($errors->any())
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i>
                @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="success-msg">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(isset($token))
            {{-- Reset Password Form --}}
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password" required autofocus minlength="6">
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password" required minlength="6">
                    </div>
                </div>
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Update Password
                </button>
            </form>
        @else
            {{-- Request Reset Form --}}
            <p style="color: #888; font-size: 0.85rem; margin-bottom: 1.5rem; line-height: 1.6;">
                Enter the admin email address. We'll send you a link to reset your password.
            </p>
            <form action="{{ route('admin.password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Admin Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="Enter admin email" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn">
                    <i class="fas fa-paper-plane"></i> Send Reset Link
                </button>
            </form>
        @endif

        <a href="{{ route('admin.login') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>
</body>
</html>
