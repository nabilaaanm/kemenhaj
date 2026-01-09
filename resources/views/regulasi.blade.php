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
        <!-- Regulation Card 1 -->
        <article class="regulasi-card bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition" data-category="perpres">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <span class="inline-block badge-custom text-black text-xs font-bold px-3 py-1 rounded mb-3">
                        PERATURAN PRESIDEN
                    </span>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Peraturan Presiden (Perpres) Nomor 92 Tahun 2025 tentang Kementerian Haji dan Umrah
                    </h3>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>10 November 2025</span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ asset('pdf/Peraturan Presiden (Perpres) Nomor 92 Tahun 2025 tentang Kementerian Haji dan Umrah.pdf') }}" download class="btn-custom text-black font-semibold px-6 py-2.5 rounded-lg text-sm inline-flex items-center gap-2 hover:bg-opacity-90 transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span data-i10n="regulasi.download" style="vertical-align: middle;">Download</span>
                    </a>
                </div>
            </div>
        </article>

        <!-- Regulation Card 2 -->
        <article class="regulasi-card bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition" data-category="uu">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <span class="inline-block badge-custom text-black text-xs font-bold px-3 py-1 rounded mb-3">
                        UNDANG UNDANG
                    </span>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Undang-undang (UU) Nomor 14 Tahun 2025 tentang Perubahan Ketiga atas Undang-Undang Nomor 8 Tahun 2019 tentang Ibadah Haji dan Umrah
                    </h3>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>10 November 2025</span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ asset('pdf/Undang-undang (UU) Nomor 14 Tahun 2025 tentang Perubahan Ketiga atas Undang-Undang Nomor 8 Tahun 2019 tentang Ibadah Haji dan Umrah.pdf') }}" download class="btn-custom text-black font-semibold px-6 py-2.5 rounded-lg text-sm inline-flex items-center gap-2 hover:bg-opacity-90 transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span data-i18n="regulasi.download" style="vertical-align: middle;">Download</span>
                    </a>
                </div>
            </div>
        </article>
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
            // Close language selector when clicking outside
            if (!e.target.closest('.language-selector')) {
                document.querySelector('.language-selector')?.classList.remove('active');
            }
        });
        
        // Language Selector functionality
        const languageToggle = document.getElementById('languageToggle');
        const languageDropdown = document.getElementById('languageDropdown');
        const currentLang = document.getElementById('currentLang');
        const languageOptions = document.querySelectorAll('.language-option');
        
        // Get saved language from localStorage or default to ID
        let currentLanguage = localStorage.getItem('selectedLanguage') || 'id';
        
        // Apply language function
        function applyLanguage(lang) {
            // Update document language
            document.documentElement.lang = lang;
            
            // Update all elements with data-i18n attribute
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            // Update placeholders
            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                if (translations[lang] && translations[lang][key]) {
                    element.placeholder = translations[lang][key];
                }
            });
            
            // Update title
            document.title = lang === 'id' 
                ? 'Regulasi - Kementerian Haji dan Umrah Kota Cirebon'
                : 'Regulation - Ministry of Hajj and Umrah Cirebon City';
        }
        
        // Translation object
        const translations = {
            id: {
                // Navigation
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
                // Regulasi
                'regulasi.title': 'Regulasi',
                'regulasi.subtitle': 'Kumpulan peraturan dan regulasi terkait penyelenggaraan haji dan umrah',
                'regulasi.searchPlaceholder': 'Cari regulasi...',
                'regulasi.searchBtn': 'Cari',
                'regulasi.filterTitle': 'Filter Berdasarkan Kategori',
                'regulasi.filterAll': 'Semua',
                'regulasi.filterUU': 'Undang Undang',
                'regulasi.filterPP': 'Peraturan Pemerintah',
                'regulasi.filterPerpres': 'Peraturan Presiden',
                'regulasi.filterPermen': 'Peraturan Menteri',
                'regulasi.filterKepmen': 'Keputusan Menteri',
                'regulasi.filterKepsekjen': 'Keputusan Sekretaris Jenderal',
                'regulasi.filterKepdirjen': 'Keputusan Direktur Jenderal',
                'regulasi.filterKepinsjen': 'Keputusan Inspektur Jenderal',
                'regulasi.filterLainnya': 'Peraturan Lainnya',
                'regulasi.download': 'Download'
            },
            en: {
                // Navigation
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
                // Regulasi
                'regulasi.title': 'Regulation',
                'regulasi.subtitle': 'Collection of regulations and rules related to the organization of Hajj and Umrah',
                'regulasi.searchPlaceholder': 'Search regulations...',
                'regulasi.searchBtn': 'Search',
                'regulasi.filterTitle': 'Filter by Category',
                'regulasi.filterAll': 'All',
                'regulasi.filterUU': 'Law',
                'regulasi.filterPP': 'Government Regulation',
                'regulasi.filterPerpres': 'Presidential Regulation',
                'regulasi.filterPermen': 'Ministerial Regulation',
                'regulasi.filterKepmen': 'Ministerial Decree',
                'regulasi.filterKepsekjen': 'Secretary General Decree',
                'regulasi.filterKepdirjen': 'Director General Decree',
                'regulasi.filterKepinsjen': 'Inspector General Decree',
                'regulasi.filterLainnya': 'Other Regulations',
                'regulasi.download': 'Download'
            }
        };
        
        // Apply language changes
        function applyLanguage(lang) {
            // Update document language
            document.documentElement.lang = lang;
            
            // Update all elements with data-i18n attribute
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            // Update placeholders
            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                if (translations[lang] && translations[lang][key]) {
                    element.placeholder = translations[lang][key];
                }
            });
            
            // Update title
            document.title = lang === 'id' 
                ? 'Regulasi - Kementerian Haji dan Umrah Kota Cirebon'
                : 'Regulation - Ministry of Hajj and Umrah Cirebon City';
        }
        
        // Initialize language
        function initLanguage() {
            const langCode = currentLanguage === 'id' ? 'ID' : 'EN';
            currentLang.textContent = langCode;
            
            // Update active state
            languageOptions.forEach(option => {
                if (option.dataset.lang === currentLanguage) {
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
            
            // Apply language changes
            applyLanguage(currentLanguage);
        }
        
        // Toggle language dropdown
        if (languageToggle) {
            languageToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelector('.language-selector')?.classList.toggle('active');
            });
        }
        
        // Handle language selection
        languageOptions.forEach(option => {
            option.addEventListener('click', function() {
                const selectedLang = this.dataset.lang;
                const selectedCode = this.dataset.code;
                
                // Update current language
                currentLanguage = selectedLang;
                currentLang.textContent = selectedCode;
                
                // Save to localStorage
                localStorage.setItem('selectedLanguage', selectedLang);
                
                // Update active state
                languageOptions.forEach(opt => {
                    opt.classList.remove('active');
                });
                this.classList.add('active');
                
                // Apply language
                applyLanguage(selectedLang);
                
                // Close dropdown
                document.querySelector('.language-selector')?.classList.remove('active');
            });
        });
        
        // Initialize language
        function initLanguage() {
            const langCode = currentLanguage === 'id' ? 'ID' : 'EN';
            if (currentLang) {
                currentLang.textContent = langCode;
            }
            
            // Update active state
            languageOptions.forEach(option => {
                if (option.dataset.lang === currentLanguage) {
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
            
            // Apply language changes
            applyLanguage(currentLanguage);
        }
        
        // Initialize on page load
        initLanguage();
        
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const regulasiCards = document.querySelectorAll('.regulasi-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active state
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Get selected category
                const category = this.dataset.category;
                
                // Filter cards
                regulasiCards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
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

