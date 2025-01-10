<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DEJAYMARKET') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #000, #1a1a1a);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }
        h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.1);
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #ccc;
        }
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
            gap: 20px;
            justify-items: center;
            margin: 30px auto;
            max-width: 600px;
        }
        .icon {
            font-size: 2.5rem;
            color: #fff;
            transition: transform 0.5s, color 0.5s;
        }
        .icon:hover {
            transform: rotate(360deg) scale(1.2);
            color: #ff2d20;
        }
        .login-btn {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(45deg, #ff2d20, #ff4e30);
            color: #fff;
            font-size: 1rem;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }
        .login-btn:hover {
            background: linear-gradient(45deg, #c61a15, #d92520);
            transform: translateY(-3px);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
        }
        footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #555;
        }
        .animated-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, rgba(255, 45, 32, 0.2), transparent);
            animation: pulse 6s infinite;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.3;
            }
        }
    </style>
</head>
<body>
    <div class="animated-background"></div>
    <div class="container">
        <h1>Welcome to {{ config('app.name', 'DEJAYMARKET') }}</h1>
        <p>Your one-stop solution for all your shopping needs, now in style.</p>
        <div class="icon-grid">
            <i class="fas fa-shopping-cart icon"></i>
            <i class="fas fa-box icon"></i>
            <i class="fas fa-truck icon"></i>
            <i class="fas fa-percent icon"></i>
            <i class="fas fa-cash-register icon"></i>
            <i class="fas fa-gift icon"></i>
        </div>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="login-btn">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="login-btn">Login</a>
                @endauth
            </div>
        @endif
    </div>
    <footer>
        &copy; {{ date('Y') }} DEJAYMARKET. All Rights Reserved. Crafted with <i class="fas fa-heart" style="color: red;"></i>.
    </footer>
</body>
</html>
