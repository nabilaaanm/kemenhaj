<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>{{ $title }} - Kementerian Haji dan Umrah Kota Cirebon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        html { overflow-x: hidden; width: 100%; font-size: 16px; }
        body { overflow-x: hidden; width: 100%; min-width: 320px; max-width: 100vw; margin: 0; padding: 0; }
        .container-fixed { max-width: 1280px; margin: 0 auto; width: 100%; padding-left: 24px; padding-right: 24px; }
        @media (max-width: 640px) {
            .container-fixed { padding-left: 16px; padding-right: 16px; }
        }
        .hover-custom { transition: color 0.2s; }
        .hover-custom:hover { color: #ECB176; }
        .focus-custom:focus { outline: none; border-color: #ECB176; box-shadow: 0 0 0 1px #ECB176; }
        .btn-custom { background-color: #ECB176; transition: background-color 0.2s; }
        .btn-custom:hover { background-color: #D99D5F; }
        .btn-readmore {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border: 1px solid rgba(236, 177, 118, 0.6);
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            color: #B87A3A;
            background: rgba(249, 230, 208, 0.4);
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-readmore:hover {
            background: #ECB176;
            color: white;
            border-color: #ECB176;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(236, 177, 118, 0.25);
        }
        .btn-readmore svg { width: 14px; height: 14px; }
        @media (max-width: 640px) {
            .btn-readmore { font-size: 11px; padding: 6px 10px; }
        }
        .news-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(17, 24, 39, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(17, 24, 39, 0.12);
        }
        .news-thumb { width: 100%; height: 200px; object-fit: cover; }
        @media (max-width: 640px) { .news-thumb { height: 180px; } }
        .news-body { padding: 16px; }
        .news-title { font-weight: 700; color: #1f2937; line-height: 1.4; }
        .news-excerpt { color: #6b7280; }
        .news-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            color: #B87A3A;
            background: rgba(236, 177, 118, 0.18);
        }
        .news-meta { font-size: 12px; color: #9ca3af; }
        .dropdown-menu { position: relative; }
        .dropdown-toggle { cursor: pointer; background: none; border: none; padding: 0; font-size: inherit; font-weight: inherit; color: inherit; }
        .dropdown-toggle svg { transition: transform 0.2s; }
        .dropdown-menu:hover .dropdown-toggle svg,
        .dropdown-menu.active .dropdown-toggle svg { transform: rotate(180deg); }
        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 1000;
            padding: 8px 0;
        }
        .dropdown-menu:hover .dropdown-content,
        .dropdown-menu.active .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-item { display: block; padding: 10px 20px; color: #374151; text-decoration: none; transition: all 0.2s; font-size: 14px; }
        .dropdown-item:hover { background-color: #F9E6D0; color: #ECB176; padding-left: 24px; }
        .dropdown-menu:hover .dropdown-toggle,
        .dropdown-menu.active .dropdown-toggle { color: #ECB176; }
        .language-selector { position: relative; }
        .language-toggle { background: white; border: 1px solid #d1d5db; cursor: pointer; transition: all 0.2s; }
        .language-toggle:hover { background-color: #f3f4f6; border-color: #ECB176; }
        .language-toggle svg { transition: transform 0.2s; }
        .language-selector.active .language-toggle svg { transform: rotate(180deg); }
        .language-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            min-width: 160px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 1000;
            padding: 4px 0;
            border: 1px solid #e5e7eb;
        }
        .language-selector.active .language-dropdown { opacity: 1; visibility: visible; transform: translateY(0); }
        .language-option { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 10px 16px; background: none; border: none; text-align: left; cursor: pointer; transition: all 0.2s; font-size: 14px; }
        .language-option:hover { background-color: #F9E6D0; }
        .language-option.active { background-color: #F9E6D0; color: #ECB176; }
        .language-option span:first-child { font-weight: 600; margin-right: 8px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<main class="container-fixed py-12 w-full">
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #8B6914;">
            {{ $title }}
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            {{ $subtitle }}
        </p>
    </div>

    <div class="mb-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center max-w-3xl mx-auto">
            <div class="flex-1 w-full relative">
                <input type="text" placeholder="Cari {{ strtolower($title) }}..."
                    class="w-full border rounded-lg px-4 py-3 text-sm focus-custom">
                <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button class="btn-custom text-black font-semibold px-8 py-3 rounded-lg text-sm whitespace-nowrap flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($posts as $post)
            <article class="news-card">
                <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="news-thumb" style="display: block;">
                <div class="news-body">
                    <span class="news-badge mb-2">
                        {{ $post->category?->name ?? $title }}
                    </span>
                    <p class="news-meta mb-2">
                        {{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}
                    </p>
                    <h3 class="news-title text-base mb-3 line-clamp-2">
                        {{ $post->title }}
                    </h3>
                    <p class="news-excerpt text-sm mb-4 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 140) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs" style="color: #ECB176;">{{ $post->location ?: '#' . ($post->category?->slug ?? 'news') }}</span>
                        <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                            Baca Selengkapnya
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                Belum ada posting tersedia.
            </div>
        @endforelse
    </div>
</main>

@include('partials.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.closest('.dropdown-menu');
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('active');
                    }
                });
                dropdown.classList.toggle('active');
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-menu')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
            if (!e.target.closest('.language-selector')) {
                document.querySelector('.language-selector')?.classList.remove('active');
            }
        });

        const languageToggle = document.getElementById('languageToggle');
        const currentLang = document.getElementById('currentLang');
        const languageOptions = document.querySelectorAll('.language-option');
        let currentLanguage = localStorage.getItem('selectedLanguage') || 'id';

        function initLanguage() {
            const langCode = currentLanguage === 'id' ? 'ID' : 'EN';
            if (currentLang) {
                currentLang.textContent = langCode;
            }
            languageOptions.forEach(option => {
                if (option.dataset.lang === currentLanguage) {
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
        }

        initLanguage();

        if (languageToggle) {
            languageToggle.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.language-selector')?.classList.toggle('active');
            });
        }

        languageOptions.forEach(option => {
            option.addEventListener('click', function() {
                currentLanguage = this.dataset.lang;
                localStorage.setItem('selectedLanguage', currentLanguage);
                initLanguage();
                document.querySelector('.language-selector')?.classList.remove('active');
                location.reload();
            });
        });
    });
</script>
</body>
</html>
