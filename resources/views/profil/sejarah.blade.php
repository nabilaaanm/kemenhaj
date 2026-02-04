<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Sejarah - Kementerian Haji dan Umrah Kota Cirebon</title>
    @include('partials.assets')
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        main {
            flex: 1;
        }
        
        /* Prevent text scaling on zoom */
        h1, h2, h3, h4, h5, h6, p, span, a, button {
            text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    @php
        $rawSejarah = $profil?->sejarah_konten ?? '';
        $decodedSejarah = json_decode($rawSejarah, true);
        $sejarahCards = is_array($decodedSejarah) ? $decodedSejarah : [];
        $hasCustomSejarah = !empty($profil?->sejarah_judul)
            || !empty($profil?->sejarah_subjudul)
            || !empty($rawSejarah);
    @endphp
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #374151;">
            {{ $profil?->sejarah_judul ?? 'Sejarah Kementerian Haji dan Umrah Kota Cirebon' }}
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            {{ $profil?->sejarah_subjudul ?? 'Perjalanan panjang dalam melayani jemaah haji dan umrah di Kota Cirebon' }}
        </p>
    </div>

    @if($hasCustomSejarah)
        @if(!empty($sejarahCards))
            <div class="max-w-4xl mx-auto">
                @foreach($sejarahCards as $card)
                    @php
                        $emptyCard = empty($card['label']) && empty($card['period']) && empty($card['title']) && empty($card['description']);
                    @endphp
                    @continue($emptyCard)
                    <div class="mb-12 relative">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="md:w-1/3 text-right md:pr-8">
                                <div class="text-2xl font-bold mb-2" style="color: var(--color-primary);">
                                    {{ $card['label'] ?? '' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $card['period'] ?? '' }}
                                </div>
                            </div>
                            <div class="md:w-2/3 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: var(--color-primary);"></div>
                                <div class="ml-6 md:ml-8">
                                    <div class="absolute left-0 top-2 w-4 h-4 rounded-full border-4 border-white" style="background-color: var(--color-primary); margin-left: -8px;"></div>
                                    <div class="bg-white rounded-xl shadow-lg p-6">
                                        <h3 class="text-xl font-bold mb-3" style="color: #374151;">
                                            {{ $card['title'] ?? '' }}
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed">
                                            {!! nl2br(e($card['description'] ?? '')) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($rawSejarah)) !!}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-10 text-center">
                <div class="text-2xl font-bold mb-2" style="color: var(--color-primary);">Coming Soon</div>
                <p class="text-gray-600">Sejarah belum tersedia saat ini.</p>
            </div>
        </div>
    @endif

</main>

@include('partials.footer')

<style>
    /* Header styles */
    .hover-custom:hover {
        color: var(--color-primary);
    }
    
    /* Input focus */
    .focus-custom:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 1px var(--color-primary);
    }
    
    /* Badge primary */
    .badge-custom {
        background-color: var(--color-primary);
    }
    
    /* Custom primary color text */
    .text-custom-primary {
        color: var(--color-primary);
    }
    
    /* Footer */
    .footer-custom {
        background-color: var(--color-primary);
    }
    
    /* Dropdown Menu Styles */
    .dropdown-menu {
        position: relative;
    }
    
    .dropdown-toggle {
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-size: inherit;
        font-weight: inherit;
        color: inherit;
    }
    
    .dropdown-toggle svg {
        transition: transform 0.2s;
    }
    
    .dropdown-menu:hover .dropdown-toggle svg,
    .dropdown-menu.active .dropdown-toggle svg {
        transform: rotate(180deg);
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 8px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-width: 200px;
        padding: 8px 0;
        z-index: 50;
    }
    
    .dropdown-menu:hover .dropdown-content,
    .dropdown-menu.active .dropdown-content {
        display: block;
    }
    
    .dropdown-item {
        display: block;
        padding: 8px 16px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .dropdown-item:hover {
        background-color: var(--color-primary-bg);
        color: var(--color-primary);
        padding-left: 24px;
    }
    
    
</style>

<script>
    // Dropdown menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.closest('.dropdown-menu');
                
                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('active');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('active');
            });
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-menu')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
        });

</script>

</body>
</html>
