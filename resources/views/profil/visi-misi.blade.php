<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Visi & Misi - Kementerian Haji dan Umrah Kota Cirebon</title>
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
    
    <!-- VISI Section -->
    <div class="mb-16" style="width: 100%; max-width: 100%; box-sizing: border-box;">
        <div class="rounded-2xl p-12 md:p-16 text-center mx-auto" style="max-width: 900px; width: 100%; box-sizing: border-box; background-color: #ECB176;">
            <!-- Star Icon -->
            <div class="flex justify-center mb-6">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
            </div>
            
            <!-- VISI Title -->
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6" style="letter-spacing: 2px;" data-i18n="visi.title">
                VISI
            </h1>
            
            <!-- VISI Description -->
            <p class="text-lg md:text-xl text-white leading-relaxed max-w-3xl mx-auto" data-i18n="visi.description">
                Mewujudkan penyelenggaraan ibadah haji yang profesional, transparan, akuntabel, dan memberikan kepuasan bagi jemaah haji Indonesia.
            </p>
        </div>
    </div>

    <!-- MISI Section -->
    <div class="mb-8" style="width: 100%; max-width: 100%; box-sizing: border-box;">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" style="color: #374151;" data-i18n="misi.title">
            MISI
        </h2>
        
        <!-- Misi Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" style="width: 100%; max-width: 100%; box-sizing: border-box;">
            
            <!-- Card 01 -->
            <article class="misi-card bg-white rounded-xl shadow-sm p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">01</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card01.title">Pelayanan Prima</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card01.description">
                        Memberikan pelayanan terbaik kepada jemaah haji sejak pendaftaran hingga kepulangan ke tanah air dengan menerapkan standar pelayanan internasional.
                    </p>
                </div>
            </article>

            <!-- Card 02 -->
            <article class="misi-card bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">02</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card02.title">Transparansi & Akuntabilitas</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card02.description">
                        Mengelola dana dan pelaksanaan ibadah haji secara transparan dan akuntabel dengan sistem pelaporan yang terbuka untuk publik.
                    </p>
                </div>
            </article>

            <!-- Card 03 -->
            <article class="misi-card bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">03</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card03.title">Inovasi Berkelanjutan</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card03.description">
                        Terus berinovasi dalam sistem penyelenggaraan haji dengan memanfaatkan teknologi informasi untuk efisiensi dan kemudahan jemaah.
                    </p>
                </div>
            </article>

            <!-- Card 04 -->
            <article class="misi-card bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">04</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card04.title">Kerjasama Strategis</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card04.description">
                        Membangun kerjasama yang solid dengan pemerintah Arab Saudi dan stakeholder lainnya untuk meningkatkan kualitas penyelenggaraan haji.
                    </p>
                </div>
            </article>

            <!-- Card 05 -->
            <article class="misi-card bg-white rounded-xl shadow-sm hover:shadow-md transition p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">05</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card05.title">Pembinaan Spiritual</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card05.description">
                        Memberikan pembinaan spiritual dan pembekalan kepada calon jemaah haji agar pelaksanaan ibadah sesuai dengan tuntunan syariat.
                    </p>
                </div>
            </article>

            <!-- Card 06 -->
            <article class="misi-card bg-white rounded-xl shadow-sm p-6 relative" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <div class="absolute top-4 left-4">
                    <span class="text-white text-sm font-bold px-3 py-1 rounded-md" style="background-color: #ECB176;">06</span>
                </div>
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-3" data-i18n="misi.card06.title">Kesehatan & Keselamatan</h3>
                    <p class="text-gray-600 leading-relaxed" data-i18n="misi.card06.description">
                        Menjamin kesehatan dan keselamatan jemaah haji dengan standar layanan kesehatan yang memadai di tanah air maupun di Arab Saudi.
                    </p>
                </div>
            </article>
        </div>
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
    
    /* Misi Card Hover Effects */
    .misi-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .misi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    
    .misi-card:active {
        transform: translateY(-2px);
        transition: all 0.1s ease;
    }
    
    /* Badge animation on hover */
    .misi-card:hover .absolute.top-4.left-4 span {
        transform: scale(1.05);
    }
    
    .misi-card .absolute.top-4.left-4 span {
        transition: transform 0.3s ease;
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

</script>

</body>
</html>

