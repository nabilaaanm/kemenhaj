<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Video - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        
        /* Video Styles */
        .video-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .video-item:hover {
            transform: scale(1.02);
        }
        
        .video-thumbnail {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            overflow: hidden;
        }
        
        .video-thumbnail img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background-color: rgba(236, 177, 118, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 2;
        }
        
        .video-item:hover .play-button {
            background-color: #ECB176;
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        .play-button svg {
            width: 24px;
            height: 24px;
            fill: white;
            margin-left: 4px;
        }
        
        .video-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .video-item:hover .video-overlay {
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
        
        .modal-content video,
        .modal-content iframe {
            width: 100%;
            max-width: 1200px;
            height: auto;
            max-height: 90vh;
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #374151;" data-i18n="gallery.videos.title">
            Galeri Video
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="gallery.videos.subtitle">
            Video dokumentasi kegiatan dan informasi dari Kementerian Haji dan Umrah Kota Cirebon
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
                data-filter="informasi"
                style="color: #374151;">
            <span data-i18n="gallery.filter.info">Informasi</span>
        </button>
        <button class="filter-btn px-6 py-2 rounded-full text-sm font-medium transition bg-white border border-gray-300 hover:border-ECB176" 
                data-filter="tutorial"
                style="color: #374151;">
            <span data-i18n="gallery.filter.tutorial">Tutorial</span>
        </button>
    </div>

    <!-- Video Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="videoGallery">
        @php
            $videos = $videos ?? collect([]);
        @endphp
        @forelse($videos as $video)
            @php
                $videoUrl = $video->video_url;
                $isEmbedUrl = $video->url && (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false || strpos($video->url, 'vimeo.com') !== false);
                $isDirectFile = $video->file_path && !empty($video->file_path);
            @endphp
            
            <div class="video-item bg-white rounded-lg shadow-sm overflow-hidden" 
                 data-category="{{ $video->category ?? 'all' }}" 
                 data-video-url="{{ $videoUrl }}"
                 data-video-type="{{ $isEmbedUrl ? 'embed' : ($isDirectFile ? 'file' : 'none') }}">
                
                @if($isEmbedUrl)
                    {{-- Tampilkan embed langsung untuk URL YouTube/Vimeo --}}
                    <div class="video-embed-container" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; background-color: #000;">
                        @php
                            $embedUrl = '';
                            $url = $video->url;
                            
                            // Parse YouTube URL
                            if (strpos($url, 'youtube.com/watch?v=') !== false) {
                                $parts = parse_url($url);
                                parse_str($parts['query'] ?? '', $query);
                                $videoId = $query['v'] ?? '';
                                if ($videoId) {
                                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                }
                            } elseif (strpos($url, 'youtu.be/') !== false) {
                                $parts = parse_url($url);
                                $path = trim($parts['path'] ?? '', '/');
                                if ($path) {
                                    $embedUrl = 'https://www.youtube.com/embed/' . $path;
                                }
                            } elseif (strpos($url, 'youtube.com/embed/') !== false) {
                                $embedUrl = $url;
                            } elseif (strpos($url, 'vimeo.com/') !== false) {
                                $parts = parse_url($url);
                                $path = trim($parts['path'] ?? '', '/');
                                if ($path) {
                                    $embedUrl = 'https://player.vimeo.com/video/' . $path;
                                }
                            }
                        @endphp
                        @if($embedUrl)
                            <iframe src="{{ $embedUrl }}" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        @else
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center;">
                                <p>URL video tidak valid</p>
                            </div>
                        @endif
                    </div>
                @else
                    {{-- Tampilkan thumbnail untuk file video atau jika tidak ada URL --}}
                    <div class="video-thumbnail">
                        <img src="{{ $video->thumbnail_url ?? 'https://via.placeholder.com/800x450/ECB176/FFFFFF?text=Video' }}" 
                             alt="{{ $video->title }}"
                             onerror="this.src='https://via.placeholder.com/800x450/ECB176/FFFFFF?text={{ urlencode($video->title) }}'; this.onerror=null;">
                        <div class="play-button">
                            <svg viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                @endif
                
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">{{ $video->title }}</h3>
                    @if($video->description)
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($video->description, 100) }}</p>
                    @endif
                    @if($video->duration)
                        <p class="text-sm text-gray-600">Durasi: {{ $video->duration }}</p>
                    @endif
                </div>
                
                @if(!$isEmbedUrl)
                    <div class="video-overlay">
                        <p class="text-white text-sm font-medium">{{ $video->title }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">Belum ada video yang ditampilkan.</p>
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

<!-- Video Modal -->
<div id="videoModal" class="modal">
    <span class="close-modal">&times;</span>
    <div class="modal-content" id="videoModalContent">
        <!-- Video will be inserted here -->
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
                // Gallery Videos
                'gallery.videos.title': 'Galeri Video',
                'gallery.videos.subtitle': 'Video dokumentasi kegiatan dan informasi dari Kementerian Haji dan Umrah Kota Cirebon',
                'gallery.filter.all': 'Semua',
                'gallery.filter.activity': 'Kegiatan',
                'gallery.filter.info': 'Informasi',
                'gallery.filter.tutorial': 'Tutorial',
                'gallery.videos.item1': 'Kegiatan Haji 2024',
                'gallery.videos.duration1': 'Durasi: 5:30',
                'gallery.videos.item2': 'Informasi Pendaftaran Haji',
                'gallery.videos.duration2': 'Durasi: 3:45',
                'gallery.videos.item3': 'Tutorial Pendaftaran Online',
                'gallery.videos.duration3': 'Durasi: 8:15',
                'gallery.videos.item4': 'Pelayanan Jemaah Haji',
                'gallery.videos.duration4': 'Durasi: 6:20',
                'gallery.videos.item5': 'Panduan Ibadah Haji',
                'gallery.videos.duration5': 'Durasi: 12:45',
                'gallery.videos.item6': 'Cara Cek Status Pendaftaran',
                'gallery.videos.duration6': 'Durasi: 4:10',
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
                // Gallery Videos
                'gallery.videos.title': 'Video Gallery',
                'gallery.videos.subtitle': 'Video documentation of activities and information from the Ministry of Hajj and Umrah of Cirebon City',
                'gallery.filter.all': 'All',
                'gallery.filter.activity': 'Activity',
                'gallery.filter.info': 'Information',
                'gallery.filter.tutorial': 'Tutorial',
                'gallery.videos.item1': 'Hajj Activity 2024',
                'gallery.videos.duration1': 'Duration: 5:30',
                'gallery.videos.item2': 'Hajj Registration Information',
                'gallery.videos.duration2': 'Duration: 3:45',
                'gallery.videos.item3': 'Online Registration Tutorial',
                'gallery.videos.duration3': 'Duration: 8:15',
                'gallery.videos.item4': 'Hajj Pilgrim Service',
                'gallery.videos.duration4': 'Duration: 6:20',
                'gallery.videos.item5': 'Hajj Worship Guide',
                'gallery.videos.duration5': 'Duration: 12:45',
                'gallery.videos.item6': 'How to Check Registration Status',
                'gallery.videos.duration6': 'Duration: 4:10',
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
        
        // Video Gallery Filter
        const filterButtons = document.querySelectorAll('.filter-btn');
        const videoItems = document.querySelectorAll('.video-item');
        
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
                
                // Filter videos
                videoItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Video Modal
        const modal = document.getElementById('videoModal');
        const modalContent = document.getElementById('videoModalContent');
        const closeModal = document.querySelector('.close-modal');
        
        // Open modal on video click (hanya untuk file video, bukan embed)
        videoItems.forEach(item => {
            const videoType = item.getAttribute('data-video-type');
            
            // Hanya buka modal jika bukan embed (embed sudah langsung ditampilkan)
            if (videoType !== 'embed') {
                item.addEventListener('click', function() {
                    const videoUrl = this.getAttribute('data-video-url');
                    
                    if (!videoUrl) return;
                    
                    let videoHTML = '';
                    
                    // Check if it's a YouTube URL (fallback jika ada)
                    if (videoUrl && (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be'))) {
                        let videoId = '';
                        if (videoUrl.includes('youtube.com/watch?v=')) {
                            videoId = videoUrl.split('v=')[1].split('&')[0];
                        } else if (videoUrl.includes('youtu.be/')) {
                            videoId = videoUrl.split('youtu.be/')[1].split('?')[0];
                        } else if (videoUrl.includes('youtube.com/embed/')) {
                            videoId = videoUrl.split('embed/')[1].split('?')[0];
                        }
                        if (videoId) {
                            videoHTML = `<iframe width="100%" height="600" src="https://www.youtube.com/embed/${videoId}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                        }
                    } else if (videoUrl && videoUrl.includes('vimeo.com')) {
                        // Handle Vimeo
                        let videoId = '';
                        if (videoUrl.includes('vimeo.com/')) {
                            videoId = videoUrl.split('vimeo.com/')[1].split('?')[0];
                        }
                        if (videoId) {
                            videoHTML = `<iframe src="https://player.vimeo.com/video/${videoId}?autoplay=1" width="100%" height="600" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>`;
                        }
                    } else if (videoUrl) {
                        // Direct video file
                        videoHTML = `<video width="100%" height="600" controls autoplay><source src="${videoUrl}" type="video/mp4">Your browser does not support the video tag.</video>`;
                    }
                    
                    if (videoHTML) {
                        modalContent.innerHTML = videoHTML;
                        modal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                });
            }
        });
        
        // Close modal
        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
            modalContent.innerHTML = '';
            document.body.style.overflow = 'auto';
        });
        
        // Close modal on outside click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                modalContent.innerHTML = '';
                document.body.style.overflow = 'auto';
            }
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                modal.classList.remove('active');
                modalContent.innerHTML = '';
                document.body.style.overflow = 'auto';
            }
        });
    });
</script>

</body>
</html>
