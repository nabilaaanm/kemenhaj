<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>LK & PIH - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #111827;" data-i18n="lkpih.title">
            Laporan Keuangan & Penyelenggaraan Ibadah Haji
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="lkpih.subtitle">
            Transparansi dan Akuntabilitas Pengelolaan Haji
        </p>
    </div>

    <!-- Search Section -->
    <div class="mb-12">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-center max-w-3xl mx-auto">
            <div class="flex-1 w-full relative">
                <input type="text" id="lkpihSearch" data-i18n-placeholder="lkpih.searchPlaceholder" placeholder="Cari dokumen berdasarkan judul, jenis, atau tanggal..." 
                    class="w-full border rounded-lg px-4 py-3 text-sm focus-custom"
                    style="min-width: 0;">
                <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button class="btn-custom text-black font-semibold px-8 py-3 rounded-lg text-sm whitespace-nowrap flex items-center gap-2" id="searchBtn" data-i18n="lkpih.searchBtn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
        </div>
    </div>

    <!-- Laporan Keuangan Section -->
    <div class="mb-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-2" style="color: #111827;" data-i18n="lkpih.lk.title">
                    Laporan Keuangan
                </h2>
                <p class="text-gray-600" data-i18n="lkpih.lk.subtitle">
                    Laporan keuangan yang telah diaudit dan disahkan
                </p>
            </div>

            @if(isset($lkDocuments) && $lkDocuments->count())
                <div class="space-y-4">
                    @foreach($lkDocuments as $doc)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: var(--color-primary-bg);">
                                            <svg class="w-6 h-6" style="color: #111827;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                            <h3 class="font-semibold text-lg">{{ $doc->title }}</h3>
                                            @if($doc->description)
                                                <p class="text-sm text-gray-500">{{ $doc->description }}</p>
                                            @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-600 mt-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                            {{ $doc->document_date?->format('d F Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                                    @if($doc->file_url)
                                        <a href="{{ $doc->file_url }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-medium text-white hover:opacity-90 transition" style="background-color: var(--color-primary);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span data-i18n="lkpih.download">Download</span>
                            </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background-color: var(--color-primary-bg);">
                        <svg class="w-8 h-8" style="color: #111827;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg" data-i18n="lkpih.lk.empty">
                        Data laporan keuangan belum tersedia
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Penyelenggaraan Ibadah Haji (PIH) Section -->
    <div class="mb-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold mb-2" style="color: #111827;" data-i18n="lkpih.pih.title">
                    Penyelenggaraan Ibadah Haji (PIH)
                </h2>
                <p class="text-gray-600" data-i18n="lkpih.pih.subtitle">
                    Informasi publik yang wajib disediakan dan diumumkan
                </p>
            </div>

            @if(isset($pihDocuments) && $pihDocuments->count())
                <div class="space-y-4">
                    @foreach($pihDocuments as $doc)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: var(--color-primary-bg);">
                                            <svg class="w-6 h-6" style="color: #111827;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <div>
                                            <h3 class="font-semibold text-lg">{{ $doc->title }}</h3>
                                            @if($doc->description)
                                                <p class="text-sm text-gray-500">{{ $doc->description }}</p>
                                            @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-600 mt-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                            {{ $doc->document_date?->format('d F Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                                    @if($doc->file_url)
                                        <a href="{{ $doc->file_url }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-medium text-white hover:opacity-90 transition" style="background-color: var(--color-primary);">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span data-i18n="lkpih.download">Download</span>
                            </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background-color: var(--color-primary-bg);">
                        <svg class="w-8 h-8" style="color: #111827;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg" data-i18n="lkpih.pih.empty">
                        Data Penyelenggaraan Ibadah Haji belum tersedia
                    </p>
                </div>
            @endif
        </div>
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
        const searchInput = document.getElementById('lkpihSearch');
        const searchBtn = document.getElementById('searchBtn');
        
        if (searchBtn) {
            searchBtn.addEventListener('click', function() {
                performSearch();
            });
        }
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        }
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            // Search functionality can be implemented here
            console.log('Searching for:', searchTerm);
        }
    });
</script>

</body>
</html>

