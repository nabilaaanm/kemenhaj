<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Infografis - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        
        /* Infographic Styles */
        .infographic-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .infographic-item:hover {
            transform: scale(1.02);
        }
        
        .infographic-item img {
            transition: transform 0.3s ease;
        }
        
        .infographic-item:hover img {
            transform: scale(1.05);
        }
        
        .infographic-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .infographic-item:hover .infographic-overlay {
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
            color: var(--color-primary);
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #374151;" data-i18n="gallery.infographics.title">
            Galeri Infografis
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="gallery.infographics.subtitle">
            Informasi visual tentang haji, umrah, dan pelayanan Kementerian Haji dan Umrah Kota Cirebon
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

    <!-- Infographic Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="infographicGallery">
        @php
            $infografis = $infografis ?? collect([]);
        @endphp
        @forelse($infografis as $infografisItem)
            <div class="infographic-item bg-white rounded-lg shadow-sm overflow-hidden" data-category="{{ \Illuminate\Support\Str::slug($infografisItem->category ?? '') }}">
                <img src="{{ $infografisItem->image_url }}" 
                     alt="{{ $infografisItem->title }}" 
                     class="w-full h-auto"
                     onerror="this.src='https://via.placeholder.com/800x1000/ECB176/FFFFFF?text={{ urlencode($infografisItem->title) }}'; this.onerror=null;">
                <div class="infographic-overlay">
                    <p class="text-white text-sm font-medium">{{ $infografisItem->title }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">Belum ada infografis yang ditampilkan.</p>
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

<!-- Infographic Modal -->
<div id="infographicModal" class="modal">
    <span class="close-modal">&times;</span>
    <div class="modal-nav modal-prev" id="prevInfographic">&#10094;</div>
    <div class="modal-nav modal-next" id="nextInfographic">&#10095;</div>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Infographic">
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
        const infographicItems = document.querySelectorAll('.infographic-item');

        const applyFilter = (filter) => {
            infographicItems.forEach(item => {
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
