<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Kementerian Haji dan Umrah Kota Cirebon</title>
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
                                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4 page-title">
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
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4 page-title" data-i18n="hero.slide1.title">
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
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4 page-title" data-i18n="hero.slide2.title">
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
                        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4 page-title" data-i18n="hero.slide3.title">
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
                            <div class="news-meta-row mb-1">
                                <p class="news-meta">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                <p class="view-meta">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                        <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                                    </svg>
                                    {{ number_format($post->views ?? 0) }}x dilihat
                                </p>
                            </div>
                            <h3 class="news-title search-title text-sm mb-2">
                                {{ $post->title }}
                        </h3>
                            @php
                                $rawContent = $post->content ?? '';
                                $excerptText = '';
                                if (preg_match('/<p[^>]*>(.*?)<\/p>/si', $rawContent, $match)) {
                                    $excerptText = trim(strip_tags($match[1]));
                                } else {
                                    $excerptText = trim(strip_tags($rawContent));
                                }
                            @endphp
                            <p class="news-excerpt text-xs">
                                {{ \Illuminate\Support\Str::limit($excerptText, 160) }}
                            </p>
                            <div class="mt-3 news-footer flex items-center gap-2">
                                <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                                    Baca Selengkapnya
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <div class="share-group share-group--inline" data-share-group>
                                    <button type="button" class="share-toggle" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                        </svg>
                                        Bagikan
                                    </button>
                                    <div class="share-menu" role="menu">
                                        <div class="share-menu-title">Bagikan ke</div>
                                        <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                            <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                                </svg>
                                            </span>
                                            WhatsApp
                                        </a>
                                        <button type="button" class="share-item share-copy" data-share-provider="copy">
                                            <span class="share-icon share-icon--copy" aria-hidden="true">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                                </svg>
                                            </span>
                                            Salin Link
                                        </button>
                                    </div>
                                </div>
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
                            <div class="news-meta-row">
                                <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                <p class="view-meta">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                        <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                                    </svg>
                                    {{ number_format($post->views ?? 0) }}x dilihat
                                </p>
                            </div>
                            <div class="mt-2 news-footer">
                                <a href="{{ route('posting.show', $post->slug) }}" class="sidebar-readmore">
                                    Baca Selengkapnya
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <div class="share-group share-group--inline" data-share-group>
                                    <button type="button" class="share-toggle share-toggle--compact" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                        </svg>
                                        Bagikan
                                    </button>
                                    <div class="share-menu" role="menu">
                                        <div class="share-menu-title">Bagikan ke</div>
                                        <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                            <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                                </svg>
                                            </span>
                                            WhatsApp
                                        </a>
                                        <button type="button" class="share-item share-copy" data-share-provider="copy">
                                            <span class="share-icon share-icon--copy" aria-hidden="true">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                                </svg>
                                            </span>
                                            Salin Link
                                        </button>
                                    </div>
                                </div>
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
                                <div class="news-meta-row">
                                    <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                    <p class="view-meta">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                            <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                                        </svg>
                                        {{ number_format($post->views ?? 0) }}x dilihat
                                    </p>
                                </div>
                                <div class="mt-2 news-footer">
                                    <a href="{{ route('posting.show', $post->slug) }}" class="sidebar-readmore">
                                        Baca Selengkapnya
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    <div class="share-group share-group--inline" data-share-group>
                                        <button type="button" class="share-toggle share-toggle--compact" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                            </svg>
                                            Bagikan
                                        </button>
                                        <div class="share-menu" role="menu">
                                            <div class="share-menu-title">Bagikan ke</div>
                                            <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                                <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                                    </svg>
                                                </span>
                                                WhatsApp
                                            </a>
                                            <button type="button" class="share-item share-copy" data-share-provider="copy">
                                                <span class="share-icon share-icon--copy" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                                    </svg>
                                                </span>
                                                Salin Link
                                            </button>
                                        </div>
                                    </div>
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
                                <div class="news-meta-row">
                                    <p class="text-xs text-gray-500">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                                    <p class="view-meta">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                            <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                                        </svg>
                                        {{ number_format($post->views ?? 0) }}x dilihat
                                    </p>
                                </div>
                            <div class="mt-2 news-footer">
                                <a href="{{ route('posting.show', $post->slug) }}" class="sidebar-readmore">
                                    Baca Selengkapnya
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <div class="share-group share-group--inline" data-share-group>
                                        <button type="button" class="share-toggle share-toggle--compact" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                            </svg>
                                            Bagikan
                                        </button>
                                        <div class="share-menu" role="menu">
                                            <div class="share-menu-title">Bagikan ke</div>
                                            <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                                <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                                    </svg>
                                                </span>
                                                WhatsApp
                                            </a>
                                            <button type="button" class="share-item share-copy" data-share-provider="copy">
                                                <span class="share-icon share-icon--copy" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                                    </svg>
                                                </span>
                                                Salin Link
                                            </button>
                                        </div>
                                    </div>
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
        <a href="{{ route('berita.terkini') }}" class="btn-seeall" data-i18n="content.seeAll">
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
                    <div class="news-meta-row mb-2">
                        <p class="news-meta">{{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}</p>
                        <p class="view-meta">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/>
                                <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                            </svg>
                            {{ number_format($post->views ?? 0) }}x
                        </p>
                    </div>
                    <h3 class="news-title search-title text-base mb-2 line-clamp-2">
                        {{ $post->title }}
                </h3>
                    @php
                        $rawContent = $post->content ?? '';
                        $excerptText = '';
                        if (preg_match('/<p[^>]*>(.*?)<\/p>/si', $rawContent, $match)) {
                            $excerptText = trim(strip_tags($match[1]));
                        } else {
                            $excerptText = trim(strip_tags($rawContent));
                        }
                    @endphp
                    <p class="news-excerpt text-sm line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($excerptText, 120) }}
                    </p>
                    <div class="mt-3 news-footer flex items-center gap-2">
                        <a href="{{ route('posting.show', $post->slug) }}" class="btn-readmore">
                            Baca Selengkapnya
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <div class="share-group" data-share-group>
                            <button type="button" class="share-toggle" data-share-url="{{ route('posting.show', $post->slug) }}" data-share-title="{{ $post->title }}" aria-expanded="false">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 1 0-2.83-4H12a3 3 0 0 0 3 4zM9 13l6-3M9 11l6 3M6 22a3 3 0 1 0-2.83-4H3a3 3 0 0 0 3 4zM18 20a3 3 0 1 0-2.83-4H15a3 3 0 0 0 3 4z"/>
                                </svg>
                                Bagikan
                            </button>
                            <div class="share-menu" role="menu">
                                <div class="share-menu-title">Bagikan ke</div>
                                            <a class="share-item" data-share-provider="whatsapp" href="#" target="_blank" rel="noopener">
                                                <span class="share-icon share-icon--whatsapp" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.768.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.654-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.372-.025-.521-.075-.148-.672-1.611-.92-2.206-.242-.579-.487-.5-.672-.51-.173-.01-.372-.01-.571-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.064 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.075-.124-.272-.198-.57-.347M12.005 2.005c-5.514 0-9.99 4.476-9.99 9.99 0 1.77.464 3.46 1.344 4.956L2 22l5.202-1.366A9.93 9.93 0 0 0 12.005 22c5.514 0 9.99-4.476 9.99-9.99 0-5.514-4.476-9.99-9.99-9.99z"/>
                                                    </svg>
                                                </span>
                                                WhatsApp
                                            </a>
                                            <button type="button" class="share-item share-copy" data-share-provider="copy">
                                                <span class="share-icon share-icon--copy" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 13.5l3-3m-6.75 6.75a4.5 4.5 0 0 1 0-6.364l2.122-2.122a4.5 4.5 0 0 1 6.364 6.364l-1.061 1.06"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5l-3 3m6.75-6.75a4.5 4.5 0 0 1 0 6.364l-2.122 2.122a4.5 4.5 0 0 1-6.364-6.364l1.06-1.06"/>
                                                    </svg>
                                                </span>
                                                Salin Link
                                            </button>
                            </div>
                        </div>
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
        <a href="{{ route('galeri.video') }}" class="btn-seeall" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeVideos as $video)
            @php
                $videoUrl = $video->video_url;
                $isEmbedUrl = $video->url && (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false || strpos($video->url, 'vimeo.com') !== false);
                $isDirectFile = $video->file_path && !empty($video->file_path);
                $embedUrl = '';
                if ($isEmbedUrl && $video->url) {
                    $url = $video->url;
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
                }
                $thumbnailUrl = $video->video_thumbnail_url ?: $video->image_url;
            @endphp
            <article class="news-card search-card home-video-item"
                     role="button"
                     tabindex="0"
                     data-video-url="{{ $videoUrl }}"
                     data-embed-url="{{ $embedUrl }}"
                     data-video-type="{{ $isEmbedUrl ? 'embed' : ($isDirectFile ? 'file' : 'none') }}">
                <div class="home-video-thumb">
                    <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}"
                         class="news-thumb" style="display: block;"
                         onerror="this.src='https://via.placeholder.com/800x450/ECB176/FFFFFF?text=Video'; this.onerror=null;">
                    <div class="home-video-play">
                        <svg class="w-6 h-6 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
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
            </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full" data-i18n="content.noNews">
                Tidak ada video tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- Video Modal -->
<div id="homeVideoModal" class="home-video-modal">
    <span class="home-video-close">&times;</span>
    <div class="home-video-modal-content" id="homeVideoModalContent"></div>
</div>

<!-- ================= INFOGRAFIS SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.infographic">Infografis</h2>
        <a href="{{ route('galeri.infografis') }}" class="btn-seeall" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeInfografis as $infografis)
            <article class="news-card search-card home-infografis-item"
                     role="button"
                     tabindex="0"
                     data-src="{{ $infografis->image_url }}"
                     data-title="{{ $infografis->title }}"
                     data-description="{{ e($infografis->description ?? '') }}">
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
            </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full" data-i18n="content.noNews">
                Tidak ada infografis tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- Infografis Modal -->
<div id="homeInfografisModal" class="home-image-modal">
    <span class="home-image-close">&times;</span>
    <div class="home-image-modal-content">
        <img id="homeInfografisImage" src="" alt="Infografis">
        <div class="home-image-caption">
            <h3 id="homeInfografisTitle"></h3>
            <p id="homeInfografisDesc"></p>
        </div>
    </div>
</div>

<!-- ================= FOTO SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.photos">Foto</h2>
        <a href="{{ route('galeri.foto') }}" class="btn-seeall" data-i18n="content.seeAll">
            Lihat Semua →
        </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($homeFotos as $foto)
            <article class="news-card search-card home-foto-item"
                     role="button"
                     tabindex="0"
                     data-src="{{ $foto->image_url }}"
                     data-title="{{ $foto->title }}"
                     data-description="{{ e($foto->description ?? '') }}">
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
            </article>
        @empty
            <p class="text-sm text-gray-500 text-center py-6 col-span-full">
                Tidak ada foto tersedia
            </p>
        @endforelse
    </div>
</section>

<!-- Foto Modal -->
<div id="homeFotoModal" class="home-image-modal">
    <span class="home-image-close">&times;</span>
    <div class="home-image-modal-content">
        <img id="homeFotoImage" src="" alt="Foto">
        <div class="home-image-caption">
            <h3 id="homeFotoTitle"></h3>
            <p id="homeFotoDesc"></p>
        </div>
    </div>
</div>

<!-- ================= REGULASI SECTION ================= -->
<section class="container-fixed py-10 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold" data-i18n="content.regulation">Regulasi</h2>
        <a href="{{ route('regulasi') }}" class="btn-seeall" data-i18n="content.seeAll">
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
                            @php
                                $downloadName = trim((string) $regulation->title);
                                if ($downloadName !== '' && !\Illuminate\Support\Str::endsWith(strtolower($downloadName), '.pdf')) {
                                    $downloadName .= '.pdf';
                                }
                            @endphp
                            <a href="{{ $regulation->file_url }}" class="btn-readmore" download="{{ $downloadName }}">
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
    .hero-content .page-title {
        color: #ffffff !important;
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
    .share-group { position: relative; display: inline-flex; }
    .share-group--up .share-menu {
        top: auto;
        bottom: calc(100% + 8px);
    }
    .share-group--inline {
        display: inline-flex;
    }
    .sidebar-section .share-group,
    .sidebar-section .share-group--inline {
        width: 100%;
    }
    .sidebar-section .share-toggle {
        width: 100%;
        justify-content: center;
    }
    .sidebar-section .news-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    .sidebar-readmore {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        color: var(--color-primary-dark);
        text-decoration: none;
    }
    .sidebar-readmore:hover {
        color: var(--color-primary);
    }
    .sidebar-readmore svg {
        width: 14px;
        height: 14px;
    }
    .share-toggle {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid var(--color-primary-light);
        background: #ffffff;
        color: var(--color-primary-dark);
        font-weight: 600;
        font-size: 12px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .share-toggle svg { width: 14px; height: 14px; }
    .share-toggle:hover {
        background: var(--color-primary-bg);
        border-color: var(--color-primary);
        color: var(--color-primary);
    }
    .share-toggle--compact { font-size: 11px; padding: 4px 8px; }
    .share-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 14px;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.16);
        padding: 10px;
        display: none;
        min-width: 180px;
        z-index: 30;
    }
    .share-group.active .share-menu { display: block; }
    .share-menu-title {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9ca3af;
        padding: 6px 10px 4px;
    }
    .share-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 8px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        width: 100%;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .share-item:hover {
        background: #ffffff;
        color: var(--color-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        border-color: rgba(15, 23, 42, 0.08);
    }
    .share-icon {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #eef2f7;
        color: #374151;
    }
    .share-icon svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }
    .share-icon--copy svg {
        fill: none;
        stroke: currentColor;
    }
    .share-icon--whatsapp { background: rgba(34, 197, 94, 0.14); color: #16a34a; }
    .share-icon--copy { background: rgba(107, 114, 128, 0.16); color: #4b5563; }
    .share-copy.is-copied { background: var(--color-primary); color: #ffffff; }
    .btn-seeall {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        color: #ffffff;
        background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary-light));
        box-shadow: 0 8px 16px rgba(17, 24, 39, 0.12);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }
    .btn-seeall:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(17, 24, 39, 0.18);
        background: var(--color-primary);
    }
    @media (max-width: 640px) {
        .btn-seeall {
            font-size: 12px;
            padding: 7px 14px;
        }
    }

    /* News cards */
    .news-card {
        background: white;
        border-radius: 16px;
        overflow: visible;
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
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
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
        background: linear-gradient(90deg, var(--color-primary-dark), var(--color-primary-light));
    }
    .news-meta {
        font-size: 12px;
        color: #9ca3af;
    }
    .news-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }
    .view-meta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: var(--color-primary-dark);
        background: #ffffff;
        border: 1px solid var(--color-primary);
        padding: 2px 8px;
        border-radius: 999px;
        width: fit-content;
        box-shadow: 0 6px 14px rgba(17, 24, 39, 0.08);
    }
    .view-meta svg {
        width: 14px;
        height: 14px;
        stroke: var(--color-primary-dark);
    }

    /* Sidebar cards (Pengumuman & Klarifikasi Hoax) */
    .sidebar-section .bg-white .flex {
        border-bottom: none !important;
        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary-bg));
        border: 1px solid var(--color-primary-light);
        border-radius: 14px;
        padding: 10px 12px;
        align-items: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .sidebar-section .bg-white .flex:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(17, 24, 39, 0.08);
        background: var(--color-primary-bg);
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

    @media (max-width: 768px) {
        .hero-slider-container {
            height: 320px !important;
            min-height: 320px !important;
            max-height: 380px !important;
        }
        .hero-content {
            max-width: 100% !important;
            padding: 0 16px;
        }
        .hero-content .page-title {
            font-size: 24px !important;
            line-height: 1.25;
        }
        .carousel-nav {
            width: 36px;
            height: 36px;
            min-width: 36px;
            min-height: 36px;
        }
        .carousel-prev {
            left: 10px;
        }
        .carousel-next {
            right: 10px;
        }
        .carousel-dots {
            bottom: 12px;
        }
    }
    
    .home-video-thumb {
        position: relative;
    }
    
    .home-video-play {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }
    
    .home-video-play svg {
        width: 24px;
        height: 24px;
        position: relative;
        z-index: 2;
    }
    
    .home-video-play::before {
        content: '';
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 999px;
        position: absolute;
        z-index: 1;
    }
    
    .home-video-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    
    .home-video-modal.active {
        display: flex;
    }
    
    .home-video-modal-content {
        width: 90vw;
        height: 90vh;
        max-width: 1200px;
        max-height: 90vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .home-video-modal-content iframe,
    .home-video-modal-content video {
        width: 100%;
        height: 100%;
        border: 0;
        object-fit: contain;
        background: #000;
    }
    
    .home-video-close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 1001;
    }
    
    .home-video-close:hover {
        color: var(--color-primary);
    }

    .home-image-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    
    .home-image-modal.active {
        display: flex;
    }
    
    .home-image-modal-content {
        width: 90vw;
        max-width: 1100px;
        max-height: 90vh;
        text-align: center;
    }
    
    .home-image-modal-content img {
        width: 100%;
        height: auto;
        max-height: 75vh;
        object-fit: contain;
        border-radius: 12px;
        background: #000;
    }
    
    .home-image-caption {
        margin-top: 12px;
        color: #e5e7eb;
    }
    
    .home-image-caption h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 6px;
    }
    
    .home-image-caption p {
        font-size: 14px;
        color: #cbd5f5;
    }
    
    .home-image-close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 1001;
    }
    
    .home-image-close:hover {
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

        const shareGroups = document.querySelectorAll('[data-share-group]');
        const buildShareUrls = (url, title) => {
            const encodedUrl = encodeURIComponent(url);
            const encodedTitle = encodeURIComponent(title || '');
            const text = encodedTitle ? `${encodedTitle}%0A${encodedUrl}` : encodedUrl;
            return {
                whatsapp: `https://wa.me/?text=${text}`,
                facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
                instagram: `https://www.instagram.com/?url=${encodedUrl}`,
                tiktok: `https://www.tiktok.com/share?url=${encodedUrl}`,
                twitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`,
            };
        };

        const closeShareGroups = () => {
            shareGroups.forEach(group => {
                group.classList.remove('active');
                const toggle = group.querySelector('.share-toggle');
                if (toggle) toggle.setAttribute('aria-expanded', 'false');
            });
        };

        shareGroups.forEach(group => {
            const toggle = group.querySelector('.share-toggle');
            const menu = group.querySelector('.share-menu');
            const copyBtn = group.querySelector('.share-copy');
            if (!toggle || !menu) return;

            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const isActive = group.classList.contains('active');
                closeShareGroups();
                if (!isActive) {
                    const url = toggle.getAttribute('data-share-url') || window.location.href;
                    const title = toggle.getAttribute('data-share-title') || document.title;
                    const urls = buildShareUrls(url, title);
                    menu.querySelectorAll('[data-share-provider]').forEach(item => {
                        const provider = item.getAttribute('data-share-provider');
                        if (provider && urls[provider]) {
                            item.setAttribute('href', urls[provider]);
                        }
                    });
                    group.classList.add('active');
                    toggle.setAttribute('aria-expanded', 'true');
                    const card = group.closest('.news-card');
                }
            });

            if (copyBtn) {
                copyBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const url = toggle.getAttribute('data-share-url') || window.location.href;
                    try {
                        if (navigator.clipboard && window.isSecureContext) {
                            await navigator.clipboard.writeText(url);
                        } else {
                            const tempInput = document.createElement('input');
                            tempInput.value = url;
                            document.body.appendChild(tempInput);
                            tempInput.select();
                            document.execCommand('copy');
                            tempInput.remove();
                        }
                        copyBtn.classList.add('is-copied');
                        const originalText = copyBtn.textContent;
                        copyBtn.textContent = 'Tersalin';
                        setTimeout(() => {
                            copyBtn.classList.remove('is-copied');
                            copyBtn.textContent = originalText;
                            closeShareGroups();
                        }, 1200);
                    } catch (err) {
                        copyBtn.textContent = 'Gagal menyalin';
                        setTimeout(() => {
                            copyBtn.textContent = 'Salin Link';
                        }, 1400);
                    }
                });
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('[data-share-group]')) {
                closeShareGroups();
            }
        });

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

        // Homepage video modal
        const homeVideoItems = document.querySelectorAll('.home-video-item');
        const homeVideoModal = document.getElementById('homeVideoModal');
        const homeVideoModalContent = document.getElementById('homeVideoModalContent');
        const homeVideoClose = document.querySelector('.home-video-close');

        const openHomeVideoModal = (item) => {
            if (!item || !homeVideoModalContent || !homeVideoModal) {
                return;
            }
            const type = item.dataset.videoType;
            const fileUrl = item.dataset.videoUrl;
            const embedUrl = item.dataset.embedUrl;
            homeVideoModalContent.innerHTML = '';

            if (type === 'embed' && embedUrl) {
                const iframe = document.createElement('iframe');
                iframe.src = embedUrl + (embedUrl.includes('?') ? '&' : '?') + 'autoplay=1';
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.setAttribute('allowfullscreen', 'true');
                homeVideoModalContent.appendChild(iframe);
            } else if (type === 'file' && fileUrl) {
                const video = document.createElement('video');
                video.src = fileUrl;
                video.controls = true;
                video.autoplay = true;
                homeVideoModalContent.appendChild(video);
            } else if (embedUrl) {
                const iframe = document.createElement('iframe');
                iframe.src = embedUrl;
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.setAttribute('allowfullscreen', 'true');
                homeVideoModalContent.appendChild(iframe);
            } else {
                const message = document.createElement('div');
                message.style.color = '#fff';
                message.style.textAlign = 'center';
                message.textContent = 'Video tidak tersedia.';
                homeVideoModalContent.appendChild(message);
            }

            homeVideoModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeHomeVideoModal = () => {
            if (!homeVideoModal) return;
            homeVideoModal.classList.remove('active');
            if (homeVideoModalContent) {
                homeVideoModalContent.innerHTML = '';
            }
            document.body.style.overflow = '';
        };

        homeVideoItems.forEach((item) => {
            item.addEventListener('click', () => openHomeVideoModal(item));
            item.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openHomeVideoModal(item);
                }
            });
        });

        homeVideoClose?.addEventListener('click', closeHomeVideoModal);
        homeVideoModal?.addEventListener('click', (e) => {
            if (e.target === homeVideoModal) {
                closeHomeVideoModal();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (homeVideoModal?.classList.contains('active') && e.key === 'Escape') {
                closeHomeVideoModal();
            }
        });

        // Homepage infografis modal
        const homeInfografisItems = document.querySelectorAll('.home-infografis-item');
        const homeInfografisModal = document.getElementById('homeInfografisModal');
        const homeInfografisImage = document.getElementById('homeInfografisImage');
        const homeInfografisTitle = document.getElementById('homeInfografisTitle');
        const homeInfografisDesc = document.getElementById('homeInfografisDesc');
        const homeInfografisClose = document.querySelector('.home-image-close');

        const openInfografisModal = (item) => {
            if (!item || !homeInfografisModal || !homeInfografisImage) return;
            const src = item.dataset.src || '';
            const title = item.dataset.title || '';
            const desc = item.dataset.description || '';

            homeInfografisImage.src = src;
            homeInfografisImage.alt = title || 'Infografis';
            if (homeInfografisTitle) homeInfografisTitle.textContent = title;
            if (homeInfografisDesc) {
                homeInfografisDesc.textContent = desc;
                homeInfografisDesc.style.display = desc ? '' : 'none';
            }
            homeInfografisModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeInfografisModal = () => {
            if (!homeInfografisModal) return;
            homeInfografisModal.classList.remove('active');
            if (homeInfografisImage) homeInfografisImage.src = '';
            if (homeInfografisTitle) homeInfografisTitle.textContent = '';
            if (homeInfografisDesc) homeInfografisDesc.textContent = '';
            document.body.style.overflow = '';
        };

        homeInfografisItems.forEach((item) => {
            item.addEventListener('click', () => openInfografisModal(item));
            item.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openInfografisModal(item);
                }
            });
        });

        homeInfografisClose?.addEventListener('click', closeInfografisModal);
        homeInfografisModal?.addEventListener('click', (e) => {
            if (e.target === homeInfografisModal) {
                closeInfografisModal();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (homeInfografisModal?.classList.contains('active') && e.key === 'Escape') {
                closeInfografisModal();
            }
        });

        // Homepage foto modal
        const homeFotoItems = document.querySelectorAll('.home-foto-item');
        const homeFotoModal = document.getElementById('homeFotoModal');
        const homeFotoImage = document.getElementById('homeFotoImage');
        const homeFotoTitle = document.getElementById('homeFotoTitle');
        const homeFotoDesc = document.getElementById('homeFotoDesc');

        const openFotoModal = (item) => {
            if (!item || !homeFotoModal || !homeFotoImage) return;
            const src = item.dataset.src || '';
            const title = item.dataset.title || '';
            const desc = item.dataset.description || '';

            homeFotoImage.src = src;
            homeFotoImage.alt = title || 'Foto';
            if (homeFotoTitle) homeFotoTitle.textContent = title;
            if (homeFotoDesc) {
                homeFotoDesc.textContent = desc;
                homeFotoDesc.style.display = desc ? '' : 'none';
            }
            homeFotoModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeFotoModal = () => {
            if (!homeFotoModal) return;
            homeFotoModal.classList.remove('active');
            if (homeFotoImage) homeFotoImage.src = '';
            if (homeFotoTitle) homeFotoTitle.textContent = '';
            if (homeFotoDesc) homeFotoDesc.textContent = '';
            document.body.style.overflow = '';
        };

        homeFotoItems.forEach((item) => {
            item.addEventListener('click', () => openFotoModal(item));
            item.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openFotoModal(item);
                }
            });
        });

        document.querySelectorAll('#homeFotoModal .home-image-close').forEach((btn) => {
            btn.addEventListener('click', closeFotoModal);
        });
        homeFotoModal?.addEventListener('click', (e) => {
            if (e.target === homeFotoModal) {
                closeFotoModal();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (homeFotoModal?.classList.contains('active') && e.key === 'Escape') {
                closeFotoModal();
            }
        });
    });

</script>

</body>
</html>
