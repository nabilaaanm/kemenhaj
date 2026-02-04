<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Layanan - Kementerian Haji dan Umrah Kota Cirebon</title>
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
    
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #111827;" data-i18n="layanan.title">
            Layanan Kami
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="layanan.subtitle">
            Layanan digital dan informasi untuk jamaah haji dan umrah
        </p>
    </div>

    <!-- Search Section -->
    <div class="mb-8 max-w-3xl mx-auto">
        <div class="relative">
            <input type="text" id="layananSearch" data-i18n-placeholder="layanan.searchPlaceholder" placeholder="Cari layanan berdasarkan nama atau deskripsi..."
                class="w-full border rounded-lg px-12 py-4 text-sm focus-custom"
                style="min-width: 0;">
            <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <!-- Service Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="layananList">
        @php
            $services = $services ?? collect([]);
        @endphp
        @forelse($services as $service)
            <a href="{{ $service->url }}" target="_blank" rel="noopener noreferrer" 
               class="layanan-card bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition cursor-pointer block" 
               data-service="{{ Str::slug($service->name) }}">
            <div class="flex flex-col h-full">
                    <!-- Logo/Icon -->
                <div class="mb-4 flex-shrink-0">
                        @if($service->icon)
                            <img src="{{ $service->icon_url }}" 
                                 alt="{{ $service->name }}" 
                                 class="w-24 h-24 object-contain"
                                 style="max-width: 96px; max-height: 96px; width: auto; height: auto;"
                                 onerror="this.onerror=null; this.src='{{ asset('image/lambang.png') }}';">
                        @else
                            <img src="{{ asset('image/lambang.png') }}" alt="Logo" class="w-24 h-24 object-contain" style="max-width: 96px; max-height: 96px; width: auto; height: auto;">
                        @endif
                </div>
                
                <!-- Content -->
                <div class="flex-1 flex flex-col">
                        <h3 class="text-xl font-bold mb-3" style="color: #111827;">
                            {{ $service->name }}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-1">
                            {{ $service->description ?? 'Layanan digital untuk jamaah haji dan umrah' }}
                    </p>
                    
                    <!-- Arrow Icon -->
                    <div class="flex justify-end mt-auto">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">Belum ada layanan yang ditampilkan.</p>
            </div>
        @endforelse
    </div>

</main>

@include('partials.footer')

<style>
    /* Navigation hover */
    .hover-custom {
        transition: color 0.2s;
    }
    .hover-custom:hover {
        color: var(--color-primary);
    }
    
    /* Input focus */
    .focus-custom:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 1px var(--color-primary);
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
    
    .dropdown-item {
        display: block;
        padding: 10px 20px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .dropdown-item:hover {
        background-color: var(--color-primary-bg);
        color: var(--color-primary);
        padding-left: 24px;
    }
    
    /* Active state for dropdown toggle */
    .dropdown-menu:hover .dropdown-toggle,
    .dropdown-menu.active .dropdown-toggle {
        color: var(--color-primary);
    }
    
    
    
    
    /* Service Card */
    .layanan-card {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .layanan-card:hover {
        transform: translateY(-4px);
    }
    
    /* Grid stability */
    .grid {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    .grid > * {
        min-width: 0;
        max-width: 100%;
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

        
        // Search functionality
        const searchInput = document.getElementById('layananSearch');
        const layananCards = document.querySelectorAll('.layanan-card');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                layananCards.forEach(card => {
                    const titleElement = card.querySelector('h3');
                    const descriptionElement = card.querySelector('p');
                    
                    if (titleElement && descriptionElement) {
                        const title = titleElement.textContent.toLowerCase();
                        const description = descriptionElement.textContent.toLowerCase();
                    
                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                        }
                    }
                });
            });
        }
    });
</script>

</body>
</html>

