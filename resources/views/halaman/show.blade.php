<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    @include('partials.favicon')
    <title>{{ $page->title }} - {{ $siteSetting->title_suffix }}</title>
    @include('partials.assets')
    @include('partials.rich-content-styles')
    <style>
        * {
            box-sizing: border-box;
        }
        html {
            overflow-x: hidden;
            width: 100%;
            font-size: 16px;
        }
        body {
            overflow-x: hidden;
            width: 100%;
            min-width: 320px;
            max-width: 100vw;
            position: relative;
            margin: 0;
            padding: 0;
        }
        .container-fixed {
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            padding-left: 24px;
            padding-right: 24px;
            box-sizing: border-box;
        }
        @media (max-width: 640px) {
            .container-fixed {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        /* Prevent zoom layout shift */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Fixed dimensions for all containers */
        header, main, section, footer {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Prevent text scaling on zoom */
        h1, h2, h3, h4, h5, h6, p, span, a, button {
            text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
        }
        .hover-custom { transition: color 0.2s; }
        .hover-custom:hover { color: var(--color-primary); }
        .focus-custom:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 1px var(--color-primary); }
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

        /* Footer */
        .footer-custom {
            background-color: var(--color-primary);
        }
        .footer-text {
            color: var(--footer-text) !important;
        }
        .footer-muted {
            color: var(--footer-muted) !important;
        }
        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            padding-left: 24px;
            padding-right: 24px;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
@include('partials.header')

<main class="container-fixed py-10">
    <div class="mb-6">
        <h1 class="text-3xl md:text-4xl font-bold page-title">{{ $page->title }}</h1>
        @if($page->description)
            <p class="text-gray-600 mt-2">{{ $page->description }}</p>
        @endif
    </div>

    @if($page->cover_url)
        <img src="{{ $page->cover_url }}" alt="{{ $page->title }}" class="w-full rounded-lg mb-6" style="max-height: 420px; object-fit: cover;">
    @endif

    @if($page->content)
        <div class="rich-content">
            {!! $page->content !!}
        </div>
    @endif

    <div class="mt-10 grid md:grid-cols-2 gap-4 text-sm text-gray-700 bg-white rounded-lg p-4 border">
        <div><strong>Editor:</strong> {{ $page->editor ?: '-' }}</div>
        <div><strong>Kontributor:</strong> {{ $page->contributor ?: '-' }}</div>
        <div><strong>Fotografer:</strong> {{ $page->photographer ?: '-' }}</div>
        <div><strong>Sumber:</strong> {{ $page->source ?: '-' }}</div>
        <div><strong>Lainnya:</strong> {{ $page->other_info ?: '-' }}</div>
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
    });
</script>
</body>
</html>
