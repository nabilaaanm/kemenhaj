<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>{{ $post->title }} - Kementerian Haji dan Umrah Kota Cirebon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        .container-fixed { max-width: 960px; margin: 0 auto; width: 100%; padding: 0 24px; }
        .hover-custom { transition: color 0.2s; }
        .hover-custom:hover { color: #ECB176; }
        .focus-custom:focus { outline: none; border-color: #ECB176; box-shadow: 0 0 0 1px #ECB176; }
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
        .language-toggle:hover { background-color: #f3f4f6; border-color: #ECB176; }
        .language-option:hover { background-color: #F9E6D0; }
        .language-option span:first-child { font-weight: 600; margin-right: 8px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
@include('partials.header')

<main class="container-fixed py-10">
    <div class="mb-6">
        <span class="inline-block px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">
            {{ $post->category?->name ?? 'Berita' }}
        </span>
        <h1 class="text-3xl md:text-4xl font-bold mt-4">{{ $post->title }}</h1>
        <div class="text-sm text-gray-500 mt-2">
            {{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}
            @if($post->location)
                • {{ $post->location }}
            @endif
        </div>
    </div>

    @if($post->cover_url)
        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" class="w-full rounded-lg mb-6" style="max-height: 420px; object-fit: cover;">
    @endif

    <div class="prose max-w-none">
        {!! nl2br(e($post->content)) !!}
    </div>

    <div class="mt-10 grid md:grid-cols-2 gap-4 text-sm text-gray-700 bg-white rounded-lg p-4 border">
        <div><strong>Editor:</strong> {{ $post->editor_name ?: '-' }}</div>
        <div><strong>Kontributor:</strong> {{ $post->contributor_name ?: '-' }}</div>
        <div><strong>Fotografer:</strong> {{ $post->photographer_name ?: '-' }}</div>
        <div><strong>Penulis:</strong> {{ $post->writer_name ?: '-' }}</div>
        <div><strong>Sumber:</strong> {{ $post->source ?: '-' }}</div>
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


            }
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
        }


                e.preventDefault();
            });
        }

            option.addEventListener('click', function() {
                location.reload();
            });
        });
    });
</script>
</body>
</html>
