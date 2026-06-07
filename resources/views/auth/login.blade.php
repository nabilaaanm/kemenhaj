<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    @include('partials.favicon')
    <title>Login - {{ $siteSetting->title_suffix }}</title>
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
    @endphp
    <style>
        :root {
            --color-primary: {{ $primaryColor }};
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px 28px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }
        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-header img {
            width: 72px;
            height: auto;
            margin-bottom: 16px;
        }
        .login-header h1 {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            line-height: 1.4;
            margin-bottom: 4px;
        }
        .login-header p {
            font-size: 13px;
            color: #6b7280;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .input-wrapper {
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding: 11px 40px 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(236, 177, 118, 0.2);
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9ca3af;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
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
            margin-bottom: 20px;
        }
        .recover-password a {
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
        }
        .recover-password a:hover {
            color: var(--color-primary);
        }
        .btn-signin {
            width: 100%;
            padding: 12px 16px;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-signin:hover {
            opacity: 0.92;
        }
        .btn-signin:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .alert-error {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .text-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <img src="{{ $siteSetting->lambang_url }}" alt="Logo {{ $siteSetting->nama_kemenhaj }}">
            <h1>{{ $siteSetting->nama_kemenhaj }}</h1>
            <p>{{ $siteSetting->kota }}</p>
        </div>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Masukkan email"
                >
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
                        placeholder="Masukkan password"
                    >
                    <button type="button" class="password-toggle" id="passwordToggle" aria-label="Tampilkan password">
                        <svg id="eyeIcon" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eyeSlashIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="recover-password">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button type="submit" class="btn-signin">Masuk</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('passwordToggle').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            eyeIcon.style.display = isHidden ? 'block' : 'none';
            eyeSlashIcon.style.display = isHidden ? 'none' : 'block';
        });

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        @endif

        document.getElementById('loginForm').addEventListener('submit', function () {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Memproses...';
        });
    </script>
</body>
</html>
