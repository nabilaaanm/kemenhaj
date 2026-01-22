<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Pengumuman - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #111827;" data-i18n="pengumuman.title">
            Pengumuman
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="pengumuman.subtitle">
            Pengumuman Resmi Kementerian Haji dan Umrah
        </p>
    </div>

    <!-- Search Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center max-w-3xl mx-auto">
            <div class="flex-1 w-full relative">
                <input type="text" id="pengumumanSearch" data-i18n-placeholder="pengumuman.searchPlaceholder" placeholder="Cari pengumuman..." 
                    class="w-full border rounded-lg px-4 py-3 text-sm focus-custom"
                    style="min-width: 0;">
                <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button class="btn-custom text-black font-semibold px-8 py-3 rounded-lg text-sm whitespace-nowrap flex items-center gap-2" id="searchBtn" data-i18n="pengumuman.searchBtn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-3 justify-center">
            <button class="category-tab active px-6 py-2 text-sm font-medium rounded-lg transition" data-category="semua" data-i18n="pengumuman.tab.all">
                Semua
            </button>
            <button class="category-tab px-6 py-2 text-sm font-medium rounded-lg transition" data-category="seleksi" data-i18n="pengumuman.tab.seleksi">
                Seleksi
            </button>
            <button class="category-tab px-6 py-2 text-sm font-medium rounded-lg transition" data-category="pelayanan" data-i18n="pengumuman.tab.pelayanan">
                Pelayanan
            </button>
            <button class="category-tab px-6 py-2 text-sm font-medium rounded-lg transition" data-category="lainnya" data-i18n="pengumuman.tab.lainnya">
                Lainnya
            </button>
        </div>
    </div>

    <!-- News Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="pengumumanGrid">
        <!-- News Card 1 -->
        <article class="pengumuman-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="seleksi">
            <div class="relative">
                <img src="/berita1.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Seleksi</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">24 Desember 2025</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Pengumuman Seleksi PPIH Layanan Perlindungan Jemaah
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Kementerian Haji dan Umrah mengumumkan dibukanya seleksi untuk Petugas Penyelenggara Ibadah Haji (PPIH) Layanan Perlindungan Jemaah tahun 1447H/2026M.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: var(--color-primary);">#Seleksi PPIH</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: var(--color-primary);" data-i18n="pengumuman.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 2 -->
        <article class="pengumuman-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="seleksi">
            <div class="relative">
                <img src="/berita2.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Seleksi</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">20 Desember 2025</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Hasil Seleksi PPIH Arab Saudi Tingkat Pusat
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Pengumuman hasil seleksi Petugas Penyelenggara Ibadah Haji (PPIH) Arab Saudi tingkat pusat untuk tahun 1447H/2026M.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: var(--color-primary);">#Hasil Seleksi</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: var(--color-primary);" data-i18n="pengumuman.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 3 -->
        <article class="pengumuman-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="pelayanan">
            <div class="relative">
                <img src="/berita3.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Pelayanan</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">6 Desember 2025</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Seleksi Petugas Penyelenggara Ibadah Haji Arab Saudi
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Dibuka pendaftaran untuk seleksi petugas penyelenggara ibadah haji Arab Saudi untuk tahun 1447H/2026M.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: var(--color-primary);">#Seleksi PPIH</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: var(--color-primary);" data-i18n="pengumuman.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-center gap-2 mb-8">
        <button class="px-4 py-2 border rounded text-sm hover:bg-gray-100">Previous</button>
        <button class="px-4 py-2 border rounded text-sm bg-gray-100">1</button>
        <button class="px-4 py-2 border rounded text-sm hover:bg-gray-100">2</button>
        <button class="px-4 py-2 border rounded text-sm hover:bg-gray-100">3</button>
        <button class="px-4 py-2 border rounded text-sm hover:bg-gray-100">Next</button>
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
    
    /* Button primary */
    .btn-custom {
        background-color: var(--color-primary);
        transition: background-color 0.2s;
    }
    .btn-custom:hover {
        background-color: var(--color-primary-dark);
    }
    
    /* Footer */
    .footer-custom {
        background-color: var(--color-primary);
    }
    
    /* Category Tab */
    .category-tab {
        background-color: #F3F4F6;
        color: #6B7280;
    }
    
    .category-tab:hover {
        background-color: #E5E7EB;
    }
    
    .category-tab.active {
        background-color: var(--color-primary);
        color: #000;
        font-weight: 600;
    }
    
    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
    
    
    
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Category tab functionality
        const categoryTabs = document.querySelectorAll('.category-tab');
        
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const category = this.dataset.category;
                
                // Update active tab
                categoryTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Filter cards
                const pengumumanCards = document.querySelectorAll('.pengumuman-card');
                pengumumanCards.forEach(card => {
                    if (category === 'semua' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Search functionality
        const searchInput = document.getElementById('pengumumanSearch');
        const searchBtn = document.getElementById('searchBtn');
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            const pengumumanCards = document.querySelectorAll('.pengumuman-card');
            pengumumanCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const content = card.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || content.includes(searchTerm)) {
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
        
        // Dropdown menu functionality
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

</script>

</body>
</html>

