<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Login - Kementerian Haji dan Umrah Kota Cirebon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }
        .login-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }
        /* Background Image - Full Width */
        .login-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .login-background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .login-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.15);
            z-index: 2;
        }
        /* Login Form Card - Overlay on Right */
        .login-form-container {
            position: absolute;
            top: 50%;
            right: 5%;
            transform: translateY(-50%);
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 500px;
            height: 500px;
            max-width: 500px;
            max-height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            z-index: 10;
            overflow-y: auto;
        }
        .login-title {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-title-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .login-title-logo img {
            height: 50px;
            width: auto;
        }
        .login-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }
        .login-title p {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #6b7280;
            pointer-events: none;
        }
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            color: #6b7280;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 10;
        }
        .password-toggle:hover {
            color: #ECB176;
        }
        .password-toggle svg {
            width: 100%;
            height: 100%;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
        }
        .form-group.password-field input {
            padding-right: 48px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #ECB176;
            box-shadow: 0 0 0 4px rgba(236, 177, 118, 0.1);
        }
        .form-group input::placeholder {
            color: #9ca3af;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ECB176;
        }
        .remember-me label {
            color: #374151;
            cursor: pointer;
            margin: 0;
        }
        .forget-password {
            color: #1f2937;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .forget-password:hover {
            color: #ECB176;
        }
        .btn-login {
            width: 100%;
            padding: 16px 24px;
            background: #1f2937;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(31, 41, 55, 0.2);
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn-login:hover {
            background: #111827;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(31, 41, 55, 0.4);
        }
        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(31, 41, 55, 0.3);
        }
        .btn-login:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(31, 41, 55, 0.2), 0 4px 12px rgba(31, 41, 55, 0.2);
        }
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            border: 1px solid;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-color: #6ee7b7;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-color: #fca5a5;
        }
        .text-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
        /* Responsive */
        @media (max-width: 968px) {
            .login-form-container {
                right: 50%;
                transform: translate(50%, -50%);
                max-width: 90%;
            }
        }
        @media (max-width: 640px) {
            .login-form-container {
                right: 50%;
                transform: translate(50%, -50%);
                max-width: 95%;
                padding: 32px 24px;
            }
            .login-title h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Background Image - Full Width -->
        <div class="login-background">
            <img src="{{ asset('image/mekah.png') }}" 
                 alt="Mekah" 
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div style="display: none;">
                <div style="font-size: 48px; margin-bottom: 16px;">🕌</div>
                <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 8px;">Kementerian Haji</h2>
                <p style="font-size: 16px; opacity: 0.9;">Kota Cirebon</p>
            </div>
            <div class="login-background-overlay"></div>
        </div>

        <!-- Login Form Card - Overlay on Right -->
        <div class="login-form-container">
                <div class="login-title">
                    <div class="login-title-logo">
                        <img src="{{ asset('image/lambang.png') }}" alt="Logo Kemenhaj">
                    </div>
                    <h1>KEMENTERIAN HAJI DAN UMRAH</h1>
                    <h1>KOTA CIREBON</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Username/Email</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                placeholder="Masukkan email"
                            >
                        </div>
                        @error('email')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group password-field">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                placeholder="Masukkan password"
                            >
                            <span class="password-toggle" id="passwordToggle" onclick="togglePassword()">
                                <!-- Eye icon (visible) -->
                                <svg id="eyeIcon" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <!-- Eye slash icon (hidden) -->
                                <svg id="eyeSlashIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="forget-password">Forget password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        Login
                    </button>
                </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            }
        }
    </script>
</body>
</html>
