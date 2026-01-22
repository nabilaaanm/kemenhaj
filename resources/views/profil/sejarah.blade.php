<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Sejarah - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #374151;" data-i18n="history.title">
            Sejarah Kementerian Haji dan Umrah Kota Cirebon
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto" data-i18n="history.subtitle">
            Perjalanan panjang dalam melayani jemaah haji dan umrah di Kota Cirebon
        </p>
    </div>

    <!-- Timeline Section -->
    <div class="max-w-4xl mx-auto">
        
        <!-- Timeline Item 1 -->
        <div class="mb-12 relative">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3 text-right md:pr-8">
                    <div class="text-2xl font-bold mb-2" style="color: #ECB176;" data-i18n="history.year1">Awal Mula</div>
                    <div class="text-sm text-gray-500" data-i18n="history.period1">Periode Awal</div>
                </div>
                <div class="md:w-2/3 relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: #ECB176;"></div>
                    <div class="ml-6 md:ml-8">
                        <div class="absolute left-0 top-2 w-4 h-4 rounded-full border-4 border-white" style="background-color: #ECB176; margin-left: -8px;"></div>
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-3" style="color: #374151;" data-i18n="history.event1.title">Pembentukan Kantor Perwakilan</h3>
                            <p class="text-gray-700 leading-relaxed" data-i18n="history.event1.description">
                                Kementerian Haji dan Umrah Kota Cirebon didirikan sebagai perwakilan resmi untuk melayani jemaah haji dan umrah di wilayah Kota Cirebon dan sekitarnya. Pada periode awal ini, fokus utama adalah membangun infrastruktur dasar dan sistem pelayanan kepada jemaah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Item 2 -->
        <div class="mb-12 relative">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3 text-right md:pr-8">
                    <div class="text-2xl font-bold mb-2" style="color: #ECB176;" data-i18n="history.year2">Pengembangan</div>
                    <div class="text-sm text-gray-500" data-i18n="history.period2">Era Modernisasi</div>
                </div>
                <div class="md:w-2/3 relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: #ECB176;"></div>
                    <div class="ml-6 md:ml-8">
                        <div class="absolute left-0 top-2 w-4 h-4 rounded-full border-4 border-white" style="background-color: #ECB176; margin-left: -8px;"></div>
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-3" style="color: #374151;" data-i18n="history.event2.title">Modernisasi Sistem Pelayanan</h3>
                            <p class="text-gray-700 leading-relaxed" data-i18n="history.event2.description">
                                Kemenhaj Kota Cirebon mulai mengadopsi teknologi informasi dalam sistem pelayanan haji dan umrah. Sistem komputerisasi diperkenalkan untuk memudahkan pendaftaran, pembayaran, dan pelacakan dokumen jemaah. Hal ini meningkatkan efisiensi dan transparansi pelayanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Item 3 -->
        <div class="mb-12 relative">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3 text-right md:pr-8">
                    <div class="text-2xl font-bold mb-2" style="color: #ECB176;" data-i18n="history.year3">Ekspansi</div>
                    <div class="text-sm text-gray-500" data-i18n="history.period3">Perluasan Layanan</div>
                </div>
                <div class="md:w-2/3 relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: #ECB176;"></div>
                    <div class="ml-6 md:ml-8">
                        <div class="absolute left-0 top-2 w-4 h-4 rounded-full border-4 border-white" style="background-color: #ECB176; margin-left: -8px;"></div>
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-3" style="color: #374151;" data-i18n="history.event3.title">Perluasan Jangkauan Pelayanan</h3>
                            <p class="text-gray-700 leading-relaxed" data-i18n="history.event3.description">
                                Kemenhaj Kota Cirebon memperluas jangkauan pelayanannya tidak hanya untuk Kota Cirebon, tetapi juga melayani jemaah dari kabupaten-kabupaten sekitarnya. Program pembinaan dan bimbingan jemaah haji ditingkatkan untuk memastikan persiapan yang lebih baik sebelum keberangkatan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Item 4 -->
        <div class="mb-12 relative">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3 text-right md:pr-8">
                    <div class="text-2xl font-bold mb-2" style="color: #ECB176;" data-i18n="history.year4">Saat Ini</div>
                    <div class="text-sm text-gray-500" data-i18n="history.period4">Era Digital</div>
                </div>
                <div class="md:w-2/3 relative">
                    <div class="absolute left-0 top-0 bottom-0 w-1" style="background-color: #ECB176;"></div>
                    <div class="ml-6 md:ml-8">
                        <div class="absolute left-0 top-2 w-4 h-4 rounded-full border-4 border-white" style="background-color: #ECB176; margin-left: -8px;"></div>
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-3" style="color: #374151;" data-i18n="history.event4.title">Transformasi Digital</h3>
                            <p class="text-gray-700 leading-relaxed" data-i18n="history.event4.description">
                                Kemenhaj Kota Cirebon terus berinovasi dengan mengimplementasikan sistem digital yang lebih canggih. Pelayanan online, aplikasi mobile, dan sistem terintegrasi memudahkan jemaah dalam mengakses informasi dan layanan. Komitmen untuk memberikan pelayanan terbaik dengan standar internasional terus dipertahankan dan ditingkatkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Vision Statement -->
    <div class="mt-16 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
            <div class="max-w-3xl mx-auto">
                <div class="mb-6">
                    <svg class="w-16 h-16 mx-auto" style="color: #ECB176;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold mb-6" style="color: #374151;" data-i18n="history.commitment.title">Komitmen Kami</h2>
                <p class="text-lg text-gray-700 leading-relaxed" data-i18n="history.commitment.description">
                    Kementerian Haji dan Umrah Kota Cirebon berkomitmen untuk terus memberikan pelayanan terbaik kepada jemaah haji dan umrah dengan mengedepankan profesionalitas, transparansi, dan akuntabilitas. Kami akan terus berinovasi dan berkembang untuk memastikan setiap jemaah mendapatkan pengalaman ibadah yang bermakna dan memuaskan.
                </p>
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
