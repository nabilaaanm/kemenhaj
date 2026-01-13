<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Foto - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        
        /* Gallery Styles */
        .photo-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .photo-item:hover {
            transform: scale(1.02);
        }
        
        .photo-item img {
            transition: transform 0.3s ease;
        }
        
        .photo-item:hover img {
            transform: scale(1.1);
        }
        
        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .photo-item:hover .photo-overlay {
            opacity: 1;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            overflow: auto;
        }
        
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            margin: auto;
        }
        
        .modal-content img {
            width: 100%;
            height: auto;
            max-height: 90vh;
            object-fit: contain;
        }
        
        .close-modal {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }
        
        .close-modal:hover {
            color: #ECB176;
        }
        
        .modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 30px;
            font-weight: bold;
            padding: 16px;
            cursor: pointer;
            background-color: rgba(0,0,0,0.5);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }
        
        .modal-nav:hover {
            background-color: rgba(236, 177, 118, 0.8);
        }
        
        .modal-prev {
            left: 20px;
        }
        
        .modal-next {
            right: 20px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #374151;" data-i18n="gallery.photos.title">
            Galeri Foto
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="gallery.photos.subtitle">
            Dokumentasi kegiatan dan aktivitas Kementerian Haji dan Umrah Kota Cirebon
        </p>
    </div>

    <!-- Filter Section -->
    <div class="mb-8 flex flex-wrap gap-3 justify-center">
        <button class="filter-btn active px-6 py-2 rounded-full text-sm font-medium transition" 
                data-filter="all" 
                style="background-color: #ECB176; color: white;">
            <span data-i18n="gallery.filter.all">Semua</span>
        </button>
        <button class="filter-btn px-6 py-2 rounded-full text-sm font-medium transition bg-white border border-gray-300 hover:border-ECB176" 
                data-filter="kegiatan"
                style="color: #374151;">
            <span data-i18n="gallery.filter.activity">Kegiatan</span>
        </button>
        <button class="filter-btn px-6 py-2 rounded-full text-sm font-medium transition bg-white border border-gray-300 hover:border-ECB176" 
                data-filter="pelayanan"
                style="color: #374151;">
            <span data-i18n="gallery.filter.service">Pelayanan</span>
        </button>
        <button class="filter-btn px-6 py-2 rounded-full text-sm font-medium transition bg-white border border-gray-300 hover:border-ECB176" 
                data-filter="pembinaan"
                style="color: #374151;">
            <span data-i18n="gallery.filter.guidance">Pembinaan</span>
        </button>
    </div>

    <!-- Photo Gallery Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8" id="photoGallery">
        @php
            $fotos = $fotos ?? collect([]);
        @endphp
        @forelse($fotos as $foto)
            <div class="photo-item bg-white rounded-lg shadow-sm overflow-hidden" data-category="{{ $foto->category ?? 'all' }}">
                <img src="{{ $foto->image_url }}" 
                     alt="{{ $foto->title }}" 
                     class="w-full h-48 object-cover"
                     onerror="this.src='https://via.placeholder.com/400x300/ECB176/FFFFFF?text={{ urlencode($foto->title) }}'; this.onerror=null;">
                <div class="photo-overlay">
                    <p class="text-white text-sm font-medium">{{ $foto->title }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">Belum ada foto yang ditampilkan.</p>
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    <div class="text-center">
        <button class="px-8 py-3 rounded-lg font-medium transition hover:opacity-90 text-white" 
                style="background-color: #ECB176;"
                data-i18n="gallery.loadMore">
            Muat Lebih Banyak
        </button>
    </div>

</main>

<!-- Photo Modal -->
<div id="photoModal" class="modal">
    <span class="close-modal">&times;</span>
    <div class="modal-nav modal-prev" id="prevPhoto">&#10094;</div>
    <div class="modal-nav modal-next" id="nextPhoto">&#10095;</div>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Photo">
    </div>
</div>

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
    
    .filter-btn.active {
        background-color: #ECB176 !important;
        color: white !important;
        border-color: #ECB176 !important;
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
                // Gallery Photos
                'gallery.photos.title': 'Galeri Foto',
                'gallery.photos.subtitle': 'Dokumentasi kegiatan dan aktivitas Kementerian Haji dan Umrah Kota Cirebon',
                'gallery.filter.all': 'Semua',
                'gallery.filter.activity': 'Kegiatan',
                'gallery.filter.service': 'Pelayanan',
                'gallery.filter.guidance': 'Pembinaan',
                'gallery.photos.item1': 'Kegiatan Haji 2024',
                'gallery.photos.item2': 'Pelayanan Jemaah',
                'gallery.photos.item3': 'Pembinaan Jemaah',
                'gallery.photos.item4': 'Kegiatan Umrah',
                'gallery.photos.item5': 'Pelayanan Informasi',
                'gallery.photos.item6': 'Bimbingan Haji',
                'gallery.photos.item7': 'Kegiatan Sosial',
                'gallery.photos.item8': 'Pelayanan Dokumen',
                'gallery.photos.item9': 'Pelatihan Jemaah',
                'gallery.photos.item10': 'Kegiatan Keagamaan',
                'gallery.photos.item11': 'Pelayanan Kesehatan',
                'gallery.photos.item12': 'Konsultasi Haji',
                'gallery.loadMore': 'Muat Lebih Banyak'
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
                // Gallery Photos
                'gallery.photos.title': 'Photo Gallery',
                'gallery.photos.subtitle': 'Documentation of activities and events of the Ministry of Hajj and Umrah of Cirebon City',
                'gallery.filter.all': 'All',
                'gallery.filter.activity': 'Activity',
                'gallery.filter.service': 'Service',
                'gallery.filter.guidance': 'Guidance',
                'gallery.photos.item1': 'Hajj Activity 2024',
                'gallery.photos.item2': 'Pilgrim Service',
                'gallery.photos.item3': 'Pilgrim Guidance',
                'gallery.photos.item4': 'Umrah Activity',
                'gallery.photos.item5': 'Information Service',
                'gallery.photos.item6': 'Hajj Guidance',
                'gallery.photos.item7': 'Social Activity',
                'gallery.photos.item8': 'Document Service',
                'gallery.photos.item9': 'Pilgrim Training',
                'gallery.photos.item10': 'Religious Activity',
                'gallery.photos.item11': 'Health Service',
                'gallery.photos.item12': 'Hajj Consultation',
                'gallery.loadMore': 'Load More'
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
        
        // Photo Gallery Filter
        const filterButtons = document.querySelectorAll('.filter-btn');
        const photoItems = document.querySelectorAll('.photo-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button - remove active from all, add to clicked
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.backgroundColor = '';
                    btn.style.color = '';
                    btn.classList.add('bg-white', 'border', 'border-gray-300');
                    btn.style.color = '#374151';
                });
                this.classList.add('active');
                this.classList.remove('bg-white', 'border', 'border-gray-300');
                this.style.backgroundColor = '#ECB176';
                this.style.color = 'white';
                
                // Filter photos
                photoItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Photo Modal
        const modal = document.getElementById('photoModal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.querySelector('.close-modal');
        const prevPhoto = document.getElementById('prevPhoto');
        const nextPhoto = document.getElementById('nextPhoto');
        let currentPhotoIndex = 0;
        const allPhotos = Array.from(photoItems);
        
        // Open modal on photo click
        photoItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                currentPhotoIndex = index;
                const img = this.querySelector('img');
                modalImage.src = img.src;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
        
        // Close modal
        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
        
        // Close modal on outside click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Navigate photos
        function showPhoto(index) {
            if (index < 0) index = allPhotos.length - 1;
            if (index >= allPhotos.length) index = 0;
            currentPhotoIndex = index;
            const img = allPhotos[index].querySelector('img');
            modalImage.src = img.src;
        }
        
        prevPhoto.addEventListener('click', function(e) {
            e.stopPropagation();
            showPhoto(currentPhotoIndex - 1);
        });
        
        nextPhoto.addEventListener('click', function(e) {
            e.stopPropagation();
            showPhoto(currentPhotoIndex + 1);
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (modal.classList.contains('active')) {
                if (e.key === 'ArrowLeft') {
                    showPhoto(currentPhotoIndex - 1);
                } else if (e.key === 'ArrowRight') {
                    showPhoto(currentPhotoIndex + 1);
                } else if (e.key === 'Escape') {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });
    });
</script>

</body>
</html>
