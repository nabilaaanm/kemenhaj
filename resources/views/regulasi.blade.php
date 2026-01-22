<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Regulasi - Kementerian Haji dan Umrah Kota Cirebon</title>
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
    
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #8B6914;" data-i18n="regulasi.title">
            Regulasi
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="regulasi.subtitle">
            Kumpulan peraturan dan regulasi terkait penyelenggaraan haji dan umrah
        </p>
    </div>

    <!-- Search Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center max-w-2xl mx-auto">
            <div class="flex-1 w-full">
                <input type="text" id="regulasiSearch" data-i18n-placeholder="regulasi.searchPlaceholder" placeholder="Cari regulasi..."
                    class="w-full border rounded-lg px-4 py-3 text-sm focus-custom"
                    style="min-width: 0;">
            </div>
            <button class="btn-custom text-black font-semibold px-6 py-3 rounded-lg text-sm whitespace-nowrap flex items-center gap-2" id="searchBtn" data-i18n="regulasi.searchBtn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-700" data-i18n="regulasi.filterTitle">
            Filter Berdasarkan Kategori
        </h2>
        <div class="flex flex-wrap gap-3">
            <button class="filter-btn active" data-category="all" data-i18n="regulasi.filterAll">Semua</button>
            <button class="filter-btn" data-category="uu" data-i18n="regulasi.filterUU">Undang Undang</button>
            <button class="filter-btn" data-category="perpres" data-i18n="regulasi.filterPerpres">Peraturan Presiden</button>
            <button class="filter-btn" data-category="lainnya" data-i18n="regulasi.filterLainnya">Peraturan Lainnya</button>
        </div>
    </div>

    <!-- Regulation List -->
    <div class="space-y-4" id="regulasiList">
        @php
            $regulations = $regulations ?? collect([]);
        @endphp
        
        @forelse($regulations as $regulation)
            <article class="regulasi-card bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition" data-category="{{ $regulation->category }}">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <span class="inline-block badge-custom text-black text-xs font-bold px-3 py-1 rounded mb-3">
                            {{ $regulation->badge_text }}
                        </span>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{ $regulation->title }}
                        </h3>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $regulation->regulation_date->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        @if($regulation->file_url)
                            <a href="{{ $regulation->file_url }}" download class="btn-custom text-black font-semibold px-6 py-2.5 rounded-lg text-sm inline-flex items-center gap-2 hover:bg-opacity-90 transition">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span data-i18n="regulasi.download" style="vertical-align: middle;">Download</span>
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">Tidak ada file</span>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-600">Belum ada regulasi yang ditampilkan.</p>
            </div>
        @endforelse
    </div>
</main>

@include('partials.footer')

<style>
    /* Custom Color ECB176 */
    :root {
        --color-primary: #ECB176;
        --color-primary-dark: #D99D5F;
        --color-primary-light: #F5C99A;
        --color-primary-bg: #F9E6D0;
    }
    
    /* Navigation hover */
    .hover-custom {
        transition: color 0.2s;
    }
    .hover-custom:hover {
        color: #ECB176;
    }
    
    /* Input focus */
    .focus-custom:focus {
        outline: none;
        border-color: #ECB176;
        box-shadow: 0 0 0 1px #ECB176;
    }
    
    /* Badge primary */
    .badge-custom {
        background-color: #ECB176;
    }
    
    /* Button primary */
    .btn-custom {
        background-color: #ECB176;
        transition: background-color 0.2s;
    }
    .btn-custom:hover {
        background-color: #D99D5F;
    }
    
    /* Filter Buttons */
    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #F3F4F6;
        color: #374151;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    
    .filter-btn:hover {
        background-color: #E5E7EB;
    }
    
    .filter-btn.active {
        background-color: #ECB176;
        color: #000;
        font-weight: 600;
    }
    
    /* Regulation Card */
    .regulasi-card {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
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
    
    /* Footer */
    .footer-custom {
        background-color: #ECB176;
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
        background-color: #F9E6D0;
        color: #ECB176;
        padding-left: 24px;
    }
    
    /* Active state for dropdown toggle */
    .dropdown-menu:hover .dropdown-toggle,
    .dropdown-menu.active .dropdown-toggle {
        color: #ECB176;
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
        const searchInput = document.getElementById('regulasiSearch');
        const searchBtn = document.getElementById('searchBtn');
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            regulasiCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const category = card.querySelector('span').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        if (searchBtn) {
            searchBtn.addEventListener('click', performSearch);
        }
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        }
    });
</script>

</body>
</html>

