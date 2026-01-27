<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Kontak - Kementerian Haji dan Umrah Kota Cirebon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    @php
        $alamat = $profil->alamat ?? null;
        $alamatKeterangan = $profil->alamat_keterangan ?? null;
        $telepon = $profil->telepon ?? null;
        $teleponAlt = $profil->telepon_alt ?? null;
        $email = $profil->email ?? null;
        $mapsUrl = $profil->maps_url ?? null;
        $mapsEmbed = $profil->maps_embed ?? null;
        $mapsEmbedKbihu = $profil->maps_embed_kbihu ?? null;
        $mapsEmbedUrl = $mapsEmbed;
        if (empty($mapsEmbedUrl) && !empty($mapsUrl)) {
            if (str_contains($mapsUrl, '/maps/d/')) {
                $parsed = parse_url($mapsUrl);
                $query = [];
                if (!empty($parsed['query'])) {
                    parse_str($parsed['query'], $query);
                }
                if (!empty($query['mid'])) {
                    $mapsEmbedUrl = 'https://www.google.com/maps/d/u/5/embed?mid=' . urlencode($query['mid']);
                }
            }
        }
        $hasAlamat = !empty($alamat) || !empty($alamatKeterangan) || !empty($mapsUrl);
        $hasKontak = !empty($telepon) || !empty($teleponAlt) || !empty($email);
    @endphp
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #374151;" data-i18n="contact.title">
            Kontak Kami
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="contact.subtitle">
            Hubungi kami untuk informasi lebih lanjut tentang layanan Kementerian Haji dan Umrah Kota Cirebon
        </p>
    </div>

    <!-- Contact Information Grid -->
    @if($hasAlamat || $hasKontak)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        
        <!-- Address Card -->
        @if($hasAlamat)
        <div class="bg-white rounded-2xl p-8 shadow-lg">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: var(--color-primary);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2" style="color: #374151;" data-i18n="contact.address.title">Alamat</h3>
                </div>
            </div>
            @if(!empty($alamat))
            <p class="text-gray-700 leading-relaxed mb-4">
                {{ $alamat }}
            </p>
            @endif
            @if(!empty($alamatKeterangan))
            <p class="text-sm text-gray-500 mb-4">
                {{ $alamatKeterangan }}
            </p>
            @endif
            @if(!empty($mapsUrl))
            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center gap-2 text-white px-6 py-3 rounded-lg font-medium transition hover:opacity-90" 
               style="background-color: var(--color-primary);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <span data-i18n="contact.address.map">Buka di Google Maps</span>
            </a>
            @endif
        </div>
        @endif

        <!-- Contact Info Card -->
        @if($hasKontak)
        <div class="bg-white rounded-2xl p-8 shadow-lg">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: var(--color-primary);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2" style="color: #374151;" data-i18n="contact.info.title">Hubungi Kami</h3>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1" data-i18n="contact.info.phone">Telepon</p>
                    <p class="text-gray-700">
                        @if(!empty($telepon))
                            {{ $telepon }}
                        @endif
                        @if(!empty($telepon) && !empty($teleponAlt))
                            <br>
                        @endif
                        @if(!empty($teleponAlt))
                            {{ $teleponAlt }}
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1" data-i18n="contact.info.email">Email</p>
                    @if(!empty($email))
                        <a href="mailto:{{ $email }}" class="text-gray-700 hover:underline">
                            {{ $email }}
                        </a>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Google Maps Section -->
    @if(!empty($mapsEmbedUrl))
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-12">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold" style="color: #374151;" data-i18n="contact.map.title">Lokasi Kami di Peta</h2>
            <p class="text-gray-600 mt-2" data-i18n="contact.map.subtitle">Klik peta di bawah untuk melihat lokasi lengkap di Google Maps</p>
        </div>
        <div class="relative" style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe 
                src="{{ $mapsEmbedUrl }}" 
                width="100%" 
                height="100%" 
                style="position: absolute; top: 0; left: 0; border: 0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi Kementerian Haji dan Umrah Kota Cirebon">
            </iframe>
        </div>
        <div class="p-6 text-center">
            @if(!empty($mapsUrl))
            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center gap-2 text-white px-6 py-3 rounded-lg font-medium transition hover:opacity-90" 
               style="background-color: var(--color-primary);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span data-i18n="contact.map.open">Buka di Google Maps</span>
            </a>
            @endif
        </div>
    </div>
    @endif

    @if(!empty($mapsEmbedKbihu))
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-12">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold" style="color: #374151;">Lokasi KBIHU & PPIU di Peta</h2>
            <p class="text-gray-600 mt-2">Klik peta di bawah untuk melihat lokasi KBIHU dan PPIU di Google My Maps</p>
        </div>
        <div class="relative" style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe 
                src="{{ $mapsEmbedKbihu }}" 
                width="100%" 
                height="100%" 
                style="position: absolute; top: 0; left: 0; border: 0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi KBIHU dan PPIU di Kota Cirebon">
            </iframe>
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
