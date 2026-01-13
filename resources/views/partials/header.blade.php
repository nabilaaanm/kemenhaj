<!-- ================= HEADER ================= -->
<header class="bg-white border-b sticky top-0 z-50 w-full">
    <div class="container-fixed">
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

                <!-- Language Selector -->
                <div class="relative language-selector">
                    <button class="language-toggle text-xs font-semibold border px-3 py-1.5 rounded-md hover:bg-gray-100 whitespace-nowrap flex items-center gap-1.5" id="languageToggle">
                        <span id="currentLang">ID</span>
                        <svg class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="language-dropdown" id="languageDropdown">
                        <button class="language-option active" data-lang="id" data-code="ID">
                            <span class="font-semibold">ID</span>
                            <span class="text-xs text-gray-600">Indonesia</span>
                        </button>
                        <button class="language-option" data-lang="en" data-code="EN">
                            <span class="font-semibold">EN</span>
                            <span class="text-xs text-gray-600">English</span>
                        </button>
                    </div>
                </div>

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

