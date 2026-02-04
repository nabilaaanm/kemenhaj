<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Login - Kementerian Haji dan Umrah Kota Cirebon</title>
    @include('partials.assets')
    @php
        use Illuminate\Support\Facades\Schema;
        $primaryColor = '#ECB176';
        if (Schema::hasTable('site_appearances')) {
            $appearance = \App\Models\SiteAppearance::first();
            if ($appearance?->primary_color) {
                $primaryColor = $appearance->primary_color;
            }
        }
        $normalizeHex = function ($hex) {
            $hex = trim($hex);
            if ($hex === '') {
                return '#ECB176';
            }
            if ($hex[0] !== '#') {
                $hex = '#' . $hex;
            }
            return preg_match('/^#([A-Fa-f0-9]{6})$/', $hex) ? strtoupper($hex) : '#ECB176';
        };
        $adjust = function ($hex, $steps) use ($normalizeHex) {
            $hex = $normalizeHex($hex);
            $steps = max(-255, min(255, $steps));
            $hex = str_replace('#', '', $hex);
            $r = max(0, min(255, hexdec(substr($hex, 0, 2)) + $steps));
            $g = max(0, min(255, hexdec(substr($hex, 2, 2)) + $steps));
            $b = max(0, min(255, hexdec(substr($hex, 4, 2)) + $steps));
            return sprintf('#%02X%02X%02X', $r, $g, $b);
        };
        $primaryColor = $normalizeHex($primaryColor);
        $primaryDark = $adjust($primaryColor, -25);
        $primaryLight = $adjust($primaryColor, 25);
        $primaryBg = $adjust($primaryColor, 60);
    @endphp
    <style>
        :root {
            --color-primary: {{ $primaryColor }};
            --color-primary-dark: {{ $primaryDark }};
            --color-primary-light: {{ $primaryLight }};
            --color-primary-bg: {{ $primaryBg }};
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            min-height: 100vh;
            overflow: hidden;
            background: #0f172a;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('image/mekah.png') }}') center/cover no-repeat;
            filter: blur(20px);
            -webkit-filter: blur(20px);
            z-index: 0;
            transform: scale(1.1);
        }
        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        /* Left Panel - Visual */
        .login-visual {
            flex: 1;
            position: relative;
            background: url('{{ asset('image/mekah.png') }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 36px 0 0 36px;
        }
        .login-visual-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 40px;
        }
        /* Right Panel - Login Form */
        .login-form-panel {
            flex: 0 0 45%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.98) 100%);
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px 64px;
            position: relative;
            overflow-y: auto;
            border-radius: 0 36px 36px 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15),
                        0 8px 25px rgba(0, 0, 0, 0.1),
                        0 3px 10px rgba(0, 0, 0, 0.05);
        }
        .login-form-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(236, 177, 118, 0.03) 0%, 
                rgba(255, 255, 255, 0) 50%,
                rgba(236, 177, 118, 0.02) 100%);
            border-radius: 0 36px 36px 0;
            pointer-events: none;
            z-index: 0;
        }
        .login-form-panel > * {
            position: relative;
            z-index: 1;
        }
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            z-index: 1;
        }
        .auth-card {
            width: 1200px;
            max-width: 95%;
            height: 720px;
            background: #fff;
            border-radius: 36px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.25);
            margin: 0 auto;
        }
        .login-greeting {
            margin-bottom: 48px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .login-greeting img {
            width: 130px;
            height: auto;
            margin-bottom: 28px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.15));
            transition: transform 0.3s ease;
        }
        .login-greeting img:hover {
            transform: scale(1.05);
        }
        .login-greeting h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
            line-height: 1.4;
            letter-spacing: 0.3px;
        }
        .login-greeting p {
            font-size: 15px;
            color: #6b7280;
            margin: 0;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            letter-spacing: 0.2px;
        }
        .input-wrapper {
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding: 16px 52px 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            font-size: 15px;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06),
                        inset 0 1px 2px rgba(255, 255, 255, 0.8);
        }
        .form-group input:hover {
            border-color: #d1d5db;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1),
                        inset 0 1px 2px rgba(255, 255, 255, 1);
            transform: translateY(-1px);
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            box-shadow: 0 0 0 5px rgba(236, 177, 118, 0.15),
                        0 6px 20px rgba(236, 177, 118, 0.2),
                        inset 0 1px 2px rgba(255, 255, 255, 1);
            transform: translateY(-2px);
        }
        .form-group input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }
        .input-icon-right {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            color: #6b7280;
            cursor: pointer;
            transition: color 0.2s;
        }
        .input-icon-right:hover {
            color: var(--color-primary);
        }
        .input-icon-right svg {
            width: 100%;
            height: 100%;
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
            color: var(--color-primary);
        }
        .password-toggle svg {
            width: 100%;
            height: 100%;
        }
        .recover-password {
            text-align: right;
            margin-bottom: 32px;
            margin-top: -4px;
        }
        .recover-password a {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .recover-password a:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }
        .btn-signin {
            width: 100%;
            padding: 18px 24px;
            background: linear-gradient(135deg, #ECB176 0%, #D99D5F 50%, #ECB176 100%);
            background-size: 200% 200%;
            color: #ffffff;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 20px rgba(236, 177, 118, 0.35),
                        0 3px 10px rgba(0, 0, 0, 0.12),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            font-size: 15px;
        }
        .btn-signin::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }
        .btn-signin::after {
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
        .btn-signin:hover {
            transform: translateY(-3px);
            background-position: right center;
            box-shadow: 0 10px 30px rgba(236, 177, 118, 0.45),
                        0 6px 15px rgba(236, 177, 118, 0.35),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
        .btn-signin:hover::before {
            left: 100%;
        }
        .btn-signin:hover::after {
            width: 300px;
            height: 300px;
        }
        .btn-signin:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(236, 177, 118, 0.4),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        .btn-signin:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            background: #e5e7eb;
            box-shadow: none;
        }
        .alert {
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-size: 13px;
            border: 1px solid;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08),
                        inset 0 1px 2px rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }
        .alert-error {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
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
        @media (max-width: 900px) {
            .auth-card {
                flex-direction: column;
                height: auto;
                width: 100%;
                max-width: 100%;
            }

            .login-visual {
                height: 260px;
                border-radius: 36px 36px 0 0;
            }

            .login-form-panel {
                flex: 1;
                border-radius: 0 0 36px 36px;
                padding: 48px 40px;
            }

            .login-form-panel::before {
                border-radius: 0 0 36px 36px;
            }
        }
        @media (max-width: 640px) {
            .page-wrapper {
                padding: 20px;
            }
            .auth-card {
                height: auto;
            }
            .login-form-panel {
                padding: 40px 28px;
            }
            .login-greeting {
                margin-bottom: 36px;
            }
            .login-greeting h1 {
                font-size: 18px;
            }
            .login-greeting img {
                width: 100px;
                margin-bottom: 20px;
            }
            .form-group input {
                padding: 14px 48px 14px 18px;
                font-size: 14px;
                border-radius: 16px;
            }
            .btn-signin {
                padding: 16px 24px;
                font-size: 15px;
                border-radius: 16px;
            }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="auth-card">
        <div class="login-visual">
            <div class="login-visual-content"></div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="login-form-panel">
            <div class="login-greeting">
                <img src="{{ asset('image/lambang.png') }}" alt="Logo Kemenhaj">
                <h1 class="page-title">KEMENTERIAN HAJI DAN UMRAH</h1>
                <p>Kota Cirebon</p>
            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            placeholder="Masukkan Email"
                        >
                        <div class="input-icon-right">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="Masukkan Password"
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

                <div class="recover-password">
                    <a href="{{ route('password.request') }}">Lupa Password ?</a>
                </div>

                <button type="submit" class="btn-signin">
                    Log In 
                </button>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        // SweetAlert untuk logout message
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        @endif

        // Mencegah form berubah saat submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            
            // Disable button untuk mencegah double submit
            submitButton.disabled = true;
            submitButton.textContent = 'Memproses...';
            
            // Jika ada error, enable kembali setelah beberapa saat
            setTimeout(function() {
                if (form.querySelector('.text-error')) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Log In';
                }
            }, 2000);
        });
    </script>
</body>
</html>
