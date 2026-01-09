<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Klarifikasi Hoax - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #8B6914;" data-i18n="hoax.title">
            Klarifikasi Hoax
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="hoax.subtitle">
            Klarifikasi Informasi Tidak Benar Seputar Haji dan Umrah
        </p>
    </div>

    <!-- Search Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center max-w-3xl mx-auto">
            <div class="flex-1 w-full relative">
                <input type="text" id="hoaxSearch" data-i18n-placeholder="hoax.searchPlaceholder" placeholder="Cari klarifikasi hoax..." 
                    class="w-full border rounded-lg px-4 py-3 text-sm focus-custom"
                    style="min-width: 0;">
                <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button class="btn-custom text-black font-semibold px-8 py-3 rounded-lg text-sm whitespace-nowrap flex items-center gap-2" id="searchBtn" data-i18n="hoax.searchBtn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </div>
    </div>

    <!-- Empty State Message -->
    <div class="mb-8 text-center">
        <div class="bg-white rounded-lg shadow-sm p-12">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background-color: #F9E6D0;">
                <svg class="w-8 h-8" style="color: #8B6914;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <p class="text-gray-500 text-lg" data-i18n="hoax.empty">
                Tidak ada berita tersedia
            </p>
        </div>
    </div>

    <!-- News Grid (Hidden for now) -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 hidden" id="hoaxGrid">
        <!-- News Card 1 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="siaran-pers">
            <div class="relative">
                <img src="/berita1.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);" data-i18n="berita.category.siaranPers">Siaran Pers</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">8 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Kemenhaj Fokus Penyelenggaraan Haji 1447 H/2026 M: Tepat Waktu, Berkualitas
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Jakarta (Kemenhaj) — Menteri Haji dan Umrah RI menegaskan komitmen pelayanan haji yang tepat waktu, berkualitas tinggi, dan memperkuat perlindungan jemaah.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Media Briefing</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 2 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="siaran-pers">
            <div class="relative">
                <img src="/berita2.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);" data-i18n="berita.category.siaranPers">Siaran Pers</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">8 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Kemenhaj Tegaskan Layanan Haji Siap di Hari Libur
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Kemenhaj tetap membuka layanan kepada jemaah haji di tingkat kabupaten/kota meskipun pada hari libur untuk mempercepat persiapan haji.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Layanan Haji</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 3 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="nasional">
            <div class="relative">
                <img src="/berita3.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Nasional</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">5 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Persiapan Haji 1447H/2026M Masuki Tahap Finalisasi
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Proses persiapan haji tahun 1447H/2026M telah memasuki tahap finalisasi dengan berbagai persiapan matang untuk memastikan keberhasilan penyelenggaraan.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Persiapan Haji</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 4 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="internasional">
            <div class="relative">
                <img src="/berita1.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Internasional</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">3 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Kerjasama Indonesia-Arab Saudi Perkuat Layanan Haji
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Kemenhaj dan Pemerintah Arab Saudi meningkatkan kerjasama untuk memperkuat layanan haji dan kenyamanan jemaah Indonesia.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Kerjasama</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 5 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="siaran-pers">
            <div class="relative">
                <img src="/berita2.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);" data-i18n="berita.category.siaranPers">Siaran Pers</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">2 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Ditjen PEE Kemenhaj Dorong Ekosistem Ekonomi Haji
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Direktorat Jenderal Pengelolaan Ekonomi dan Ekosistem Kemenhaj terus mendorong pengembangan ekosistem ekonomi haji yang berkelanjutan.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Ekonomi Haji</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </article>

        <!-- News Card 6 -->
        <article class="berita-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition" data-category="nasional">
            <div class="relative">
                <img src="/berita3.jpg" alt="Berita" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
                <span class="absolute top-3 left-3 px-3 py-1 rounded text-xs font-semibold text-white" style="background-color: rgba(139, 105, 20, 0.9);">Nasional</span>
            </div>
            <div class="p-5">
                <p class="text-xs text-gray-500 mb-2">1 Januari 2026</p>
                <h3 class="font-semibold text-base mb-3 line-clamp-2">
                    Bimtek Pemvisaan Haji 1447H/2026M Digelar
                </h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                    Direktorat Pelayanan Haji Dalam Negeri Kementerian Haji dan Umrah RI menggelar Bimbingan Teknis Penyelesaian Dokumen Pemvisaan Haji.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-xs" style="color: #ECB176;">#Bimtek</span>
                    <a href="#" class="text-sm font-medium hover:underline" style="color: #ECB176;" data-i18n="berita.readMore">
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
    
    /* Button primary */
    .btn-custom {
        background-color: #ECB176;
        transition: background-color 0.2s;
    }
    .btn-custom:hover {
        background-color: #D99D5F;
    }
    
    /* Footer */
    .footer-custom {
        background-color: #ECB176;
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
        background-color: #ECB176;
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
        background-color: #F9E6D0;
        color: #ECB176;
        padding-left: 24px;
    }
    
    /* Active state for dropdown toggle */
    .dropdown-menu:hover .dropdown-toggle,
    .dropdown-menu.active .dropdown-toggle {
        color: #ECB176;
    }
    
    /* Language Selector Styles */
    .language-selector {
        position: relative;
    }
    
    .language-toggle {
        background: white;
        border: 1px solid #d1d5db;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .language-toggle:hover {
        background-color: #f3f4f6;
        border-color: #ECB176;
    }
    
    .language-toggle svg {
        transition: transform 0.2s;
    }
    
    .language-selector.active .language-toggle svg {
        transform: rotate(180deg);
    }
    
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
    
    .language-selector.active .language-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .language-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 10px 16px;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .language-option:hover {
        background-color: #F9E6D0;
    }
    
    .language-option.active {
        background-color: #F9E6D0;
        color: #ECB176;
    }
    
    .language-option span:first-child {
        font-weight: 600;
        margin-right: 8px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Note: Category tabs removed for hoax page
        // Category tab functionality
        // const categoryTabs = document.querySelectorAll('.category-tab');
                    if (category === 'semua' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Search functionality
        const searchInput = document.getElementById('hoaxSearch');
        const searchBtn = document.getElementById('searchBtn');
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            const hoaxCards = document.querySelectorAll('.berita-card');
            hoaxCards.forEach(card => {
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
            if (!e.target.closest('.language-selector')) {
                document.querySelector('.language-selector')?.classList.remove('active');
            }
        });
        
        // Language Selector functionality
        const languageToggle = document.getElementById('languageToggle');
        const languageDropdown = document.getElementById('languageDropdown');
        const currentLang = document.getElementById('currentLang');
        const languageOptions = document.querySelectorAll('.language-option');
        
        let currentLanguage = localStorage.getItem('selectedLanguage') || 'id';
        
        const translations = {
            id: {
                'nav.home': 'Beranda',
                'nav.profile': 'Profil',
                'nav.about': 'Tentang Kami',
                'nav.vision': 'Visi & Misi',
                'nav.structure': 'Struktur Organisasi',
                'nav.history': 'Sejarah',
                'nav.contact': 'Kontak',
                'nav.news': 'Berita',
                'nav.berita': 'Berita',
                'nav.announcement': 'Pengumuman',
                'nav.press': 'Siaran Pers',
                'nav.hoax': 'Klarifikasi Hoax',
                'nav.services': 'Layanan',
                'nav.data': 'Data dan Informasi',
                'nav.lk': 'LK & PIH',
                'nav.gallery': 'Galeri',
                'nav.photos': 'Foto',
                'nav.videos': 'Video',
                'nav.infographics': 'Infografis',
                'nav.regulation': 'Regulasi',
                'search.placeholder': 'Cari berita',
                'footer.address': 'Alamat',
                'footer.contact': 'Hubungi Kami',
                'footer.platform': 'Platform',
                'hoax.title': 'Klarifikasi Hoax',
                'hoax.subtitle': 'Klarifikasi Informasi Tidak Benar Seputar Haji dan Umrah',
                'hoax.searchPlaceholder': 'Cari klarifikasi hoax...',
                'hoax.searchBtn': 'Cari',
                'hoax.empty': 'Tidak ada berita tersedia',
                'hoax.readMore': 'Baca Selengkapnya →'
            },
            en: {
                'nav.home': 'Home',
                'nav.profile': 'Profile',
                'nav.about': 'About Us',
                'nav.vision': 'Vision & Mission',
                'nav.structure': 'Organization Structure',
                'nav.history': 'History',
                'nav.contact': 'Contact',
                'nav.news': 'News',
                'nav.berita': 'News',
                'nav.announcement': 'Announcement',
                'nav.press': 'Press Release',
                'nav.hoax': 'Hoax Clarification',
                'nav.services': 'Services',
                'nav.data': 'Data and Information',
                'nav.lk': 'LK & PIH',
                'nav.gallery': 'Gallery',
                'nav.photos': 'Photos',
                'nav.videos': 'Videos',
                'nav.infographics': 'Infographics',
                'nav.regulation': 'Regulation',
                'search.placeholder': 'Search news',
                'footer.address': 'Address',
                'footer.contact': 'Contact Us',
                'footer.platform': 'Platform',
                'hoax.title': 'Hoax Clarification',
                'hoax.subtitle': 'Clarification of Incorrect Information Regarding Hajj and Umrah',
                'hoax.searchPlaceholder': 'Search hoax clarification...',
                'hoax.searchBtn': 'Search',
                'hoax.empty': 'No news available',
                'hoax.readMore': 'Read More →'
            }
        };
        
        function applyLanguage(lang) {
            document.documentElement.lang = lang;
            
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                if (translations[lang] && translations[lang][key]) {
                    element.placeholder = translations[lang][key];
                }
            });
            
            document.title = lang === 'id' 
                ? 'Klarifikasi Hoax - Kementerian Haji dan Umrah Kota Cirebon'
                : 'Hoax Clarification - Ministry of Hajj and Umrah Cirebon City';
        }
        
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
            
            applyLanguage(currentLanguage);
        }
        
        if (languageToggle) {
            languageToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelector('.language-selector')?.classList.toggle('active');
            });
        }
        
        languageOptions.forEach(option => {
            option.addEventListener('click', function() {
                const selectedLang = this.dataset.lang;
                const selectedCode = this.dataset.code;
                
                currentLanguage = selectedLang;
                if (currentLang) {
                    currentLang.textContent = selectedCode;
                }
                
                localStorage.setItem('selectedLanguage', selectedLang);
                
                languageOptions.forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                
                applyLanguage(selectedLang);
                
                document.querySelector('.language-selector')?.classList.remove('active');
            });
        });
        
        initLanguage();
    });
</script>

</body>
</html>

