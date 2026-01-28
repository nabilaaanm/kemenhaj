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
        .hover-custom:hover { color: var(--color-primary); }
        .focus-custom:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 1px var(--color-primary); }
        .btn-custom { background-color: var(--color-primary); transition: background-color 0.2s; }
        .btn-custom:hover { background-color: var(--color-primary-dark); }
        .btn-readmore {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border: 1px solid var(--color-primary);
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            color: var(--color-primary-dark);
            background: #ffffff;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-readmore:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
        }
        .btn-readmore svg { width: 14px; height: 14px; }
        @media (max-width: 640px) {
            .btn-readmore { font-size: 11px; padding: 6px 10px; }
        }
        .news-card {
            background: white;
            border-radius: 16px;
            overflow: visible;
            box-shadow: 0 8px 24px rgba(17, 24, 39, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .news-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(17, 24, 39, 0.12);
        }
        .news-thumb {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        @media (max-width: 640px) { .news-thumb { height: 180px; } }
        .news-body { padding: 16px; display: flex; flex-direction: column; flex: 1; }
        .news-footer { margin-top: auto; }
        .news-title { font-weight: 700; color: #1f2937; line-height: 1.4; }
        .news-excerpt { color: #6b7280; }
        .news-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }
        .news-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary-light));
        }
        .news-meta { font-size: 12px; color: #9ca3af; }
        .view-meta {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #6b7280;
            background: var(--color-primary-bg);
            border: 1px solid var(--color-primary-light);
            padding: 2px 8px;
            border-radius: 999px;
            width: fit-content;
        }
        .view-meta svg {
            width: 14px;
            height: 14px;
            stroke: var(--color-primary);
        }
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
        .dropdown-item:hover { background-color: var(--color-primary-bg); color: var(--color-primary); padding-left: 24px; }
        .dropdown-menu:hover .dropdown-toggle,
        .dropdown-menu.active .dropdown-toggle { color: var(--color-primary); }
        .language-toggle:hover { background-color: #f3f4f6; border-color: var(--color-primary); }
        .language-option:hover { background-color: var(--color-primary-bg); }
        .language-option span:first-child { font-weight: 600; margin-right: 8px; }
        .share-group { position: relative; }
        .share-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid var(--color-primary-light);
            background: #ffffff;
            color: var(--color-primary-dark);
            font-weight: 600;
            font-size: 12px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .share-toggle svg { width: 14px; height: 14px; }
        .share-toggle:hover {
            background: var(--color-primary-bg);
            border-color: var(--color-primary);
            color: var(--color-primary);
        }
        .share-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.16);
            padding: 10px;
            display: none;
            min-width: 180px;
            z-index: 20;
        }
        .share-group.active .share-menu { display: block; }
        .share-menu-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #9ca3af;
            padding: 6px 10px 4px;
        }
        .share-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            background: #f9fafb;
            border: 1px solid #f3f4f6;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .share-item:hover {
            background: #ffffff;
            color: var(--color-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
            border-color: rgba(15, 23, 42, 0.08);
        }
        .share-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #eef2f7;
            color: #374151;
        }
        .share-icon svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }
        .share-icon--copy svg {
            fill: none;
            stroke: currentColor;
        }
        .share-icon--whatsapp { background: rgba(34, 197, 94, 0.14); color: #16a34a; }
        .share-icon--facebook { background: rgba(37, 99, 235, 0.14); color: #2563eb; }
        .share-icon--instagram { background: rgba(236, 72, 153, 0.14); color: #db2777; }
        .share-icon--tiktok { background: rgba(15, 23, 42, 0.12); color: #0f172a; }
        .share-icon--twitter { background: rgba(17, 24, 39, 0.12); color: #111827; }
        .share-icon--copy { background: rgba(107, 114, 128, 0.16); color: #4b5563; }
        .share-copy.is-copied { background: var(--color-primary); color: #ffffff; }
        @media (max-width: 640px) {
            .share-toggle { font-size: 11px; padding: 5px 8px; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<main class="container-fixed py-12 w-full">
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #111827;">
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
                    <div class="news-meta-row mb-2">
                        <p class="news-meta">
                            {{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}
                        </p>
                        <p class="view-meta">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                            </svg>
                            {{ number_format($post->views ?? 0) }}x dilihat
                        </p>
                    </div>
                    <h3 class="news-title text-base mb-3 line-clamp-2">
                        {{ $post->title }}
                    </h3>
                    @php
                        $rawContent = $post->content ?? '';
                        $excerptText = '';
                        if (preg_match('/<p[^>]*>(.*?)<\/p>/si', $rawContent, $match)) {
                            $excerptText = trim(strip_tags($match[1]));
                        } else {
                            $excerptText = trim(strip_tags($rawContent));
                        }
                    @endphp
                    <p class="news-excerpt text-sm mb-4 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($excerptText, 140) }}
                    </p>
                    <div class="flex items-center justify-between news-footer">
                        <span class="text-xs" style="color: var(--color-primary);">{{ $post->location ?: '#' . ($post->category?->slug ?? 'news') }}</span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                Baca Selengkapnya
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <div class="share-group" data-share-group>
                                <button type="button" class="share-toggle" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                    </svg>
                                    Bagikan
                                </button>
                                <div class="share-menu" role="menu">
                                    <div class="share-menu-title">Bagikan ke</div>
                                    <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                        <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                            </svg>
                                        </span>
                                        WhatsApp
                                    </a>
                                    <a class="share-item" data-share-provider="facebook" href="#" target="_blank" rel="noopener">
                                        <span class="share-icon share-icon--facebook" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 24h11.495v-9.294H9.691V11.01h3.13V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.696h-3.12V24h6.116C23.403 24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z"/>
                                            </svg>
                                        </span>
                                        Facebook
                                    </a>
                                    <a class="share-item" data-share-provider="instagram" href="#" target="_blank" rel="noopener">
                                        <span class="share-icon share-icon--instagram" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.35 3.608 1.325.975.975 1.263 2.242 1.325 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.35 2.633-1.325 3.608-.975.975-2.242 1.263-3.608 1.325-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.35-3.608-1.325-.975-.975-1.263-2.242-1.325-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.85C2.295 5.784 2.583 4.517 3.558 3.542 4.533 2.567 5.8 2.279 7.166 2.217 8.432 2.175 8.812 2.163 12 2.163m0-2.163C8.741 0 8.332.013 7.052.072 5.773.131 4.602.388 3.635 1.356 2.667 2.323 2.41 3.495 2.351 4.774.292 6.054.279 6.463.279 9.722v4.556c0 3.259.013 3.668.072 4.948.059 1.279.316 2.451 1.284 3.418.967.968 2.139 1.225 3.418 1.284 1.28.059 1.689.072 4.948.072h4.556c3.259 0 3.668-.013 4.948-.072 1.279-.059 2.451-.316 3.418-1.284.968-.967 1.225-2.139 1.284-3.418.059-1.28.072-1.689.072-4.948V9.722c0-3.259-.013-3.668-.072-4.948-.059-1.279-.316-2.451-1.284-3.418C20.451.388 19.279.131 18 .072 16.72.013 16.311 0 13.052 0H12z"/>
                                                <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-10.845a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z"/>
                                            </svg>
                                        </span>
                                        Instagram
                                    </a>
                                    <a class="share-item" data-share-provider="tiktok" href="#" target="_blank" rel="noopener">
                                        <span class="share-icon share-icon--tiktok" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M17.52 5.42a5.78 5.78 0 0 1-1.6-3.42h-3.25v13.2a2.72 2.72 0 1 1-2.72-2.72c.27 0 .54.04.79.12V9.26a6.03 6.03 0 0 0-1-.08A6.03 6.03 0 1 0 14.76 15V8.46a9.14 9.14 0 0 0 5.24 1.65V6.9a5.8 5.8 0 0 1-2.48-1.48z"/>
                                            </svg>
                                        </span>
                                        TikTok
                                    </a>
                                    <a class="share-item" data-share-provider="twitter" href="#" target="_blank" rel="noopener">
                                        <span class="share-icon share-icon--twitter" aria-hidden="true">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.5 11.24h-6.66l-5.214-6.82-5.965 6.82H1.68l7.73-8.84L1.214 2.25h6.83l4.713 6.231L18.244 2.25zM17.089 19.77h1.833L7.084 4.112H5.117L17.089 19.77z"/>
                                            </svg>
                                        </span>
                                        Tweet
                                    </a>
                                    <button type="button" class="share-item share-copy" data-share-provider="copy">
                                        <span class="share-icon share-icon--copy" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                            </svg>
                                        </span>
                                        Salin Link
                                    </button>
                                </div>
                            </div>
                        </div>
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
        });

        const shareGroups = document.querySelectorAll('[data-share-group]');
        const buildShareUrls = (url, title) => {
            const encodedUrl = encodeURIComponent(url);
            const encodedTitle = encodeURIComponent(title || '');
            const text = encodedTitle ? `${encodedTitle}%0A${encodedUrl}` : encodedUrl;
            return {
                whatsapp: `https://wa.me/?text=${text}`,
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
                instagram: `https://www.instagram.com/?url=${encodedUrl}`,
                tiktok: `https://www.tiktok.com/share?url=${encodedUrl}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`,
            };
        };

        const closeShareGroups = () => {
            shareGroups.forEach(group => {
                group.classList.remove('active');
                const toggle = group.querySelector('.share-toggle');
                if (toggle) toggle.setAttribute('aria-expanded', 'false');
            });
        };

        shareGroups.forEach(group => {
            const toggle = group.querySelector('.share-toggle');
            const menu = group.querySelector('.share-menu');
            const copyBtn = group.querySelector('.share-copy');
            if (!toggle || !menu) return;

            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const isActive = group.classList.contains('active');
                closeShareGroups();
                if (!isActive) {
                    const url = toggle.getAttribute('data-share-url') || window.location.href;
                    const title = toggle.getAttribute('data-share-title') || document.title;
                    const urls = buildShareUrls(url, title);
                    menu.querySelectorAll('[data-share-provider]').forEach(item => {
                        const provider = item.getAttribute('data-share-provider');
                        if (provider && urls[provider]) {
                            item.setAttribute('href', urls[provider]);
                        }
                    });
                    group.classList.add('active');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });

            if (copyBtn) {
                copyBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const url = toggle.getAttribute('data-share-url') || window.location.href;
                    try {
                        if (navigator.clipboard && window.isSecureContext) {
                            await navigator.clipboard.writeText(url);
                        } else {
                            const tempInput = document.createElement('input');
                            tempInput.value = url;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            tempInput.remove();
                        }
                        copyBtn.classList.add('is-copied');
                        const originalText = copyBtn.textContent;
                        copyBtn.textContent = 'Tersalin';
                        setTimeout(() => {
                            copyBtn.classList.remove('is-copied');
                            copyBtn.textContent = originalText;
                            closeShareGroups();
                        }, 1200);
                    } catch (err) {
                        copyBtn.textContent = 'Gagal menyalin';
                        setTimeout(() => {
                            copyBtn.textContent = 'Salin Link';
                        }, 1400);
                    }
                });
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('[data-share-group]')) {
                closeShareGroups();
            }
        });
    });
</script>
</body>
</html>
