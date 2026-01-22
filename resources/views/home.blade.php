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
            @if(isset($slides) && $slides->count())
                @foreach($slides as $index => $slide)
                    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $slide->image_url }}" class="absolute inset-0 w-full h-full object-cover" style="width: 100%; height: 100%; min-width: 100%; min-height: 100%; object-fit: cover;">
                        <div class="absolute inset-0 bg-black/55"></div>
                        <div class="container-fixed relative h-full flex items-center">
                            <div class="text-white hero-content" style="max-width: 640px; width: 100%; min-width: 0; box-sizing: border-box;">
                                @if($slide->badge)
                                    <span class="inline-block badge-custom text-black text-xs font-semibold px-4 py-1 rounded-full mb-4">
                                        {{ $slide->badge }}
                                    </span>
                                @endif
                                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">
                                    {{ $slide->title }}
                                </h1>
                                @if($slide->description)
                                    <p class="text-sm md:text-base text-gray-200 mb-6">
                                        {{ $slide->description }}
                                    </p>
                                @endif
                                @if($slide->button_url)
                                    <a href="{{ $slide->button_url }}" class="inline-flex items-center gap-2 btn-custom text-black font-semibold px-6 py-3 rounded-full text-sm">
                                        {{ $slide->button_text ?: 'Selengkapnya' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
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
            @endif
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
            @if(isset($slides) && $slides->count())
                @foreach($slides as $index => $slide)
                    <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            @else
            <button class="carousel-dot active" data-slide="0" aria-label="Slide 1"></button>
            <button class="carousel-dot" data-slide="1" aria-label="Slide 2"></button>
            <button class="carousel-dot" data-slide="2" aria-label="Slide 3"></button>
            @endif
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
                @forelse($popularPosts as $post)
                    <article class="news-card search-card w-full">
                        <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="news-thumb" style="display: block;">
                        <div class="news-body">
                            <span class="news-badge mb-2">
                                {{ $post->category?->name ?? 'Berita' }}
                        </span>
                            <p class="news-meta mb-1">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                            <h3 class="news-title search-title text-sm mb-2">
                                {{ $post->title }}
                        </h3>
                            <p class="news-excerpt text-xs">
                                {{ strip_tags($post->excerpt ?: $post->content) }}
                            </p>
                    <div class="mt-3 news-footer">
                                <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                    Baca Selengkapnya
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                    </svg>
                                </a>
                    </div>
                    </div>
                </article>
                @empty
                    <div class="text-sm text-gray-500" data-i18n="content.noNews">
                        Tidak ada berita tersedia
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ===== Sidebar ===== -->
        <aside class="sidebar-section space-y-8 w-full" style="width: 100%; max-width: 100%; min-width: 0; box-sizing: border-box;">

            <!-- Pengumuman -->
            <div class="bg-white rounded-lg shadow-sm p-5 w-full">
                <h2 class="text-lg font-semibold mb-4" data-i18n="content.announcement">Pengumuman</h2>

                <div class="space-y-4 text-sm w-full">
                    @forelse($announcementPosts as $post)
                    <div class="flex gap-3 border-b pb-3 w-full search-card">
                            <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium leading-snug search-title">
                                    {{ $post->title }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                    <div class="mt-2 news-footer">
                                    <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                        Baca Selengkapnya
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                        </div>
                    </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-6" data-i18n="content.noNews">
                            Tidak ada berita tersedia
                        </p>
                    @endforelse
                        </div>
                    </div>

            <!-- Siaran Pers -->
            <div class="bg-white rounded-lg shadow-sm p-5 w-full">
                <h2 class="text-lg font-semibold mb-4" data-i18n="content.press">Siaran Pers</h2>

                <div class="space-y-4 text-sm w-full">
                    @forelse($pressPosts as $post)
                        <div class="flex gap-3 border-b pb-3 w-full search-card">
                            <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium leading-snug search-title">
                                    {{ $post->title }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                <div class="mt-2 news-footer">
                                    <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                        Baca Selengkapnya
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                        </div>
                    </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-6" data-i18n="content.noNews">
                            Tidak ada berita tersedia
                        </p>
                    @endforelse
                </div>
            </div>

            <!-- Klarifikasi Hoax -->
            <div class="bg-white rounded-lg shadow-sm p-5 w-full">
                <h2 class="text-lg font-semibold mb-4" data-i18n="content.hoax">Klarifikasi Hoax</h2>
                <div class="space-y-4 text-sm w-full">
                    @forelse($hoaxPosts as $post)
                        <div class="flex gap-3 border-b pb-3 w-full search-card">
                            <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="object-cover rounded flex-shrink-0" style="width: 56px; height: 56px; min-width: 56px;">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium leading-snug search-title">
                                    {{ $post->title }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                <div class="mt-2 news-footer">
                                    <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                        Baca Selengkapnya
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                <p class="text-sm text-gray-500 text-center py-6" data-i18n="content.noNews">
                    Tidak ada berita tersedia
                </p>
                    @endforelse
                </div>
            </div>

        </aside>

    </div>
</main>

<!-- ================= BERITA TERKINI SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.latestNews">Berita Terkini</h2>
        <a href="{{ route('berita') }}" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($latestPosts as $post)
            <article class="news-card search-card">
                <img src="{{ $post->cover_url ?: asset('image/lambang.png') }}" class="news-thumb" style="display: block;">
                <div class="news-body">
                    <span class="news-badge mb-2">
                        {{ $post->category?->name ?? 'Berita' }}
                </span>
                    <p class="news-meta mb-2">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                    <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                        {{ $post->title }}
                </h3>
                    <p class="news-excerpt text-sm line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 120) }}
                    </p>
                    <div class="mt-3 news-footer">
                        <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                            Baca Selengkapnya
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                            </svg>
                        </a>
            </div>
            </div>
        </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full">
                Tidak ada foto tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- ================= VIDEO SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.video">Video</h2>
        <a href="{{ route('galeri.video') }}" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeVideos as $video)
            <article class="news-card search-card">
                <a href="{{ route('galeri.video') }}" style="text-decoration: none; color: inherit;">
                    <div class="relative">
                        <img src="{{ $video->video_thumbnail_url ?: $video->image_url }}" alt="{{ $video->title }}"
                             class="news-thumb" style="display: block;"
                             onerror="this.src='https://via.placeholder.com/800x450/ECB176/FFFFFF?text=Video'; this.onerror=null;">
                <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 bg-white bg-opacity-90 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            </div>
                    <div class="news-body">
                        <span class="news-badge mb-2">Video</span>
                        <p class="news-meta mb-2">{{ $video->created_at?->translatedFormat('d F Y') ?? '-' }}</p>
                        <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                            {{ $video->title }}
                </h3>
                        @if(!empty($video->description))
                            <p class="news-excerpt text-sm line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($video->description, 90) }}
                            </p>
                        @endif
                        <div class="mt-3 news-footer">
                            <span class="btn-readmore">
                                Lihat Video
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                        </svg>
                            </span>
                    </div>
                </div>
                </a>
        </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full" data-i18n="content.noNews">
                Tidak ada video tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- ================= INFOGRAFIS SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.infographic">Infografis</h2>
        <a href="{{ route('galeri.infografis') }}" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeInfografis as $infografis)
            <article class="news-card search-card">
                <a href="{{ route('galeri.infografis') }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $infografis->image_url }}" alt="{{ $infografis->title }}"
                         class="news-thumb" style="display: block;"
                         onerror="this.src='https://via.placeholder.com/800x1000/ECB176/FFFFFF?text=Infografis'; this.onerror=null;">
                    <div class="news-body">
                        <span class="news-badge mb-2">Infografis</span>
                        <p class="news-meta mb-2">{{ $infografis->created_at?->translatedFormat('d F Y') ?? '-' }}</p>
                        <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                            {{ $infografis->title }}
                </h3>
                        <div class="mt-3 news-footer">
                            <span class="btn-readmore">
                                Lihat Infografis
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                            </svg>
                            </span>
                    </div>
                </div>
                </a>
        </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full" data-i18n="content.noNews">
                Tidak ada infografis tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- ================= FOTO SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.photos">Foto</h2>
        <a href="{{ route('galeri.foto') }}" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeFotos as $foto)
            <article class="news-card search-card">
                <a href="{{ route('galeri.foto') }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $foto->image_url }}" class="news-thumb" style="display: block;"
                         onerror="this.src='https://via.placeholder.com/800x600/ECB176/FFFFFF?text=Foto'; this.onerror=null;">
                    <div class="news-body">
                        <span class="news-badge mb-2">
                            {{ $foto->category ?: 'Dokumentasi' }}
                </span>
                        <p class="news-meta mb-2">{{ $foto->created_at?->translatedFormat('d F Y') ?? '-' }}</p>
                        <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                            {{ $foto->title }}
                </h3>
                        <div class="mt-3 news-footer">
                            <span class="btn-readmore">
                                Lihat Foto
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                </svg>
                </span>
            </div>
            </div>
                </a>
        </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full">
                Tidak ada foto tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- ================= REGULASI SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.regulation">Regulasi</h2>
        <a href="{{ route('regulasi') }}" class="text-custom-primary font-semibold hover:underline flex items-center gap-1" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeRegulations as $regulation)
            <article class="news-card search-card">
                <div class="news-body">
                    <span class="news-badge mb-2">
                        {{ $regulation->badge_text }}
                    </span>
                    <p class="news-meta mb-2">Tanggal Terbit: {{ $regulation->regulation_date?->translatedFormat('d F Y') ?? '-' }}</p>
                    <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                        {{ $regulation->title }}
                        </h3>
                    <p class="news-excerpt text-sm line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($regulation->description, 140) }}
                    </p>
                    <div class="mt-3">
                        @if($regulation->file_url)
                            <a href="{{ $regulation->file_url }}" class="btn-readmore" target="_blank" rel="noopener">
                                Unduh Dokumen
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-4-4m4 4l4-4"/>
                        </svg>
                            </a>
                        @else
                            <span class="text-xs text-gray-400">Dokumen belum tersedia</span>
                        @endif
            </div>
                    </div>
            </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full" data-i18n="content.noNews">
                Tidak ada regulasi tersedia
            </p>
        @endforelse
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
        .berita-section {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .berita-section .grid {
            height: 100%;
            align-content: stretch;
            grid-auto-rows: 1fr;
        }
        .berita-section .news-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .berita-section .news-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .berita-section .news-excerpt {
            flex: 1;
            text-align: justify;
        }
        .berita-section .news-body .mt-3 {
            margin-top: auto;
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
    
    /* Badge primary */
    .badge-custom {
        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary));
    }
    
    /* Button primary */
    .btn-custom {
        background-color: var(--color-primary);
        transition: background-color 0.2s;
    }
    .btn-custom:hover {
        background-color: var(--color-primary-dark);
    }

    /* Read more button */
    .btn-readmore {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border: 1px solid var(--color-primary);
        border-radius: 999px;
        font-weight: 600;
        font-size: 12px;
        color: var(--color-primary-dark);
        background: #ffffff;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-readmore:hover {
        background: var(--color-primary);
        color: white;
        border-color: var(--color-primary);
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
    }
    .btn-readmore svg {
        width: 14px;
        height: 14px;
    }
    @media (max-width: 640px) {
        .btn-readmore {
            font-size: 11px;
            padding: 6px 10px;
        }
    }

    /* News cards */
    .news-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(17, 24, 39, 0.06);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .news-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(17, 24, 39, 0.12);
    }
    .news-thumb {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    @media (max-width: 640px) {
        .news-thumb {
            height: 180px;
        }
    }
    .news-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .news-footer {
        margin-top: auto;
    }
    .news-title {
        font-weight: 700;
        color: #1f2937;
        line-height: 1.4;
    }
    .news-excerpt {
        color: #6b7280;
        text-align: justify;
        text-justify: inter-word;
    }
    .news-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        color: #ffffff;
        background: linear-gradient(135deg, var(--color-primary-bg), var(--color-primary-light));
    }
    .news-meta {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Sidebar cards (Pengumuman & Klarifikasi Hoax) */
    .sidebar-section .bg-white .flex {
        border-bottom: none !important;
        background: var(--color-primary-bg);
        border: 1px solid var(--color-primary-light);
        border-radius: 14px;
        padding: 10px 12px;
        align-items: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .sidebar-section .bg-white .flex:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(17, 24, 39, 0.08);
        background: linear-gradient(135deg, var(--color-primary-bg), #ffffff);
        border-color: var(--color-primary);
    }
    .sidebar-section .bg-white img {
        width: 64px;
        height: 64px;
        min-width: 64px;
        border-radius: 12px;
        box-shadow: 0 6px 14px rgba(17, 24, 39, 0.08);
    }
    .sidebar-section .bg-white .font-medium {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    @media (max-width: 640px) {
        .sidebar-section .bg-white .flex {
            padding: 10px;
        }
        .sidebar-section .bg-white img {
            width: 56px;
            height: 56px;
            min-width: 56px;
        }
    }
    
    /* Badge light */
    .badge-light {
        background-color: var(--color-primary-bg);
        color: var(--color-primary-dark);
    }
    
    /* Custom primary color text */
    .text-custom-primary {
        color: var(--color-primary);
    }
    
    /* Footer */
    .footer-custom {
        background-color: var(--color-primary);
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
        background-color: var(--color-primary-bg);
        color: var(--color-primary);
        padding-left: 24px;
    }
    
    /* Active state for dropdown toggle */
    .dropdown-menu:hover .dropdown-toggle,
    .dropdown-menu.active .dropdown-toggle {
        color: var(--color-primary);
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
        });

        // Header search: filter cards by title on homepage
        const searchInput = document.getElementById('searchInput');
        const searchCards = document.querySelectorAll('.search-card');

        const applySearch = () => {
            if (!searchInput) {
                return;
            }
            const query = searchInput.value.trim().toLowerCase();
            searchCards.forEach((card) => {
                const titleEl = card.querySelector('.search-title');
                const title = titleEl ? titleEl.textContent.trim().toLowerCase() : '';
                if (!query || title.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        };

        if (searchInput) {
            searchInput.addEventListener('input', applySearch);
        }

        // Hero carousel functionality
        const slides = Array.from(document.querySelectorAll('.carousel-slide'));
        const dots = Array.from(document.querySelectorAll('.carousel-dot'));
        const prevBtn = document.getElementById('carouselPrev');
        const nextBtn = document.getElementById('carouselNext');
        let currentIndex = slides.findIndex((slide) => slide.classList.contains('active'));
        if (currentIndex < 0) {
            currentIndex = 0;
        }
        let autoTimer = null;

        const updateCarousel = (index) => {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentIndex = index;
        };

        const goNext = () => {
            if (!slides.length) return;
            const nextIndex = (currentIndex + 1) % slides.length;
            updateCarousel(nextIndex);
        };

        const goPrev = () => {
            if (!slides.length) return;
            const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel(prevIndex);
        };

        const startAuto = () => {
            if (autoTimer || slides.length <= 1) return;
            autoTimer = setInterval(goNext, 5000);
        };

        const stopAuto = () => {
            if (autoTimer) {
                clearInterval(autoTimer);
                autoTimer = null;
            }
        };

        if (slides.length) {
            updateCarousel(currentIndex);
            startAuto();
        }

        prevBtn?.addEventListener('click', () => {
            stopAuto();
            goPrev();
            startAuto();
        });
        nextBtn?.addEventListener('click', () => {
            stopAuto();
            goNext();
            startAuto();
        });
        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const index = Number(dot.dataset.slide || 0);
                stopAuto();
                updateCarousel(index);
                startAuto();
            });
        });
        const carouselContainer = document.querySelector('.hero-slider-container');
        carouselContainer?.addEventListener('mouseenter', stopAuto);
        carouselContainer?.addEventListener('mouseleave', startAuto);
    });

</script>

</body>
</html>
