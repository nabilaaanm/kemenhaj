<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Struktur Organisasi - Kementerian Haji dan Umrah Kota Cirebon</title>
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
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #374151;" data-i18n="structure.title">
            Struktur Organisasi
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="structure.subtitle">
            Struktur organisasi dan tim kerja Kementerian Haji dan Umrah Kota Cirebon
        </p>
    </div>

    <!-- Organization Chart Section -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8" style="color: #374151;" data-i18n="structure.chart.title">
            Bagan Struktur Organisasi
        </h2>
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 overflow-hidden">
            <div class="w-full">
                <img src="{{ asset('image/struktur-organisasi.png') }}" 
                     alt="Struktur Organisasi Kementerian Haji dan Umrah Kota Cirebon" 
                     class="w-full h-auto rounded-lg"
                     onerror="this.src='https://via.placeholder.com/1200x800/ECB176/FFFFFF?text=Struktur+Organisasi+Kemenhaj+Cirebon'; this.onerror=null;">
            </div>
        </div>
    </div>

    <!-- Staff Gallery Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-center mb-8" style="color: #374151;" data-i18n="structure.staff.title">
            Tim Kerja Kemenhaj Kota Cirebon
        </h2>
        
        <!-- Staff Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Staff Card 1 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-1.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+1'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name1">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position1">Jabatan</p>
            </div>

            <!-- Staff Card 2 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-2.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+2'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name2">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position2">Jabatan</p>
            </div>

            <!-- Staff Card 3 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-3.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+3'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name3">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position3">Jabatan</p>
            </div>

            <!-- Staff Card 4 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-4.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+4'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name4">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position4">Jabatan</p>
            </div>

            <!-- Staff Card 5 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-5.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+5'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name5">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position5">Jabatan</p>
            </div>

            <!-- Staff Card 6 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-6.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+6'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name6">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position6">Jabatan</p>
            </div>

            <!-- Staff Card 7 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-7.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+7'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name7">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position7">Jabatan</p>
            </div>

            <!-- Staff Card 8 -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                <div class="mb-4">
                    <img src="{{ asset('image/staff/staff-8.jpg') }}" 
                         alt="Staff Kemenhaj" 
                         class="w-full aspect-square object-cover rounded-lg mb-3"
                         onerror="this.src='https://via.placeholder.com/300x300/ECB176/FFFFFF?text=Staff+8'; this.onerror=null;">
                </div>
                <h3 class="font-semibold text-gray-800 mb-1" data-i18n="structure.staff.name8">Nama Staff</h3>
                <p class="text-sm text-gray-600" data-i18n="structure.staff.position8">Jabatan</p>
            </div>

        </div>
    </div>

</main>

@include('partials.footer')

<style>
    /* Header styles */
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
    
    /* Custom primary color text */
    .text-custom-primary {
        color: #ECB176;
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
        transition: background-color 0.2s;
    }
    
    .dropdown-item:hover {
        background-color: #f3f4f6;
    }
    
    /* Language Selector */
    .language-selector {
        position: relative;
    }
    
    .language-toggle {
        cursor: pointer;
    }
    
    .language-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 8px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-width: 150px;
        padding: 8px 0;
        z-index: 50;
    }
    
    .language-selector.active .language-dropdown {
        display: block;
    }
    
    .language-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 8px 16px;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .language-option:hover {
        background-color: #f3f4f6;
    }
    
    .language-option.active {
        background-color: #fef3e2;
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
                'nav.international': 'Internasional',
                'nav.national': 'Nasional',
                'nav.regional': 'Daerah',
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
                'nav.documentation': 'Dokumentasi Kegiatan',
                'nav.regulation': 'Regulasi',
                'search.placeholder': 'Cari berita',
                'footer.address': 'Alamat',
                'footer.contact': 'Hubungi Kami',
                'footer.platform': 'Platform',
                // Structure Page
                'structure.title': 'Struktur Organisasi',
                'structure.subtitle': 'Struktur organisasi dan tim kerja Kementerian Haji dan Umrah Kota Cirebon',
                'structure.chart.title': 'Bagan Struktur Organisasi',
                'structure.staff.title': 'Tim Kerja Kemenhaj Kota Cirebon',
                'structure.staff.name1': 'Nama Staff',
                'structure.staff.position1': 'Jabatan',
                'structure.staff.name2': 'Nama Staff',
                'structure.staff.position2': 'Jabatan',
                'structure.staff.name3': 'Nama Staff',
                'structure.staff.position3': 'Jabatan',
                'structure.staff.name4': 'Nama Staff',
                'structure.staff.position4': 'Jabatan',
                'structure.staff.name5': 'Nama Staff',
                'structure.staff.position5': 'Jabatan',
                'structure.staff.name6': 'Nama Staff',
                'structure.staff.position6': 'Jabatan',
                'structure.staff.name7': 'Nama Staff',
                'structure.staff.position7': 'Jabatan',
                'structure.staff.name8': 'Nama Staff',
                'structure.staff.position8': 'Jabatan'
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
                'nav.international': 'International',
                'nav.national': 'National',
                'nav.regional': 'Regional',
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
                'nav.documentation': 'Activity Documentation',
                'nav.regulation': 'Regulation',
                'search.placeholder': 'Search news',
                'footer.address': 'Address',
                'footer.contact': 'Contact Us',
                'footer.platform': 'Platform',
                // Structure Page
                'structure.title': 'Organization Structure',
                'structure.subtitle': 'Organization structure and team of the Ministry of Hajj and Umrah of Cirebon City',
                'structure.chart.title': 'Organization Chart',
                'structure.staff.title': 'Kemenhaj Cirebon City Team',
                'structure.staff.name1': 'Staff Name',
                'structure.staff.position1': 'Position',
                'structure.staff.name2': 'Staff Name',
                'structure.staff.position2': 'Position',
                'structure.staff.name3': 'Staff Name',
                'structure.staff.position3': 'Position',
                'structure.staff.name4': 'Staff Name',
                'structure.staff.position4': 'Position',
                'structure.staff.name5': 'Staff Name',
                'structure.staff.position5': 'Position',
                'structure.staff.name6': 'Staff Name',
                'structure.staff.position6': 'Position',
                'structure.staff.name7': 'Staff Name',
                'structure.staff.position7': 'Position',
                'structure.staff.name8': 'Staff Name',
                'structure.staff.position8': 'Position'
            }
        };
        
        // Function to update language
        function updateLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('selectedLanguage', lang);
            
            // Update all elements with data-i18n attribute
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });
            
            // Update placeholder
            const searchInput = document.getElementById('searchInput');
            if (searchInput && translations[lang]['search.placeholder']) {
                searchInput.placeholder = translations[lang]['search.placeholder'];
            }
            
            // Update current language display
            if (currentLang) {
                currentLang.textContent = lang === 'id' ? 'ID' : 'EN';
            }
            
            // Update active language option
            languageOptions.forEach(option => {
                if (option.getAttribute('data-lang') === lang) {
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
        }
        
        // Initialize language
        updateLanguage(currentLanguage);
        
        // Language toggle click
        if (languageToggle) {
            languageToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelector('.language-selector')?.classList.toggle('active');
            });
        }
        
        // Language option click
        languageOptions.forEach(option => {
            option.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                updateLanguage(lang);
                document.querySelector('.language-selector')?.classList.remove('active');
            });
        });
    });
</script>

</body>
</html>
