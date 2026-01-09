<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Kementerian Haji dan Umrah Kota Cirebon</title>
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

<!-- ================= HERO / SLIDER ================= -->
<section class="relative w-full overflow-hidden hero-carousel" style="width: 100%; max-width: 100%;">
    <div class="relative w-full overflow-hidden hero-slider-container" style="height: 520px; min-height: 400px; max-height: 600px; width: 100%; max-width: 100%;">
        
        <!-- Carousel Container -->
        <div class="carousel-wrapper relative w-full h-full">
            <!-- Slide 1 -->
            <div class="carousel-slide active">
                <img src="/hero-haji.jpg" class="absolute inset-0 w-full h-full object-cover" style="width: 100%; height: 100%; min-width: 100%; min-height: 100%; object-fit: cover;">
                <div class="absolute inset-0 bg-black/55"></div>
                <div class="container-fixed relative h-full flex items-center">
                    <div class="text-white hero-content" style="max-width: 640px; width: 100%; min-width: 0; box-sizing: border-box;">
                        <span class="inline-block badge-custom text-black text-xs font-semibold px-4 py-1 rounded-full mb-4" data-i18n="hero.slide1.badge">
                            Berita Terkini
                        </span>
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4" data-i18n="hero.slide1.title">
                            Bimtek Pemvisaan Haji 1447H/2026M Digelar, 
                            Misi Perkuat Akurasi Dokumen Jemaah
                        </h1>
                        <p class="text-sm md:text-base text-gray-200 mb-6" data-i18n="hero.slide1.description">
                            Serpong — Direktorat Pelayanan Haji Dalam Negeri Kementerian Haji dan Umrah RI
                            menggelar Bimbingan Teknis Penyelesaian Dokumen Pemvisaan Haji.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 btn-custom text-black font-semibold px-6 py-3 rounded-full text-sm" data-i18n="hero.readMore">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-slide">
                <img src="/hero-haji-2.jpg" class="absolute inset-0 w-full h-full object-cover" style="width: 100%; height: 100%; min-width: 100%; min-height: 100%; object-fit: cover;">
                <div class="absolute inset-0 bg-black/55"></div>
                <div class="container-fixed relative h-full flex items-center">
                    <div class="text-white hero-content" style="max-width: 640px; width: 100%; min-width: 0; box-sizing: border-box;">
                        <span class="inline-block badge-custom text-black text-xs font-semibold px-4 py-1 rounded-full mb-4" data-i18n="hero.slide2.badge">
                            Pengumuman
                        </span>
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4" data-i18n="hero.slide2.title">
                            Kemenhaj Tetap Buka Layanan di Hari Libur, 
                            Percepat Persiapan Haji
                        </h1>
                        <p class="text-sm md:text-base text-gray-200 mb-6" data-i18n="hero.slide2.description">
                            Kemenhaj (Jakarta) — Kementerian Haji dan Umrah (Kemenhaj) tetap membuka layanan kepada jemaah haji 
                            di tingkat kabupaten/kota meskipun pada hari libur.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 btn-custom text-black font-semibold px-6 py-3 rounded-full text-sm" data-i18n="hero.readMore">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-slide">
                <img src="/hero-haji-3.jpg" class="absolute inset-0 w-full h-full object-cover" style="width: 100%; height: 100%; min-width: 100%; min-height: 100%; object-fit: cover;">
                <div class="absolute inset-0 bg-black/55"></div>
                <div class="container-fixed relative h-full flex items-center">
                    <div class="text-white hero-content" style="max-width: 640px; width: 100%; min-width: 0; box-sizing: border-box;">
                        <span class="inline-block badge-custom text-black text-xs font-semibold px-4 py-1 rounded-full mb-4" data-i18n="hero.slide3.badge">
                            Siaran Pers
                        </span>
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4" data-i18n="hero.slide3.title">
                            Kemenhaj Fokus Penyelenggaraan Haji 1447 H/2026 M: 
                            Tepat Waktu, Berkualitas
                        </h1>
                        <p class="text-sm md:text-base text-gray-200 mb-6" data-i18n="hero.slide3.description">
                            Jakarta (Kemenhaj) — Menteri Haji dan Umrah RI menegaskan komitmen pelayanan haji yang tepat waktu, 
                            berkualitas tinggi, dan memperkuat perlindungan jemaah.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 btn-custom text-black font-semibold px-6 py-3 rounded-full text-sm" data-i18n="hero.readMore">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="carousel-nav carousel-prev" id="carouselPrev" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button class="carousel-nav carousel-next" id="carouselNext" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <!-- Dots Indicator -->
        <div class="absolute bottom-6 left-1/2 flex gap-2" style="transform: translateX(-50%); z-index: 10;">
            <button class="carousel-dot active" data-slide="0" aria-label="Slide 1"></button>
            <button class="carousel-dot" data-slide="1" aria-label="Slide 2"></button>
            <button class="carousel-dot" data-slide="2" aria-label="Slide 3"></button>
        </div>
    </div>
</section>

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="main-grid w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">

        <!-- ===== Berita Populer ===== -->
        <div class="berita-section w-full" style="width: 100%; max-width: 100%; min-width: 0; box-sizing: border-box;">
            <h2 class="text-xl font-semibold mb-6" data-i18n="content.popular">Berita Populer</h2>

            <div class="grid md:grid-cols-2 gap-6 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                
                <!-- Card -->
                <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition w-full">
                    <img src="/berita1.jpg" class="w-full object-cover" style="height: 192px; width: 100%; display: block;">
                    <div class="p-4">
                        <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                            Siaran Pers
                        </span>
                        <p class="text-xs text-gray-500 mb-1">8 Januari 2026</p>
                        <h3 class="font-semibold text-sm mb-2">
                            Kemenhaj Fokus Penyelenggaraan Haji 1447 H/2026 M
                        </h3>
                        <p class="text-xs text-gray-500 line-clamp-2">
                            Jakarta (Kemenhaj) — Menteri Haji dan Umrah RI menegaskan komitmen pelayanan haji…
                        </p>
                    </div>
                </article>

                <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition w-full">
                    <img src="/berita2.jpg" class="w-full object-cover" style="height: 192px; width: 100%; display: block;">
                    <div class="p-4">
                        <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                            Siaran Pers
                        </span>
                        <p class="text-xs text-gray-500 mb-1">8 Januari 2026</p>
                        <h3 class="font-semibold text-sm mb-2">
                            Layanan Haji Ramah Perempuan dan Kesehatan Jemaah
                        </h3>
                        <p class="text-xs text-gray-500 line-clamp-2">
                            Kemenhaj memastikan layanan haji semakin inklusif dan ramah jemaah…
                        </p>
                    </div>
                </article>

            </div>
        </div>

        <!-- ===== Sidebar ===== -->
        <aside class="sidebar-section space-y-8 w-full" style="width: 100%; max-width: 100%; min-width: 0; box-sizing: border-box;">

            <!-- Pengumuman -->
            <div class="bg-white rounded-lg shadow-sm p-5 w-full">
                <h2 class="text-lg font-semibold mb-4" data-i18n="content.announcement">Pengumuman</h2>

                <div class="space-y-4 text-sm w-full">
                    <div class="flex gap-3 border-b pb-3 w-full">
                        <img src="/thumb.jpg" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium leading-snug">
                                Pengumuman Seleksi PPIH Layanan Perlindungan Jemaah
                            </p>
                            <p class="text-xs text-gray-500">24 Desember 2025</p>
                        </div>
                    </div>

                    <div class="flex gap-3 border-b pb-3 w-full">
                        <img src="/thumb.jpg" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium leading-snug">
                                Hasil Seleksi PPIH Arab Saudi Tingkat Pusat
                            </p>
                            <p class="text-xs text-gray-500">20 Desember 2025</p>
                        </div>
                    </div>

                    <div class="flex gap-3 w-full">
                        <img src="/thumb.jpg" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium leading-snug">
                                Seleksi Petugas Penyelenggara Ibadah Haji Arab Saudi
                            </p>
                            <p class="text-xs text-gray-500">6 Desember 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Klarifikasi Hoax -->
            <div class="bg-white rounded-lg shadow-sm p-5 w-full">
                <h2 class="text-lg font-semibold mb-4" data-i18n="content.hoax">Klarifikasi Hoax</h2>
                <p class="text-sm text-gray-500 text-center py-6" data-i18n="content.noNews">
                    Tidak ada berita tersedia
                </p>
            </div>

        </aside>

    </div>
</main>

<!-- ================= BERITA TERKINI SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.latestNews">Berita Terkini</h2>
        <a href="#" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/berita1.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Siaran Pers
                </span>
                <p class="text-xs text-gray-500 mb-2">8 Januari 2026</p>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Kemenhaj Fokus Penyelenggaraan Haji 1447 H/2026 M: Tepat Waktu, Berkualitas
                </h3>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Jakarta (Kemenhaj) — Menteri Haji dan Umrah RI menegaskan komitmen pelayanan haji yang tepat waktu dan berkualitas tinggi...
                </p>
            </div>
        </article>

        <!-- Card 2 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/berita2.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Siaran Pers
                </span>
                <p class="text-xs text-gray-500 mb-2">8 Januari 2026</p>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Layanan Haji Ramah Perempuan dan Kesehatan Jemaah
                </h3>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Kemenhaj memastikan layanan haji semakin inklusif dan ramah jemaah dengan fokus pada kesehatan...
                </p>
            </div>
        </article>

        <!-- Card 3 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/berita3.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Berita
                </span>
                <p class="text-xs text-gray-500 mb-2">5 Januari 2026</p>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Persiapan Haji 1447H/2026M Masuki Tahap Finalisasi
                </h3>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Proses persiapan haji tahun 1447H/2026M telah memasuki tahap finalisasi dengan berbagai persiapan matang...
                </p>
            </div>
        </article>
    </div>
</section>

<!-- ================= VIDEO SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.video">Video</h2>
        <a href="#" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Video Card 1 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="relative bg-black" style="height: 200px;">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                        <svg class="w-8 h-8 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    MoU Kementerian Haji dan Umrah RI dengan Kementerian Haji Saudi
                </h3>
                <p class="text-xs text-gray-500">12 November 2025</p>
            </div>
        </article>

        <!-- Video Card 2 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="relative bg-black" style="height: 200px;">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                        <svg class="w-8 h-8 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-2 right-2">
                    <div class="w-3 h-3 bg-custom-primary rounded-full"></div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Menteri dan Wakil Menteri Haji dan Umrah bertemu dengan Menteri...
                </h3>
                <p class="text-xs text-gray-500">8 November 2025</p>
            </div>
        </article>

        <!-- Video Card 3 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="relative bg-black" style="height: 200px;">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                        <svg class="w-8 h-8 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Rumusan Alokasi Kuota Jamaah Haji
                </h3>
                <p class="text-xs text-gray-500">8 November 2025</p>
            </div>
        </article>
    </div>
</section>

<!-- ================= INFOGRAFIS SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.infographic">Infografis</h2>
        <a href="#" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Infografis Card 1 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6" style="height: 300px;">
                <div class="text-white mb-4">
                    <p class="text-sm mb-2">Hasil Seleksi untuk Layanan:</p>
                    <ul class="text-xs space-y-1">
                        <li>• Transportasi</li>
                        <li>• Akomodasi</li>
                        <li>• Konsumsi</li>
                        <li>• Bimbingan Ibadah</li>
                        <li>• Jemaah Lansia dan Disabi</li>
                        <li>• PKPPJH</li>
                    </ul>
                </div>
                <div class="bg-white p-4 rounded flex items-center justify-center">
                    <div class="w-24 h-24 bg-gray-200 rounded"></div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Pengumuman Hasil Seleksi PPIH Arab Saudi Tingkat Pusat Tahun...
                </h3>
                <p class="text-xs text-gray-500">20 Desember 2025</p>
            </div>
        </article>

        <!-- Infografis Card 2 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="bg-custom-primary p-6 flex items-center justify-center" style="height: 300px;">
                <div class="text-center text-white">
                    <p class="text-lg font-bold mb-2">Infographic</p>
                    <div class="flex items-center justify-center gap-2 mt-4">
                        <button class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <span class="text-sm font-semibold">2</span>
                        <button class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Daftar Kuota Haji Reguler per Provinsi Tahun 1447H/2026M
                </h3>
                <p class="text-xs text-gray-500">8 Desember 2025</p>
            </div>
        </article>

        <!-- Infografis Card 3 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="bg-custom-primary p-6 flex items-center justify-center" style="height: 300px;">
                <div class="text-center text-white">
                    <p class="text-lg font-bold mb-2">Infographic</p>
                    <div class="flex items-center justify-center gap-2 mt-4">
                        <button class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <span class="text-sm font-semibold">3</span>
                        <button class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Informasi Rencana Rekrutmen Petugas Haji
                </h3>
                <p class="text-xs text-gray-500">8 November 2025</p>
            </div>
        </article>
    </div>
</section>

<!-- ================= FOTO SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.photos">Foto</h2>
        <a href="#" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Foto Card 1 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/foto1.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Dokumentasi
                </span>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Dokumentasi Kegiatan Bimtek Pemvisaan Haji 1447H/2026M
                </h3>
                <p class="text-xs text-gray-500">15 Januari 2026</p>
            </div>
        </article>

        <!-- Foto Card 2 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/foto2.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Kegiatan
                </span>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Kunjungan Menteri Haji dan Umrah ke Arab Saudi
                </h3>
                <p class="text-xs text-gray-500">10 Januari 2026</p>
            </div>
        </article>

        <!-- Foto Card 3 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <img src="/foto3.jpg" class="w-full object-cover" style="height: 200px; width: 100%; display: block;">
            <div class="p-4">
                <span class="inline-block badge-light text-xs font-semibold px-2 py-1 rounded mb-2">
                    Acara
                </span>
                <h3 class="font-semibold text-base mb-2 line-clamp-2">
                    Penandatanganan MoU dengan Kementerian Haji Saudi
                </h3>
                <p class="text-xs text-gray-500">5 Januari 2026</p>
            </div>
        </article>
    </div>
</section>

<!-- ================= REGULASI SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.regulation">Regulasi</h2>
        <a href="#" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Regulasi Card 1 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="p-6 border-b border-gray-200" style="min-height: 200px;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-custom-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-base mb-1 line-clamp-2">
                            Peraturan Menteri Haji dan Umrah Nomor 1 Tahun 2026
                        </h3>
                        <p class="text-xs text-gray-500">Tentang Penyelenggaraan Ibadah Haji</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Peraturan mengenai tata cara penyelenggaraan ibadah haji tahun 1447H/2026M yang mencakup persiapan, pelaksanaan, dan evaluasi...
                </p>
            </div>
            <div class="p-4 bg-gray-50">
                <p class="text-xs text-gray-500 mb-2">Tanggal Terbit: 10 Januari 2026</p>
                <a href="#" class="text-custom-primary text-sm font-semibold hover:underline flex items-center gap-1">
                    Unduh Dokumen →
                </a>
            </div>
        </article>

        <!-- Regulasi Card 2 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="p-6 border-b border-gray-200" style="min-height: 200px;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-custom-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-base mb-1 line-clamp-2">
                            Keputusan Menteri Haji dan Umrah Nomor 15 Tahun 2025
                        </h3>
                        <p class="text-xs text-gray-500">Tentang Kuota Haji Reguler</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Keputusan mengenai alokasi kuota haji reguler per provinsi untuk tahun 1447H/2026M beserta ketentuan pendaftaran...
                </p>
            </div>
            <div class="p-4 bg-gray-50">
                <p class="text-xs text-gray-500 mb-2">Tanggal Terbit: 20 Desember 2025</p>
                <a href="#" class="text-custom-primary text-sm font-semibold hover:underline flex items-center gap-1">
                    Unduh Dokumen →
                </a>
            </div>
        </article>

        <!-- Regulasi Card 3 -->
        <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
            <div class="p-6 border-b border-gray-200" style="min-height: 200px;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-custom-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-base mb-1 line-clamp-2">
                            Peraturan Menteri Haji dan Umrah Nomor 8 Tahun 2025
                        </h3>
                        <p class="text-xs text-gray-500">Tentang Petugas Penyelenggara Ibadah Haji</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 line-clamp-3">
                    Peraturan mengenai rekrutmen, seleksi, dan penugasan petugas penyelenggara ibadah haji (PPIH) untuk tahun 1447H/2026M...
                </p>
            </div>
            <div class="p-4 bg-gray-50">
                <p class="text-xs text-gray-500 mb-2">Tanggal Terbit: 15 Desember 2025</p>
                <a href="#" class="text-custom-primary text-sm font-semibold hover:underline flex items-center gap-1">
                    Unduh Dokumen →
                </a>
            </div>
        </article>
    </div>
</section>

@include('partials.footer')

<style>
    .main-grid {
        display: block;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    @media (min-width: 1024px) {
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            width: 100%;
            max-width: 100%;
        }
    }
    
    .berita-section,
    .sidebar-section {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }
    
    /* Prevent layout shift on zoom */
    img {
        max-width: 100%;
        height: auto;
        display: block;
        box-sizing: border-box;
    }
    
    /* Ensure containers don't overflow */
    .container-fixed {
        box-sizing: border-box;
        width: 100%;
        max-width: 1280px;
    }
    
    /* Fix for flex items */
    header > div > div {
        flex-wrap: nowrap;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    /* Hero carousel stability */
    .hero-carousel {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }
    
    .hero-slider-container {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        position: relative;
    }
    
    .hero-content {
        width: 100%;
        max-width: 640px;
        min-width: 0;
        box-sizing: border-box;
    }
    
    @media (max-width: 1023px) {
        .main-grid {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
        }
    }
    
    /* Prevent text reflow on zoom */
    .whitespace-nowrap {
        white-space: nowrap;
    }
    
    /* Fixed grid columns */
    .grid {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    /* Fixed dropdown positioning */
    .dropdown-content {
        box-sizing: border-box;
        min-width: 200px;
        max-width: 300px;
        width: auto;
    }
    
    /* Language dropdown stability */
    .language-dropdown {
        box-sizing: border-box;
        min-width: 160px;
        max-width: 200px;
        width: auto;
    }
    
    /* All cards and articles */
    article {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    /* All images stability */
    img {
        max-width: 100%;
        height: auto;
        display: block;
        box-sizing: border-box;
        object-fit: cover;
    }
    
    /* All buttons and inputs */
    button, input, select, textarea {
        box-sizing: border-box;
    }
    
    /* Navigation stability */
    nav {
        box-sizing: border-box;
        width: auto;
        max-width: 100%;
    }
    
    /* All links */
    a {
        box-sizing: border-box;
        display: inline-block;
    }
    
    /* Prevent any element from exceeding viewport - but allow containers */
    body > *:not(header):not(footer):not(section) {
        max-width: 100%;
    }
    
    /* Exception for containers that need to be wider */
    .container-fixed {
        max-width: 1280px;
    }
    
    header > div.container-fixed,
    footer > div.container-fixed {
        max-width: 1280px;
    }
    
    /* Hero section exception */
    .hero-carousel,
    .hero-slider-container {
        max-width: 100%;
        width: 100%;
    }
    
    /* Fixed header and footer width */
    header,
    footer {
        width: 100%;
        max-width: 100%;
    }
    
    /* All sections full width */
    section {
        width: 100%;
        max-width: 100%;
    }
    
    /* Prevent flex items from shrinking incorrectly */
    .flex {
        min-width: 0;
    }
    
    .flex > * {
        min-width: 0;
    }
    
    /* Grid stability */
    .grid > * {
        min-width: 0;
        max-width: 100%;
    }
    
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
    
    /* Badge light */
    .badge-light {
        background-color: #F9E6D0;
        color: #B87A3A;
    }
    
    /* Custom primary color text */
    .text-custom-primary {
        color: #ECB176;
    }
    
    /* Footer */
    .footer-custom {
        background-color: #ECB176;
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
    
    /* Carousel Styles */
    .hero-carousel {
        position: relative;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }
    
    .carousel-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        max-width: 100%;
        box-sizing: border-box;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.6s ease, visibility 0.6s ease;
    }
    
    .carousel-slide.active {
        opacity: 1;
        visibility: visible;
        z-index: 1;
    }
    
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        width: 48px;
        height: 48px;
        min-width: 48px;
        min-height: 48px;
        max-width: 48px;
        max-height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
        color: white;
        box-sizing: border-box;
    }
    
    .carousel-nav:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .carousel-prev {
        left: 20px;
    }
    
    .carousel-next {
        right: 20px;
    }
    
    .carousel-dot {
        width: 10px;
        height: 10px;
        min-width: 10px;
        min-height: 10px;
        max-width: 10px;
        max-height: 10px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: background-color 0.3s ease, width 0.3s ease, height 0.3s ease;
        padding: 0;
        box-sizing: border-box;
    }
    
    .carousel-dot.active {
        background: white;
        width: 12px;
        height: 12px;
        min-width: 12px;
        min-height: 12px;
        max-width: 12px;
        max-height: 12px;
    }
    
    .carousel-dot:hover {
        background: rgba(255, 255, 255, 0.8);
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
                const dropdownId = this.getAttribute('data-dropdown');
                
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
            
            // Apply language changes (you can extend this to translate content)
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
                'nav.regulation': 'Regulasi',
                'search.placeholder': 'Cari berita',
                
                // Hero Section
                'hero.slide1.badge': 'Berita Terkini',
                'hero.slide1.title': 'Bimtek Pemvisaan Haji 1447H/2026M Digelar, Misi Perkuat Akurasi Dokumen Jemaah',
                'hero.slide1.description': 'Serpong — Direktorat Pelayanan Haji Dalam Negeri Kementerian Haji dan Umrah RI menggelar Bimbingan Teknis Penyelesaian Dokumen Pemvisaan Haji.',
                'hero.slide2.badge': 'Pengumuman',
                'hero.slide2.title': 'Kemenhaj Tetap Buka Layanan di Hari Libur, Percepat Persiapan Haji',
                'hero.slide2.description': 'Kemenhaj (Jakarta) — Kementerian Haji dan Umrah (Kemenhaj) tetap membuka layanan kepada jemaah haji di tingkat kabupaten/kota meskipun pada hari libur.',
                'hero.slide3.badge': 'Siaran Pers',
                'hero.slide3.title': 'Kemenhaj Fokus Penyelenggaraan Haji 1447 H/2026 M: Tepat Waktu, Berkualitas',
                'hero.slide3.description': 'Jakarta (Kemenhaj) — Menteri Haji dan Umrah RI menegaskan komitmen pelayanan haji yang tepat waktu, berkualitas tinggi, dan memperkuat perlindungan jemaah.',
                'hero.readMore': 'Baca Selengkapnya →',
                
                // Main Content
                'content.popular': 'Berita Populer',
                'content.announcement': 'Pengumuman',
                'content.hoax': 'Klarifikasi Hoax',
                'content.noNews': 'Tidak ada berita tersedia',
                'content.latestNews': 'Berita Terkini',
                'content.video': 'Video',
                'content.infographic': 'Infografis',
                'content.photos': 'Foto',
                'content.regulation': 'Regulasi',
                'content.seeAll': 'Lihat Semua →',
                
                // Footer
                'footer.address': 'Alamat',
                'footer.contact': 'Hubungi Kami',
                'footer.platform': 'Platform',
                'footer.copyright': '© Copyright 2025 Kementerian Haji dan Umrah Kota Cirebon',
                
                // Additional
                'badge.press': 'Siaran Pers',
                'badge.news': 'Berita'
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
                'nav.regional': 'News',
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
                
                // Hero Section
                'hero.slide1.badge': 'Latest News',
                'hero.slide1.title': 'Hajj Visa Processing Training 1447H/2026M Held, Mission to Strengthen Pilgrim Document Accuracy',
                'hero.slide1.description': 'Serpong — The Directorate of Domestic Hajj Services of the Ministry of Hajj and Umrah RI held Technical Guidance on Hajj Visa Processing Document Completion.',
                'hero.slide2.badge': 'Announcement',
                'hero.slide2.title': 'Ministry of Hajj Remains Open on Holidays, Accelerates Hajj Preparation',
                'hero.slide2.description': 'Ministry of Hajj (Jakarta) — The Ministry of Hajj and Umrah (Kemenhaj) continues to open services to Hajj pilgrims at the district/city level even on holidays.',
                'hero.slide3.badge': 'Press Release',
                'hero.slide3.title': 'Ministry of Hajj Focuses on Hajj Implementation 1447 H/2026 M: Timely, Quality',
                'hero.slide3.description': 'Jakarta (Kemenhaj) — The Minister of Hajj and Umrah RI affirms commitment to timely, high-quality Hajj services and strengthened pilgrim protection.',
                'hero.readMore': 'Read More →',
                
                // Main Content
                'content.popular': 'Popular News',
                'content.announcement': 'Announcement',
                'content.hoax': 'Hoax Clarification',
                'content.noNews': 'No news available',
                'content.latestNews': 'Latest News',
                'content.video': 'Video',
                'content.infographic': 'Infographic',
                'content.photos': 'Photos',
                'content.regulation': 'Regulation',
                'content.seeAll': 'See All →',
                
                // Footer
                'footer.address': 'Address',
                'footer.contact': 'Contact Us',
                'footer.platform': 'Platform',
                'footer.copyright': '© Copyright 2025 Ministry of Hajj and Umrah Cirebon City',
                
                // Additional
                'badge.press': 'Press Release',
                'badge.news': 'News'
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
                ? 'Kementerian Haji dan Umrah Kota Cirebon'
                : 'Ministry of Hajj and Umrah Cirebon City';
        }
        
        // Initialize on page load
        initLanguage();
        
        // Carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalSlides = slides.length;
        
        function showSlide(index) {
            // Remove active class from all slides and dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            // Add active class to current slide and dot
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            
            currentSlide = index;
        }
        
        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }
        
        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }
        
        // Navigation buttons
        const prevBtn = document.getElementById('carouselPrev');
        const nextBtn = document.getElementById('carouselNext');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', prevSlide);
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', nextSlide);
        }
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });
        
        // Auto-play carousel (optional)
        let autoPlayInterval = setInterval(nextSlide, 5000);
        
        // Pause on hover
        const carousel = document.querySelector('.hero-carousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', () => {
                clearInterval(autoPlayInterval);
            });
            
            carousel.addEventListener('mouseleave', () => {
                autoPlayInterval = setInterval(nextSlide, 5000);
            });
        }
        
        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        if (carousel) {
            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
        }
        
        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                nextSlide();
            }
            if (touchEndX > touchStartX + 50) {
                prevSlide();
            }
        }
    });
</script>

</body>
</html>
