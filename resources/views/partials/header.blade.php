@php
    use Illuminate\Support\Facades\Schema;
    $primaryColor = 'var(--color-primary)';
    $mode = 'light';
    if (Schema::hasTable('site_appearances')) {
        $appearance = \App\Models\SiteAppearance::first();
        if ($appearance?->primary_color) {
            $primaryColor = $appearance->primary_color;
        }
        if ($appearance?->mode) {
            $mode = $appearance->mode;
        }
    }
    $normalizeHex = function ($hex) {
        $hex = trim($hex);
        if ($hex === '') {
            return 'var(--color-primary)';
        }
        if ($hex[0] !== '#') {
            $hex = '#' . $hex;
        }
        return preg_match('/^#([A-Fa-f0-9]{6})$/', $hex) ? strtoupper($hex) : 'var(--color-primary)';
    };
    $adjust = function ($hex, $steps) use ($normalizeHex) {
        $hex = $normalizeHex($hex);
        $steps = max(-255, min(255, $steps));
        $hex = str_replace('#', '', $hex);
        $r = max(0, min(255, hexdec(substr($hex, 0, 2)) + $steps));
        $g = max(0, min(255, hexdec(substr($hex, 2, 2)) + $steps));
        $b = max(0, min(255, hexdec(substr($hex, 4, 2)) + $steps));
        return sprintf('#%02X%02X%02X', $r, $g, $b);
    };
    $primaryColor = $normalizeHex($primaryColor);
    $primaryDark = $adjust($primaryColor, -25);
    $primaryLight = $adjust($primaryColor, 25);
    $primaryBg = $adjust($primaryColor, 60);
@endphp

<style>
    :root {
        --color-primary: {{ $primaryColor }};
        --color-primary-dark: {{ $primaryDark }};
        --color-primary-light: {{ $primaryLight }};
        --color-primary-bg: {{ $primaryBg }};
        --page-bg: #f9fafb;
        --page-text: #111827;
        --title-text: #111827;
        --footer-text: #111827;
        --footer-muted: #4b5563;
        --card-bg: #ffffff;
        --card-border: #e5e7eb;
    }
    html[data-theme="dark"] {
        --page-bg: #0f172a;
        --page-text: #e2e8f0;
        --title-text: #ffffff;
        --footer-text: #ffffff;
        --footer-muted: #cbd5f5;
        --card-bg: #111827;
        --card-border: #1f2937;
    }
    body {
        background-color: var(--page-bg) !important;
        color: var(--page-text) !important;
    }
    .bg-white {
        background-color: var(--card-bg) !important;
    }
    .border,
    .border-b,
    .border-t,
    .border-gray-200 {
        border-color: var(--card-border) !important;
    }
    .btn-custom {
        background-color: var(--color-primary) !important;
    }
    .btn-custom:hover {
        background-color: var(--color-primary-dark) !important;
    }
    .hover-custom:hover {
        color: var(--color-primary) !important;
    }
    .focus-custom:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 1px var(--color-primary) !important;
    }
    .footer-custom {
        background-color: var(--color-primary) !important;
    }
    .badge-custom {
        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary)) !important;
        color: #ffffff !important;
    }
    .text-custom-primary {
        color: var(--color-primary) !important;
    }
    .hover-border-primary:hover {
        border-color: var(--color-primary) !important;
    }
    .page-title {
        color: var(--title-text) !important;
    }
    .footer-text {
        color: var(--footer-text) !important;
    }
    .footer-muted {
        color: var(--footer-muted) !important;
    }
    .header-container {
        max-width: 1280px;
        margin: 0 auto;
        width: 100%;
        padding-left: 24px;
        padding-right: 24px;
        box-sizing: border-box;
    }
    .dropdown-content {
        margin-top: 0 !important;
        z-index: 9999 !important;
    }
    @media (max-width: 640px) {
        .header-container {
            padding-left: 16px;
            padding-right: 16px;
        }
    }
</style>
<script>
    document.documentElement.setAttribute('data-theme', '{{ $mode }}');
</script>

<!-- ================= HEADER ================= -->
<header class="bg-white border-b sticky top-0 z-50 w-full" style="border-color: var(--color-primary); background: linear-gradient(180deg, var(--color-primary-bg), #ffffff 65%);">
    <div class="header-container">
        <div class="flex items-center justify-between" style="height: 64px;">

            <!-- Logo -->
            <div class="flex items-center gap-3 flex-shrink-0" style="margin-right: 32px;">
                <a href="/">
                    <img src="/image/lambang.png" alt="Logo Kementerian Haji dan Umrah" style="height: 40px; width: auto; max-width: 100%;">
                </a>
                <div class="leading-tight flex-shrink-0">
                    <p class="text-sm font-semibold whitespace-nowrap">Kementerian Haji dan Umrah</p>
                    <p class="text-xs text-gray-500 whitespace-nowrap">Kota Cirebon</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-gray-700 flex-shrink-0" style="margin-right: auto;">
                <a href="/" class="hover-custom whitespace-nowrap" data-i18n="nav.home">Beranda</a>
                
                <!-- Profil Dropdown -->
                <div class="relative dropdown-menu">
                    <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="profil">
                        <span data-i18n="nav.profile">Profil</span>
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-content" id="dropdown-profil">
                        <a href="/visi-misi" class="dropdown-item" data-i18n="nav.vision">Visi & Misi</a>
                        <a href="/struktur-organisasi" class="dropdown-item" data-i18n="nav.structure">Struktur Organisasi</a>
                        <a href="/sejarah" class="dropdown-item" data-i18n="nav.history">Sejarah</a>
                        <a href="/kontak" class="dropdown-item" data-i18n="nav.contact">Kontak</a>
                    </div>
                </div>

                <!-- Berita Dropdown -->
                <div class="relative dropdown-menu">
                    <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="berita">
                        <span data-i18n="nav.news">Berita</span>
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-content" id="dropdown-berita">
                        <a href="/berita" class="dropdown-item" data-i18n="nav.berita">Berita</a>
                        <a href="/pengumuman" class="dropdown-item" data-i18n="nav.announcement">Pengumuman</a>
                        <a href="/siaran-pers" class="dropdown-item" data-i18n="nav.press">Siaran Pers</a>
                        <a href="/klarifikasi-hoax" class="dropdown-item" data-i18n="nav.hoax">Klarifikasi Hoax</a>
                    </div>
                </div>

                <a href="/layanan" class="hover-custom whitespace-nowrap" data-i18n="nav.services">Layanan</a>
                <a href="/data-informasi" class="hover-custom whitespace-nowrap" data-i18n="nav.data">Data dan Informasi</a>
                <a href="/lk-pih" class="hover-custom whitespace-nowrap" data-i18n="nav.lk">LK & PIH</a>

                <!-- Galeri Dropdown -->
                <div class="relative dropdown-menu">
                    <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="galeri">
                        <span data-i18n="nav.gallery">Galeri</span>
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-content" id="dropdown-galeri">
                        <a href="/foto" class="dropdown-item" data-i18n="nav.photos">Foto</a>
                        <a href="/video" class="dropdown-item" data-i18n="nav.videos">Video</a>
                        <a href="/infografis" class="dropdown-item" data-i18n="nav.infographics">Infografis</a>
                    </div>
                </div>

                <a href="/regulasi" class="hover-custom whitespace-nowrap" data-i18n="nav.regulation">Regulasi</a>
            </nav>

            <!-- Right -->
            <div class="flex items-center gap-4 flex-shrink-0" style="margin-left: 24px;">
                {{-- User menu disembunyikan untuk keamanan --}}
                @if(session('user'))
                    {{-- Menu admin disembunyikan dari header untuk keamanan --}}
                    {{-- Admin dapat mengakses dashboard melalui URL langsung: /admin/dashboard --}}
                @endif

                <div class="relative hidden md:block" style="min-width: 150px;">
                    <input type="text" id="searchInput" data-i18n-placeholder="search.placeholder" placeholder="Cari berita"
                        class="border rounded-md pl-9 pr-3 py-1.5 text-sm focus-custom w-full"
                        style="min-width: 150px;">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

        </div>
    </div>
</header>

