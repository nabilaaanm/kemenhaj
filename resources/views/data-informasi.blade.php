<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/lambang.png') }}">
    <title>Data dan Informasi - Kementerian Haji dan Umrah Kota Cirebon</title>
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
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #8B6914;" data-i18n="data.title">
            Data dan Informasi
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto" data-i18n="data.subtitle">
            Informasi penting terkait penyelenggaraan ibadah haji untuk jamaah dan masyarakat umum
        </p>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-3 justify-center border-b border-gray-200">
            <button class="data-tab active px-6 py-3 text-sm font-medium transition" data-tab="berhak-lunas" data-i18n="data.tab.berhakLunas">
                Berhak Lunas
            </button>
            <button class="data-tab px-6 py-3 text-sm font-medium transition" data-tab="statistik" data-i18n="data.tab.statistik">
                Statistik
            </button>
            <button class="data-tab px-6 py-3 text-sm font-medium transition" data-tab="kbihu" data-i18n="data.tab.kbihu">
                KBIHU
            </button>
            <button class="data-tab px-6 py-3 text-sm font-medium transition" data-tab="ppiu" data-i18n="data.tab.ppiu">
                PPIU
            </button>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="data-tab-content">
        <!-- Berhak Lunas Tab -->
        <div id="tab-berhak-lunas" class="tab-panel active">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #8B6914;" data-i18n="data.berhakLunas.title">
                    Daftar Jamaah Berhak Lunas
                </h2>
                
                <!-- Search and Filter -->
                <div class="mb-6 flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="text" id="berhakLunasSearch" placeholder="Cari berdasarkan nama atau nomor porsi..." 
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <select class="border rounded-lg px-4 py-2 text-sm focus-custom">
                        <option>Semua Provinsi</option>
                        <option>Jawa Barat</option>
                        <option>Jawa Tengah</option>
                        <option>Jawa Timur</option>
                    </select>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold">No</th>
                                <th class="text-left py-3 px-4 font-semibold">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold">Nomor Porsi</th>
                                <th class="text-left py-3 px-4 font-semibold">Provinsi</th>
                                <th class="text-left py-3 px-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4">Contoh Nama Jamaah</td>
                                <td class="py-3 px-4">123456789</td>
                                <td class="py-3 px-4">Jawa Barat</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #F9E6D0; color: #8B6914;">Berhak Lunas</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">2</td>
                                <td class="py-3 px-4">Contoh Nama Jamaah</td>
                                <td class="py-3 px-4">123456790</td>
                                <td class="py-3 px-4">Jawa Tengah</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #F9E6D0; color: #8B6914;">Berhak Lunas</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan 1-10 dari 100 data
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Previous</button>
                        <button class="px-3 py-1 border rounded text-sm bg-gray-100">1</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Tab -->
        <div id="tab-statistik" class="tab-panel">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #8B6914;" data-i18n="data.statistik.title">
                    Statistik Haji dan Umrah
                </h2>

                <!-- Statistics Cards -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #ECB176;">
                        <h3 class="text-sm font-medium mb-2 opacity-90">Total Jamaah Haji</h3>
                        <p class="text-3xl font-bold">221,000</p>
                        <p class="text-sm mt-2 opacity-80">Tahun 1447H/2026M</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #D99D5F;">
                        <h3 class="text-sm font-medium mb-2 opacity-90">Jamaah Berangkat</h3>
                        <p class="text-3xl font-bold">198,500</p>
                        <p class="text-sm mt-2 opacity-80">89.8% dari kuota</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #ECB176;">
                        <h3 class="text-sm font-medium mb-2 opacity-90">Menunggu Keberangkatan</h3>
                        <p class="text-3xl font-bold">22,500</p>
                        <p class="text-sm mt-2 opacity-80">10.2% dari kuota</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #D99D5F;">
                        <h3 class="text-sm font-medium mb-2 opacity-90">PPIU Terdaftar</h3>
                        <p class="text-3xl font-bold">1,245</p>
                        <p class="text-sm mt-2 opacity-80">Aktif</p>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-semibold mb-4">Distribusi Kuota per Provinsi</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm">Jawa Barat</span>
                                    <span class="text-sm font-medium">27,833</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 35%;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm">Jawa Tengah</span>
                                    <span class="text-sm font-medium">18,500</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 23%;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm">Jawa Timur</span>
                                    <span class="text-sm font-medium">15,200</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 19%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-semibold mb-4">Trend Pendaftaran</h3>
                        <div class="h-48 flex items-end justify-between gap-2">
                            <div class="flex-1 bg-gray-300 rounded-t" style="height: 60%;"></div>
                            <div class="flex-1 bg-gray-300 rounded-t" style="height: 75%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 85%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 90%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 70%;"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-600">
                            <span>Jan</span>
                            <span>Feb</span>
                            <span>Mar</span>
                            <span>Apr</span>
                            <span>Mei</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KBHU Tab -->
        <div id="tab-kbihu" class="tab-panel">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #8B6914;" data-i18n="data.kbihu.title">
                    Daftar KBIHU (Kelompok Bimbingan Ibadah Haji Umrah)
                </h2>

                <!-- Search -->
                <div class="mb-6">
                    <div class="relative max-w-md">
                        <input type="text" placeholder="Cari KBIHU berdasarkan nama atau lokasi..." 
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- KBHU List -->
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">KBIHU Kota Cirebon</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-medium">Alamat:</span> Jl. Terusan Pemuda, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Telp:</span> (0231) 486047
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="inline-block px-4 py-2 rounded-lg text-sm font-medium text-white hover:opacity-90 transition" style="background-color: #ECB176;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">KBIHU Bandung</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-medium">Alamat:</span> Jl. Contoh, Bandung, Jawa Barat
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Telp:</span> (022) 123456
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="inline-block px-4 py-2 rounded-lg text-sm font-medium text-white hover:opacity-90 transition" style="background-color: #ECB176;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2">KBIHU Jakarta</h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-medium">Alamat:</span> Jl. M.H. Thamrin No.6, Jakarta Pusat
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Telp:</span> 021-3900020
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#" class="inline-block px-4 py-2 rounded-lg text-sm font-medium text-white hover:opacity-90 transition" style="background-color: #ECB176;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan 1-10 dari 50 KBIHU
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Previous</button>
                        <button class="px-3 py-1 border rounded text-sm bg-gray-100">1</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- PPIU Tab -->
        <div id="tab-ppiu" class="tab-panel">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #8B6914;" data-i18n="data.ppiu.title">
                    Daftar PPIU (Penyelenggara Perjalanan Ibadah Umrah)
                </h2>

                <!-- Search and Filter -->
                <div class="mb-6 flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input type="text" placeholder="Cari PPIU berdasarkan nama..." 
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <select class="border rounded-lg px-4 py-2 text-sm focus-custom">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold">No</th>
                                <th class="text-left py-3 px-4 font-semibold">Nama PPIU</th>
                                <th class="text-left py-3 px-4 font-semibold">No. Izin</th>
                                <th class="text-left py-3 px-4 font-semibold">Alamat</th>
                                <th class="text-left py-3 px-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4">PT. Contoh Umrah Indonesia</td>
                                <td class="py-3 px-4">PPIU-001/2025</td>
                                <td class="py-3 px-4">Jakarta</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">2</td>
                                <td class="py-3 px-4">PT. Haji Umrah Sejahtera</td>
                                <td class="py-3 px-4">PPIU-002/2025</td>
                                <td class="py-3 px-4">Bandung</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">3</td>
                                <td class="py-3 px-4">CV. Umrah Mandiri</td>
                                <td class="py-3 px-4">PPIU-003/2025</td>
                                <td class="py-3 px-4">Surabaya</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan 1-10 dari 1,245 PPIU
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Previous</button>
                        <button class="px-3 py-1 border rounded text-sm bg-gray-100">1</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Next</button>
                    </div>
                </div>
            </div>
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
    
    /* Footer */
    .footer-custom {
        background-color: #ECB176;
    }
    
    /* Tab Styles */
    .data-tab {
        position: relative;
        color: #6B7280;
        border-bottom: 2px solid transparent;
    }
    
    .data-tab:hover {
        color: #ECB176;
    }
    
    .data-tab.active {
        color: #ECB176;
        border-bottom-color: #ECB176;
    }
    
    /* Tab Panel */
    .tab-panel {
        display: none;
    }
    
    .tab-panel.active {
        display: block;
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
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.data-tab');
        const tabPanels = document.querySelectorAll('.tab-panel');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.dataset.tab;
                
                // Remove active class from all tabs and panels
                tabs.forEach(t => t.classList.remove('active'));
                tabPanels.forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding panel
                this.classList.add('active');
                document.getElementById('tab-' + targetTab).classList.add('active');
            });
        });
        
        // Dropdown menu functionality
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
                'nav.berita': 'Berita',
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
                'footer.address': 'Alamat',
                'footer.contact': 'Hubungi Kami',
                'footer.platform': 'Platform',
                // Data & Informasi
                'data.title': 'Data dan Informasi',
                'data.subtitle': 'Informasi penting terkait penyelenggaraan ibadah haji untuk jamaah dan masyarakat umum',
                'data.tab.berhakLunas': 'Berhak Lunas',
                'data.tab.statistik': 'Statistik',
                'data.tab.kbihu': 'KBIHU',
                'data.tab.ppiu': 'PPIU',
                'data.berhakLunas.title': 'Daftar Jamaah Berhak Lunas',
                'data.statistik.title': 'Statistik Haji dan Umrah',
                'data.kbihu.title': 'Daftar KBIHU (Kelompok Bimbingan Ibadah Haji Umrah)',
                'data.ppiu.title': 'Daftar PPIU (Penyelenggara Perjalanan Ibadah Umrah)'
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
                'nav.berita': 'News',
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
                'footer.address': 'Address',
                'footer.contact': 'Contact Us',
                'footer.platform': 'Platform',
                // Data & Informasi
                'data.title': 'Data and Information',
                'data.subtitle': 'Important information regarding the organization of Hajj pilgrimage for pilgrims and the general public',
                'data.tab.berhakLunas': 'Eligible for Payment',
                'data.tab.statistik': 'Statistics',
                'data.tab.kbihu': 'KBIHU',
                'data.tab.ppiu': 'PPIU',
                'data.berhakLunas.title': 'List of Pilgrims Eligible for Payment',
                'data.statistik.title': 'Hajj and Umrah Statistics',
                'data.kbihu.title': 'List of KBIHU (Hajj and Umrah Guidance Group)',
                'data.ppiu.title': 'List of PPIU (Umrah Travel Organizers)'
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
                ? 'Data dan Informasi - Kementerian Haji dan Umrah Kota Cirebon'
                : 'Data and Information - Ministry of Hajj and Umrah Cirebon City';
        }
        
        // Initialize language
        function initLanguage() {
            const langCode = currentLanguage === 'id' ? 'ID' : 'EN';
            if (currentLang) {
                currentLang.textContent = langCode;
            }
            
            // Update active state
            languageOptions.forEach(option => {
                if (option.dataset.lang === currentLanguage) {
                    option.classList.add('active');
                } else {
                    option.classList.remove('active');
                }
            });
            
            // Apply language changes
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
                if (currentLang) {
                    currentLang.textContent = selectedCode;
                }
                
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
        
        // Initialize on page load
        initLanguage();
    });
</script>

</body>
</html>

