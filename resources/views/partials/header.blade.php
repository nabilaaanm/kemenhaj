@php
    use Illuminate\Support\Facades\Schema;
    $primaryColor = 'var(--color-primary)';
    $mode = 'light';
    $menuHeaderPages = collect();
    $menuProfilPages = collect();
    $menuBeritaPages = collect();
    $menuGaleriPages = collect();
    $menuLayananPages = collect();
    $menuDataInformasiPages = collect();
    $menuLkPihPages = collect();
    $menuRegulasiPages = collect();
    if (Schema::hasTable('site_appearances')) {
        $appearance = \App\Models\SiteAppearance::first();
        if ($appearance?->primary_color) {
            $primaryColor = $appearance->primary_color;
        }
        if ($appearance?->mode) {
            $mode = $appearance->mode;
        }
    }
    if (Schema::hasTable('custom_pages')) {
        $menuHeaderPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'header')
            ->orderBy('order')
            ->get();
        $menuProfilPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'profil')
            ->orderBy('order')
            ->get();
        $menuBeritaPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'berita')
            ->orderBy('order')
            ->get();
        $menuGaleriPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'galeri')
            ->orderBy('order')
            ->get();
        $menuLayananPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'layanan')
            ->orderBy('order')
            ->get();
        $menuDataInformasiPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'data-informasi')
            ->orderBy('order')
            ->get();
        $menuLkPihPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'lk-pih')
            ->orderBy('order')
            ->get();
        $menuRegulasiPages = \App\Models\CustomPage::where('is_active', true)
            ->where('group', 'regulasi')
            ->orderBy('order')
            ->get();
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
    header.site-header {
        border-color: var(--color-primary) !important;
        background: #ffffff !important;
        position: relative;
    }
    header.site-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background-color: var(--color-primary);
        background-image:
            radial-gradient(circle at 8% 50%, rgba(255, 255, 255, 0.45) 0 2px, transparent 3px),
            radial-gradient(circle at 16% 20%, rgba(255, 255, 255, 0.35) 0 1.5px, transparent 3px),
            radial-gradient(circle at 24% 70%, rgba(255, 255, 255, 0.28) 0 2px, transparent 3px),
            radial-gradient(circle at 36% 35%, rgba(255, 255, 255, 0.4) 0 1.5px, transparent 3px),
            radial-gradient(circle at 48% 60%, rgba(255, 255, 255, 0.3) 0 2px, transparent 3px),
            radial-gradient(circle at 60% 30%, rgba(255, 255, 255, 0.35) 0 1.5px, transparent 3px),
            radial-gradient(circle at 72% 55%, rgba(255, 255, 255, 0.3) 0 2px, transparent 3px),
            radial-gradient(circle at 84% 25%, rgba(255, 255, 255, 0.4) 0 1.5px, transparent 3px),
            radial-gradient(circle at 92% 65%, rgba(255, 255, 255, 0.3) 0 2px, transparent 3px);
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15);
    }
    .footer-container {
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
    .dropdown-item {
        color: #111827;
        text-decoration: none;
    }
    .dropdown-item.dropdown-active {
        color: var(--color-primary) !important;
        background-color: var(--color-primary-bg) !important;
    }
    .dropdown-item:hover,
    .dropdown-item:focus {
        color: var(--color-primary) !important;
        background-color: var(--color-primary-bg) !important;
    }
    .nav-active {
        color: var(--color-primary) !important;
    }
    .nav-active svg {
        color: inherit;
    }
    .accessibility-widget {
        position: fixed;
        right: 22px;
        bottom: 22px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: flex-end;
        font-family: inherit;
    }
    .accessibility-toggle {
        width: 56px;
        height: 56px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.7);
        background: linear-gradient(145deg, #1f2937 0%, #334155 55%, #64748b 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.25);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .accessibility-toggle::after {
        content: '';
        position: absolute;
        inset: 2px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        pointer-events: none;
    }
    .accessibility-toggle:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.3);
    }
    .accessibility-panel {
        display: none;
        width: 280px;
        background: var(--card-bg);
        color: var(--page-text);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 14px;
        box-shadow: 0 24px 50px rgba(15, 23, 42, 0.25);
    }
    .accessibility-panel.active {
        display: block;
    }
    .accessibility-panel h4 {
        margin: 0 0 8px;
        font-size: 14px;
        font-weight: 700;
        color: inherit;
    }
    .accessibility-actions {
        display: grid;
        gap: 10px;
    }
    .accessibility-btn {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid var(--card-border);
        background: #f8fafc;
        color: #111827;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-start;
        transition: transform 0.15s ease, background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
    }
    .accessibility-btn:hover {
        transform: translateY(-1px);
    }
    .accessibility-btn.active {
        background: var(--color-primary-bg);
        color: var(--color-primary);
        border-color: var(--color-primary);
    }
    .accessibility-underline a {
        text-decoration: underline !important;
    }
    .accessibility-large-cursor * {
        cursor: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='36' height='36' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M3 2l6.5 18 2-5 5 5 2.5-2.5-5-5 5-2L3 2z'/%3E%3C/svg%3E") 2 2, auto !important;
    }
    .accessibility-line-height {
        line-height: 1.75 !important;
    }
    .accessibility-letter-spacing {
        letter-spacing: 0.04em !important;
    }
    .accessibility-pause-anim *,
    .accessibility-pause-anim *::before,
    .accessibility-pause-anim *::after {
        animation: none !important;
        transition: none !important;
    }
    .accessibility-large-text .header-row {
        flex-wrap: wrap;
    }
    .accessibility-large-text .header-nav {
        flex-wrap: wrap;
    }
    .mobile-menu-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #111827;
    }
    .mobile-menu-panel {
        display: none;
        position: fixed;
        top: 64px;
        left: 0;
        right: 0;
        max-height: calc(100vh - 64px);
        overflow-y: auto;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        z-index: 9998;
        padding: 16px 20px 24px;
    }
    .mobile-menu-panel.active {
        display: block;
    }
    .mobile-menu-section {
        margin-top: 16px;
    }
    .mobile-menu-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6b7280;
        margin-bottom: 8px;
    }
    .mobile-menu-link {
        display: block;
        padding: 10px 12px;
        border-radius: 10px;
        color: #111827;
        font-weight: 600;
        text-decoration: none;
    }
    .mobile-menu-link:hover {
        background: var(--color-primary-bg);
        color: var(--color-primary);
    }
    .mobile-search {
        margin-top: 12px;
    }
    .whatsapp-chat {
        position: fixed;
        right: 22px;
        bottom: 92px;
        z-index: 10000;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 999px;
        background: linear-gradient(140deg, #0f766e 0%, #059669 55%, #22c55e 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.2);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .whatsapp-chat:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.28);
    }
    .whatsapp-chat .wa-icon {
        width: 22px;
        height: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, 0.2);
        border-radius: 999px;
    }
    .whatsapp-bot {
        position: fixed;
        right: 22px;
        bottom: 160px;
        z-index: 10000;
        width: 320px;
        max-width: calc(100vw - 32px);
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);
        border: 1px solid #e5e7eb;
        display: none;
        overflow: hidden;
    }
    .whatsapp-bot.active {
        display: block;
    }
    .whatsapp-bot-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        background: linear-gradient(140deg, #0f766e 0%, #059669 55%, #22c55e 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 13px;
    }
    .whatsapp-bot-body {
        padding: 12px 14px;
        font-size: 13px;
        color: #111827;
        background: #f8fafc;
    }
    .whatsapp-bot-input {
        display: flex;
        gap: 8px;
        padding: 10px;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
    }
    .whatsapp-bot-input input {
        flex: 1;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
    }
    .whatsapp-bot-send {
        width: 38px;
        height: 38px;
        border-radius: 999px;
        border: none;
        background: linear-gradient(140deg, #0f766e 0%, #059669 55%, #22c55e 100%);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    @media (max-width: 640px) {
        .header-container {
            padding-left: 16px;
            padding-right: 16px;
        }
        .footer-container {
            padding-left: 16px;
            padding-right: 16px;
        }
    }
</style>
<script>
    document.documentElement.setAttribute('data-theme', '{{ $mode }}');
</script>

<!-- ================= HEADER ================= -->
<header class="bg-white border-b sticky top-0 z-50 w-full site-header">
    <div class="header-container">
        <div class="flex items-center justify-between header-row" style="min-height: 64px; height: auto; gap: 12px; padding: 8px 0;">

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

            <div class="flex items-center gap-3 lg:hidden">
                <button type="button" class="mobile-menu-toggle" id="mobileMenuToggle" aria-expanded="false" aria-controls="mobileMenuPanel">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            @php
                $isGaleriActive = request()->is('galeri') || request()->is('galeri/*');
            @endphp
            <!-- Navigation -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-gray-700 flex-shrink-0 header-nav" style="margin-right: auto;">
                <a href="/" class="hover-custom whitespace-nowrap" data-i18n="nav.home">Beranda</a>
                @foreach($menuHeaderPages as $menuPage)
                    <a href="{{ route('page.show', $menuPage->slug) }}" class="hover-custom whitespace-nowrap">{{ $menuPage->title }}</a>
                @endforeach
                
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
                        @foreach($menuProfilPages as $menuPage)
                            <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                        @endforeach
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
                        @foreach($menuBeritaPages as $menuPage)
                            <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                        @endforeach
                    </div>
                </div>

                @if($menuLayananPages->isNotEmpty())
                    <div class="relative dropdown-menu">
                        <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="layanan">
                            <span data-i18n="nav.services">Layanan</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-content" id="dropdown-layanan">
                            <a href="/layanan" class="dropdown-item" data-i18n="nav.services">Layanan</a>
                            @foreach($menuLayananPages as $menuPage)
                                <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="/layanan" class="hover-custom whitespace-nowrap" data-i18n="nav.services">Layanan</a>
                @endif

                @if($menuDataInformasiPages->isNotEmpty())
                    <div class="relative dropdown-menu">
                        <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="data-informasi">
                            <span data-i18n="nav.data">Data dan Informasi</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-content" id="dropdown-data-informasi">
                            <a href="/data-informasi" class="dropdown-item" data-i18n="nav.data">Data dan Informasi</a>
                            @foreach($menuDataInformasiPages as $menuPage)
                                <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="/data-informasi" class="hover-custom whitespace-nowrap" data-i18n="nav.data">Data dan Informasi</a>
                @endif

                {{-- LK & PIH (disabled) --}}
                {{-- @if($menuLkPihPages->isNotEmpty())
                    <div class="relative dropdown-menu">
                        <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="lk-pih">
                            <span data-i18n="nav.lk">LK & PIH</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-content" id="dropdown-lk-pih">
                            <a href="{{ route('lk-pih') }}" class="dropdown-item" data-i18n="nav.lk">LK & PIH</a>
                            @foreach($menuLkPihPages as $menuPage)
                                <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ route('lk-pih') }}" class="hover-custom whitespace-nowrap" data-i18n="nav.lk">LK & PIH</a>
                @endif --}}

                <!-- Galeri Dropdown -->
                <div class="relative dropdown-menu">
                    <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle {{ $isGaleriActive ? 'nav-active' : '' }}" data-dropdown="galeri">
                        <span data-i18n="nav.gallery">Galeri</span>
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-content" id="dropdown-galeri">
                        <a href="{{ route('galeri.foto') }}" class="dropdown-item {{ request()->routeIs('galeri.foto') ? 'dropdown-active' : '' }}" data-i18n="nav.photos">Foto</a>
                        <a href="{{ route('galeri.video') }}" class="dropdown-item {{ request()->routeIs('galeri.video') ? 'dropdown-active' : '' }}" data-i18n="nav.videos">Video</a>
                        <a href="{{ route('galeri.infografis') }}" class="dropdown-item {{ request()->routeIs('galeri.infografis') ? 'dropdown-active' : '' }}" data-i18n="nav.infographics">Infografis</a>
                        @foreach($menuGaleriPages as $menuPage)
                            <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                        @endforeach
                    </div>
                </div>

                @if($menuRegulasiPages->isNotEmpty())
                    <div class="relative dropdown-menu">
                        <button class="hover-custom whitespace-nowrap flex items-center gap-1 dropdown-toggle" data-dropdown="regulasi">
                            <span data-i18n="nav.regulation">Regulasi</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="dropdown-content" id="dropdown-regulasi">
                            <a href="/regulasi" class="dropdown-item" data-i18n="nav.regulation">Regulasi</a>
                            @foreach($menuRegulasiPages as $menuPage)
                                <a href="{{ route('page.show', $menuPage->slug) }}" class="dropdown-item">{{ $menuPage->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="/regulasi" class="hover-custom whitespace-nowrap" data-i18n="nav.regulation">Regulasi</a>
                @endif
            </nav>

            <!-- Right -->
            <div class="flex items-center gap-4 flex-shrink-0" style="margin-left: 24px; flex-wrap: nowrap;">
                {{-- User menu disembunyikan untuk keamanan --}}
                @if(session('user'))
                    {{-- Menu admin disembunyikan dari header untuk keamanan --}}
                    {{-- Admin dapat mengakses dashboard melalui URL langsung: /admin/dashboard --}}
                @endif

                <div class="relative hidden md:block" style="min-width: 180px; flex-shrink: 0;">
                    <input type="text" id="searchInput" data-i18n-placeholder="search.placeholder" placeholder="Cari berita"
                        class="border rounded-md pl-9 pr-3 py-1.5 text-sm focus-custom w-full"
                        style="min-width: 180px; white-space: nowrap;">
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

<div class="mobile-menu-panel" id="mobileMenuPanel" aria-hidden="true">
    <div class="mobile-search">
        <input type="text" placeholder="Cari berita"
            class="border rounded-lg px-4 py-2 text-sm focus-custom w-full"
            style="background: #f8fafc; border-color: #e5e7eb;">
    </div>
    <div class="mobile-menu-section">
        <a href="/" class="mobile-menu-link">Beranda</a>
        @foreach($menuHeaderPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Profil</div>
        <a href="/visi-misi" class="mobile-menu-link">Visi & Misi</a>
        <a href="/struktur-organisasi" class="mobile-menu-link">Struktur Organisasi</a>
        <a href="/sejarah" class="mobile-menu-link">Sejarah</a>
        <a href="/kontak" class="mobile-menu-link">Kontak</a>
        @foreach($menuProfilPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Berita</div>
        <a href="/berita" class="mobile-menu-link">Berita</a>
        <a href="/pengumuman" class="mobile-menu-link">Pengumuman</a>
        <a href="/siaran-pers" class="mobile-menu-link">Siaran Pers</a>
        <a href="/klarifikasi-hoax" class="mobile-menu-link">Klarifikasi Hoax</a>
        @foreach($menuBeritaPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Layanan</div>
        <a href="/layanan" class="mobile-menu-link">Layanan</a>
        @foreach($menuLayananPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Data & Informasi</div>
        <a href="/data-informasi" class="mobile-menu-link">Data dan Informasi</a>
        @foreach($menuDataInformasiPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    {{-- LK & PIH (disabled) --}}
    {{-- <div class="mobile-menu-section">
        <div class="mobile-menu-title">LK & PIH</div>
        <a href="{{ route('lk-pih') }}" class="mobile-menu-link">LK & PIH</a>
        @foreach($menuLkPihPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div> --}}
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Galeri</div>
        <a href="{{ route('galeri.foto') }}" class="mobile-menu-link">Foto</a>
        <a href="{{ route('galeri.video') }}" class="mobile-menu-link">Video</a>
        <a href="{{ route('galeri.infografis') }}" class="mobile-menu-link">Infografis</a>
        @foreach($menuGaleriPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
    <div class="mobile-menu-section">
        <div class="mobile-menu-title">Regulasi</div>
        <a href="/regulasi" class="mobile-menu-link">Regulasi</a>
        @foreach($menuRegulasiPages as $menuPage)
            <a href="{{ route('page.show', $menuPage->slug) }}" class="mobile-menu-link">{{ $menuPage->title }}</a>
        @endforeach
    </div>
</div>

@php
    $rawWhatsapp = $profilGlobal->whatsapp ?? '';
    $whatsappNumber = preg_replace('/\D+/', '', $rawWhatsapp);
    if ($whatsappNumber !== '') {
        if (str_starts_with($whatsappNumber, '0')) {
            $whatsappNumber = '62' . substr($whatsappNumber, 1);
        } elseif (!str_starts_with($whatsappNumber, '62') && str_starts_with($whatsappNumber, '8')) {
            $whatsappNumber = '62' . $whatsappNumber;
        }
    }
    $whatsappMessage = 'Assalamualaikum 😊, Saya ingin bertanya.';
    $waUrl = $whatsappNumber !== '' ? 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($whatsappMessage) : '';
@endphp

@if($whatsappNumber !== '')
<div class="whatsapp-bot" id="whatsappBot">
    <div class="whatsapp-bot-header">
        Chat WhatsApp
        <button type="button" id="whatsappBotClose" style="background: transparent; border: none; color: #ffffff; font-size: 16px; cursor: pointer;">×</button>
    </div>
    <div class="whatsapp-bot-body">
        Halo! Tulis pesan Anda, nanti langsung terkirim ke WhatsApp kami.
    </div>
    <div class="whatsapp-bot-input">
        <input type="text" id="whatsappBotInput" placeholder="Tulis pesan...">
        <button type="button" class="whatsapp-bot-send" id="whatsappBotSend" aria-label="Kirim pesan">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2 21l21-9L2 3v7l15 2-15 2v7z"/>
            </svg>
        </button>
    </div>
</div>

<a href="{{ $waUrl }}" class="whatsapp-chat" id="whatsappChatToggle" target="_blank" rel="noopener">
    <span class="wa-icon">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M20.52 3.48A11.82 11.82 0 0012 0 12 12 0 001.54 17.6L0 24l6.58-1.52A12 12 0 0012 24h.02a12 12 0 008.5-20.52zM12 22a10 10 0 01-5.1-1.4l-.36-.2-3.9.9.9-3.8-.24-.38A10 10 0 1112 22zm5.62-7.52c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.95 1.16-.17.2-.34.22-.64.07-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.5-1.8-1.68-2.1-.17-.3-.02-.46.13-.61.13-.13.3-.34.45-.5.15-.17.2-.3.3-.5.1-.2.05-.38-.02-.53-.07-.15-.67-1.6-.92-2.2-.24-.58-.5-.5-.67-.5h-.57c-.2 0-.53.08-.8.38-.27.3-1.05 1.03-1.05 2.5 0 1.48 1.08 2.92 1.23 3.12.15.2 2.12 3.23 5.15 4.53.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.75-.72 2-1.42.25-.7.25-1.3.18-1.42-.07-.12-.26-.2-.56-.35z"/>
        </svg>
    </span>
    Chat WhatsApp
</a>
@endif

<div class="accessibility-widget" aria-live="polite">
    <button type="button" class="accessibility-toggle" id="accessibilityToggle" aria-expanded="false" aria-controls="accessibilityPanel" title="Menu Aksesibilitas">
        <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4a2.5 2.5 0 100 5 2.5 2.5 0 000-5zm0 6.5v9m-5 0h10m-5-9l-3 4m3-4l3 4"/>
        </svg>
    </button>
    <div class="accessibility-panel" id="accessibilityPanel" role="dialog" aria-label="Menu Aksesibilitas">
        <h4>Menu Aksesibilitas</h4>
        <div class="accessibility-actions">
            <button type="button" class="accessibility-btn" id="accIncrease">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M12 6v12"/>
                </svg>
                Perbesar Teks
            </button>
            <button type="button" class="accessibility-btn" id="accDecrease">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12"/>
                </svg>
                Perkecil Teks
            </button>
            <button type="button" class="accessibility-btn" id="accContrast">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4a8 8 0 100 16V4z"/>
                </svg>
                Kontras Tinggi
            </button>
            <button type="button" class="accessibility-btn" id="accGrayscale">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4a8 8 0 018 8m-8-8a8 8 0 000 16m0-16v16"/>
                </svg>
                Grayscale
            </button>
            <button type="button" class="accessibility-btn" id="accUnderline">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4v6a4 4 0 108 0V4M5 20h14"/>
                </svg>
                Garis Bawah Tautan
            </button>
            <button type="button" class="accessibility-btn" id="accLineHeight">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 6h14M5 12h14M5 18h10"/>
                </svg>
                Tinggi Baris
            </button>
            <button type="button" class="accessibility-btn" id="accLetterSpacing">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h4m8 0h4M8 6l4 12m4-12l-4 12"/>
                </svg>
                Spasi Huruf
            </button>
            <button type="button" class="accessibility-btn" id="accCursor">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l7 16 2-6 6 4-7-16-8 2z"/>
                </svg>
                Kursor Besar
            </button>
            <button type="button" class="accessibility-btn" id="accPauseAnim">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h4v16H7zm6 0h4v16h-4z"/>
                </svg>
                Hentikan Animasi
            </button>
            <button type="button" class="accessibility-btn" id="accReset">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M6 18A7 7 0 0118 6"/>
                </svg>
                Reset
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        const toggle = document.getElementById('accessibilityToggle');
        const panel = document.getElementById('accessibilityPanel');
        if (!toggle || !panel) return;

        const settingsKey = 'accessibilitySettings';
        const defaultSettings = {
            fontScale: 100,
            contrast: false,
            grayscale: false,
            underline: false,
            lineHeight: false,
            letterSpacing: false,
            cursor: false,
            pauseAnim: false
        };
        const loadSettings = () => {
            try {
                const raw = localStorage.getItem(settingsKey);
                return raw ? { ...defaultSettings, ...JSON.parse(raw) } : { ...defaultSettings };
            } catch (e) {
                return { ...defaultSettings };
            }
        };
        const saveSettings = (settings) => {
            localStorage.setItem(settingsKey, JSON.stringify(settings));
        };
        const settings = loadSettings();

        const applySettings = () => {
            document.documentElement.style.fontSize = settings.fontScale + '%';
            document.documentElement.classList.toggle('accessibility-large-text', settings.fontScale > 100);
            document.documentElement.classList.toggle('accessibility-underline', settings.underline);
            document.documentElement.classList.toggle('accessibility-line-height', settings.lineHeight);
            document.documentElement.classList.toggle('accessibility-letter-spacing', settings.letterSpacing);
            document.documentElement.classList.toggle('accessibility-large-cursor', settings.cursor);
            document.documentElement.classList.toggle('accessibility-pause-anim', settings.pauseAnim);

            const filters = [];
            if (settings.contrast) filters.push('contrast(1.15)');
            if (settings.grayscale) filters.push('grayscale(1)');
            document.body.style.filter = filters.length ? filters.join(' ') : 'none';

            document.getElementById('accContrast')?.classList.toggle('active', settings.contrast);
            document.getElementById('accGrayscale')?.classList.toggle('active', settings.grayscale);
            document.getElementById('accUnderline')?.classList.toggle('active', settings.underline);
            document.getElementById('accLineHeight')?.classList.toggle('active', settings.lineHeight);
            document.getElementById('accLetterSpacing')?.classList.toggle('active', settings.letterSpacing);
            document.getElementById('accCursor')?.classList.toggle('active', settings.cursor);
            document.getElementById('accPauseAnim')?.classList.toggle('active', settings.pauseAnim);
        };

        applySettings();

        const setPanel = (open) => {
            panel.classList.toggle('active', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        };

        toggle.addEventListener('click', () => {
            setPanel(!panel.classList.contains('active'));
        });

        document.addEventListener('click', (event) => {
            if (!panel.contains(event.target) && !toggle.contains(event.target)) {
                setPanel(false);
            }
        });

        document.getElementById('accIncrease')?.addEventListener('click', () => {
            settings.fontScale = Math.min(settings.fontScale + 10, 130);
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accDecrease')?.addEventListener('click', () => {
            settings.fontScale = Math.max(settings.fontScale - 10, 90);
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accContrast')?.addEventListener('click', () => {
            settings.contrast = !settings.contrast;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accGrayscale')?.addEventListener('click', () => {
            settings.grayscale = !settings.grayscale;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accUnderline')?.addEventListener('click', () => {
            settings.underline = !settings.underline;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accLineHeight')?.addEventListener('click', () => {
            settings.lineHeight = !settings.lineHeight;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accLetterSpacing')?.addEventListener('click', () => {
            settings.letterSpacing = !settings.letterSpacing;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accCursor')?.addEventListener('click', () => {
            settings.cursor = !settings.cursor;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accPauseAnim')?.addEventListener('click', () => {
            settings.pauseAnim = !settings.pauseAnim;
            saveSettings(settings);
            applySettings();
        });

        document.getElementById('accReset')?.addEventListener('click', () => {
            settings.fontScale = defaultSettings.fontScale;
            settings.contrast = defaultSettings.contrast;
            settings.grayscale = defaultSettings.grayscale;
            settings.underline = defaultSettings.underline;
            settings.lineHeight = defaultSettings.lineHeight;
            settings.letterSpacing = defaultSettings.letterSpacing;
            settings.cursor = defaultSettings.cursor;
            settings.pauseAnim = defaultSettings.pauseAnim;
            saveSettings(settings);
            applySettings();
        });
    })();
</script>
<script>
    (function () {
        const toggle = document.getElementById('mobileMenuToggle');
        const panel = document.getElementById('mobileMenuPanel');
        if (!toggle || !panel) return;

        const setOpen = (open) => {
            panel.classList.toggle('active', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            panel.setAttribute('aria-hidden', open ? 'false' : 'true');
        };

        toggle.addEventListener('click', () => {
            setOpen(!panel.classList.contains('active'));
        });

        document.addEventListener('click', (event) => {
            if (!panel.contains(event.target) && !toggle.contains(event.target)) {
                setOpen(false);
            }
        });
    })();
</script>
<script>
    (function () {
        const bot = document.getElementById('whatsappBot');
        const openBtn = document.getElementById('whatsappChatToggle');
        const closeBtn = document.getElementById('whatsappBotClose');
        const input = document.getElementById('whatsappBotInput');
        const sendBtn = document.getElementById('whatsappBotSend');
        const whatsappNumber = "{{ $whatsappNumber }}";
        const defaultMessage = @json($whatsappMessage);
        if (!bot || !openBtn || !whatsappNumber) return;

        const openBot = (event) => {
            event.preventDefault();
            bot.classList.add('active');
            if (input && !input.value.trim()) {
                input.value = defaultMessage || '';
            }
            input?.focus();
        };
        const closeBot = () => {
            bot.classList.remove('active');
        };
        const sendMessage = () => {
            let text = (input?.value || '').trim();
            if (!text) {
                text = defaultMessage || '';
            }
            if (!text) return;
            const url = 'https://wa.me/' + whatsappNumber + '?text=' + encodeURIComponent(text);
            window.open(url, '_blank');
        };

        openBtn.addEventListener('click', openBot);
        closeBtn?.addEventListener('click', closeBot);
        sendBtn?.addEventListener('click', sendMessage);
        input?.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                sendMessage();
            }
        });
        document.addEventListener('click', (event) => {
            if (!bot.contains(event.target) && !openBtn.contains(event.target)) {
                closeBot();
            }
        });
    })();
</script>

