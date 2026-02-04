<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Video - Kementerian Haji dan Umrah Kota Cirebon</title>
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
            background-color: var(--color-primary);
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
            color: var(--color-primary);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

@include('partials.header')

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    
    <!-- Title Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #374151;" data-i18n="gallery.videos.title">
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
                style="background-color: var(--color-primary); color: white;">
            <span>Semua</span>
        </button>
        @foreach(($categories ?? []) as $category)
            <button class="filter-btn px-6 py-2 rounded-full text-sm font-medium transition bg-white border border-gray-300 hover-border-primary" 
                    data-filter="{{ \Illuminate\Support\Str::slug($category->name) }}"
                    style="color: #374151;">
                <span>{{ $category->name }}</span>
            </button>
        @endforeach
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
                 data-category="{{ \Illuminate\Support\Str::slug($video->category ?? '') }}" 
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
                style="background-color: var(--color-primary);"
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
        transition: background-color 0.2s;
    }
    
    .dropdown-item:hover {
        background-color: #f3f4f6;
    }
    
    
    
    .filter-btn.active {
        background-color: var(--color-primary) !important;
        color: white !important;
        border-color: var(--color-primary) !important;
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

        // Filter gallery by category
        const filterButtons = document.querySelectorAll('.filter-btn');
        const videoItems = document.querySelectorAll('.video-item');

        const applyFilter = (filter) => {
            videoItems.forEach(item => {
                const category = (item.dataset.category || '').toLowerCase();
                item.style.display = (filter === 'all' || category === filter) ? '' : 'none';
            });
        };

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = (this.dataset.filter || 'all').toLowerCase();
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.backgroundColor = '#ffffff';
                    btn.style.color = '#374151';
                    btn.style.borderColor = '#d1d5db';
                });
                this.classList.add('active');
                this.style.backgroundColor = 'var(--color-primary)';
                this.style.color = '#ffffff';
                this.style.borderColor = 'var(--color-primary)';
                applyFilter(filter);
            });
        });

        applyFilter('all');
    });

</script>

</body>
</html>
