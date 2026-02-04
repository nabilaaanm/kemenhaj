<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Lupa Password - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        $primaryColor = $normalizeHex($primaryColor);
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
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: #0f172a;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: url('{{ asset('image/mekah.png') }}') center/cover no-repeat;
            filter: blur(20px);
            -webkit-filter: blur(20px);
            z-index: 0;
            transform: scale(1.05);
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
            width: 520px;
            max-width: 100%;
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
        }
        .auth-card h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            text-align: center;
        }
        .auth-card p.subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: 14px;
            background: #fff;
            transition: border-color 0.2s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(236, 177, 118, 0.2);
        }
        .text-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #fca5a5;
            background: #fee2e2;
            color: #991b1b;
        }
        .btn-submit {
            width: 100%;
            padding: 14px 18px;
            background: var(--color-primary);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }
        .btn-submit:hover {
            opacity: 0.9;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
            margin-top: 16px;
            justify-content: center;
            width: 100%;
        }
        .back-link:hover {
            color: var(--color-primary);
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="auth-card">
        <h1>Lupa Password</h1>
        <p class="subtitle">Masukkan email dan password baru Anda.</p>

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="contoh@kemenhaj.go.id">
                @error('email')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter">
                @error('password')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn-submit">Reset Password</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">Kembali ke Login</a>
    </div>
</div>
</body>
</html>
