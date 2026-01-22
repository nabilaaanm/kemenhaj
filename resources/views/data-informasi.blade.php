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
                            data-i18n-placeholder="data.berhakLunas.search"
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <select class="border rounded-lg px-4 py-2 text-sm focus-custom">
                        <option data-i18n="data.berhakLunas.province.all">Semua Provinsi</option>
                        <option data-i18n="data.berhakLunas.province.westJava">Jawa Barat</option>
                        <option data-i18n="data.berhakLunas.province.centralJava">Jawa Tengah</option>
                        <option data-i18n="data.berhakLunas.province.eastJava">Jawa Timur</option>
                    </select>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.no">No</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.name">Nama</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.queue">Nomor Porsi</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.province">Provinsi</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">1</td>
                                <td class="py-3 px-4" data-i18n="data.berhakLunas.sample.name">Contoh Nama Jamaah</td>
                                <td class="py-3 px-4">123456789</td>
                                <td class="py-3 px-4" data-i18n="data.berhakLunas.sample.province1">Jawa Barat</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #F9E6D0; color: #8B6914;" data-i18n="data.berhakLunas.sample.status">Berhak Lunas</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">2</td>
                                <td class="py-3 px-4" data-i18n="data.berhakLunas.sample.name">Contoh Nama Jamaah</td>
                                <td class="py-3 px-4">123456790</td>
                                <td class="py-3 px-4" data-i18n="data.berhakLunas.sample.province2">Jawa Tengah</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #F9E6D0; color: #8B6914;" data-i18n="data.berhakLunas.sample.status">Berhak Lunas</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        <span data-i18n="data.berhakLunas.pagination">Menampilkan 1-10 dari 100 data</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100" data-i18n="data.pagination.prev">Previous</button>
                        <button class="px-3 py-1 border rounded text-sm bg-gray-100">1</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100" data-i18n="data.pagination.next">Next</button>
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
                        <h3 class="text-sm font-medium mb-2 opacity-90" data-i18n="data.statistik.card.totalPilgrims">Total Jamaah Haji</h3>
                        <p class="text-3xl font-bold">221,000</p>
                        <p class="text-sm mt-2 opacity-80" data-i18n="data.statistik.card.year">Tahun 1447H/2026M</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #D99D5F;">
                        <h3 class="text-sm font-medium mb-2 opacity-90" data-i18n="data.statistik.card.departed">Jamaah Berangkat</h3>
                        <p class="text-3xl font-bold">198,500</p>
                        <p class="text-sm mt-2 opacity-80" data-i18n="data.statistik.card.quota">89.8% dari kuota</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #ECB176;">
                        <h3 class="text-sm font-medium mb-2 opacity-90" data-i18n="data.statistik.card.waiting">Menunggu Keberangkatan</h3>
                        <p class="text-3xl font-bold">22,500</p>
                        <p class="text-sm mt-2 opacity-80" data-i18n="data.statistik.card.waitingQuota">10.2% dari kuota</p>
                    </div>
                    <div class="bg-gradient-to-br p-6 rounded-lg text-white" style="background-color: #D99D5F;">
                        <h3 class="text-sm font-medium mb-2 opacity-90" data-i18n="data.statistik.card.ppiu">PPIU Terdaftar</h3>
                        <p class="text-3xl font-bold">1,245</p>
                        <p class="text-sm mt-2 opacity-80" data-i18n="data.statistik.card.active">Aktif</p>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-semibold mb-4" data-i18n="data.statistik.quota.title">Distribusi Kuota per Provinsi</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm" data-i18n="data.statistik.quota.westJava">Jawa Barat</span>
                                    <span class="text-sm font-medium">27,833</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 35%;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm" data-i18n="data.statistik.quota.centralJava">Jawa Tengah</span>
                                    <span class="text-sm font-medium">18,500</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 23%;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm" data-i18n="data.statistik.quota.eastJava">Jawa Timur</span>
                                    <span class="text-sm font-medium">15,200</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="rounded-full h-2" style="background-color: #ECB176; width: 19%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-semibold mb-4" data-i18n="data.statistik.trend.title">Trend Pendaftaran</h3>
                        <div class="h-48 flex items-end justify-between gap-2">
                            <div class="flex-1 bg-gray-300 rounded-t" style="height: 60%;"></div>
                            <div class="flex-1 bg-gray-300 rounded-t" style="height: 75%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 85%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 90%;"></div>
                            <div class="flex-1 rounded-t" style="background-color: #ECB176; height: 70%;"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-600">
                            <span data-i18n="data.month.jan">Jan</span>
                            <span data-i18n="data.month.feb">Feb</span>
                            <span data-i18n="data.month.mar">Mar</span>
                            <span data-i18n="data.month.apr">Apr</span>
                            <span data-i18n="data.month.may">Mei</span>
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
                        <input type="text" id="kbihuSearch" placeholder="Cari KBIHU berdasarkan nama atau lokasi..."
                            data-i18n-placeholder="data.kbihu.search"
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- KBHU List -->
                <div class="space-y-4" id="kbihuList">
                    @forelse($kbihuData as $item)
                        @php
                            $mapsUrl = $item->maps_url;
                            if (!$mapsUrl && $item->latitude !== null && $item->longitude !== null) {
                                $mapsUrl = 'https://www.google.com/maps?q=' . $item->latitude . ',' . $item->longitude;
                            }
                        @endphp
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-2">{{ $item->nama }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium" data-i18n="data.kbihu.label.address">Alamat:</span> {{ $item->alamat }}
                                    </p>
                                    @if($item->tahun_berdiri)
                                        <p class="text-sm text-gray-600 mb-1">
                                            <span class="font-medium" data-i18n="data.kbihu.label.founded">Tahun Berdiri:</span> {{ $item->tahun_berdiri }}
                                        </p>
                                    @endif
                                    @if($item->nama_pimpinan)
                                        <p class="text-sm text-gray-600 mb-1">
                                            <span class="font-medium" data-i18n="data.kbihu.label.leader">Nama Pimpinan:</span> {{ $item->nama_pimpinan }}
                                        </p>
                                    @endif
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium" data-i18n="data.kbihu.label.phone">Telp:</span> {{ $item->telp ?? '-' }}
                                    </p>
                                </div>
                                @if($mapsUrl)
                                    <div class="flex-shrink-0">
                                        <a href="{{ $mapsUrl }}" target="_blank" rel="noopener"
                                           class="inline-block px-4 py-2 rounded-lg text-sm font-medium text-white hover:opacity-90 transition"
                                           style="background-color: #ECB176;">
                                            <span data-i18n="data.maps.open">Buka Maps</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="border border-gray-200 rounded-lg p-6 text-center text-sm text-gray-500">
                            <span data-i18n="data.kbihu.empty">Belum ada data KBIHU.</span>
                        </div>
                    @endforelse
                    @if($kbihuData->count() > 0)
                        <div id="kbihuEmptyResult" class="border border-gray-200 rounded-lg p-6 text-center text-sm text-gray-500" style="display: none;">
                            <span data-i18n="data.search.noMatch">Tidak ada data yang cocok.</span>
                        </div>
                    @endif
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
                        <input type="text" id="ppiuSearch" placeholder="Cari PPIU berdasarkan nama..."
                            data-i18n-placeholder="data.ppiu.search"
                            class="w-full border rounded-lg px-4 py-2 text-sm focus-custom">
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.table.no">No</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.name">Nama PPIU</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.director">Direktur</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.address">Alamat Cabang</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.phone">No Telp</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.accreditation">Terakreditasi</th>
                                <th class="text-left py-3 px-4 font-semibold" data-i18n="data.ppiu.table.maps">Maps</th>
                            </tr>
                        </thead>
                        <tbody id="ppiuTableBody">
                            @forelse($ppiuData as $index => $item)
                                @php
                                    $mapsUrl = $item->maps_url;
                                    if (!$mapsUrl && $item->latitude !== null && $item->longitude !== null) {
                                        $mapsUrl = 'https://www.google.com/maps?q=' . $item->latitude . ',' . $item->longitude;
                                    }
                                @endphp
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                                    <td class="py-3 px-4">{{ $item->nama }}</td>
                                    <td class="py-3 px-4">{{ $item->direktur ?? '-' }}</td>
                                    <td class="py-3 px-4">{{ $item->alamat }}</td>
                                    <td class="py-3 px-4">{{ $item->no_telp ?? '-' }}</td>
                                    <td class="py-3 px-4">{{ $item->terakreditasi ?? '-' }}</td>
                                    <td class="py-3 px-4">
                                        @if($mapsUrl)
                                            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener"
                                               class="inline-block px-3 py-1 rounded-lg text-xs font-medium text-white hover:opacity-90 transition"
                                               style="background-color: #ECB176;">
                                                <span data-i18n="data.maps.open">Buka Maps</span>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-6 text-center text-sm text-gray-500">
                                        <span data-i18n="data.ppiu.empty">Belum ada data PPIU.</span>
                                    </td>
                                </tr>
                            @endforelse
                            @if($ppiuData->count() > 0)
                                <tr id="ppiuEmptyResult" style="display: none;">
                                    <td colspan="7" class="py-6 text-center text-sm text-gray-500">
                                        <span data-i18n="data.search.noMatch">Tidak ada data yang cocok.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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

        // PPIU search filtering
        const ppiuSearch = document.getElementById('ppiuSearch');
        const ppiuTableBody = document.getElementById('ppiuTableBody');
        const ppiuEmptyResult = document.getElementById('ppiuEmptyResult');
        const ppiuRows = ppiuTableBody
            ? Array.from(ppiuTableBody.querySelectorAll('tr'))
                .filter(row => row.id !== 'ppiuEmptyResult' && row.querySelectorAll('td').length > 1)
            : [];

        const filterPpiuRows = () => {
            const query = (ppiuSearch?.value || '').toLowerCase().trim();
            let visibleCount = 0;

            ppiuRows.forEach(row => {
                const matches = row.textContent.toLowerCase().includes(query);
                row.style.display = matches ? '' : 'none';
                if (matches) {
                    visibleCount++;
                }
            });

            if (ppiuEmptyResult) {
                ppiuEmptyResult.style.display = visibleCount === 0 && query !== '' ? '' : 'none';
            }
        };

        if (ppiuSearch) {
            ppiuSearch.addEventListener('input', filterPpiuRows);
        }

        // KBIHU search filtering
        const kbihuSearch = document.getElementById('kbihuSearch');
        const kbihuList = document.getElementById('kbihuList');
        const kbihuEmptyResult = document.getElementById('kbihuEmptyResult');
        const kbihuItems = kbihuList
            ? Array.from(kbihuList.querySelectorAll(':scope > div'))
                .filter(item => item.id !== 'kbihuEmptyResult')
            : [];

        const filterKbihuItems = () => {
            const query = (kbihuSearch?.value || '').toLowerCase().trim();
            let visibleCount = 0;

            kbihuItems.forEach(item => {
                const matches = item.textContent.toLowerCase().includes(query);
                item.style.display = matches ? '' : 'none';
                if (matches) {
                    visibleCount++;
                }
            });

            if (kbihuEmptyResult) {
                kbihuEmptyResult.style.display = visibleCount === 0 && query !== '' ? '' : 'none';
            }
        };

        if (kbihuSearch) {
            kbihuSearch.addEventListener('input', filterKbihuItems);
        }
        
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
                'data.ppiu.title': 'Daftar PPIU (Penyelenggara Perjalanan Ibadah Umrah)',
                'data.berhakLunas.search': 'Cari berdasarkan nama atau nomor porsi...',
                'data.berhakLunas.province.all': 'Semua Provinsi',
                'data.berhakLunas.province.westJava': 'Jawa Barat',
                'data.berhakLunas.province.centralJava': 'Jawa Tengah',
                'data.berhakLunas.province.eastJava': 'Jawa Timur',
                'data.berhakLunas.table.no': 'No',
                'data.berhakLunas.table.name': 'Nama',
                'data.berhakLunas.table.queue': 'Nomor Porsi',
                'data.berhakLunas.table.province': 'Provinsi',
                'data.berhakLunas.table.status': 'Status',
                'data.berhakLunas.sample.name': 'Contoh Nama Jamaah',
                'data.berhakLunas.sample.province1': 'Jawa Barat',
                'data.berhakLunas.sample.province2': 'Jawa Tengah',
                'data.berhakLunas.sample.status': 'Berhak Lunas',
                'data.berhakLunas.pagination': 'Menampilkan 1-10 dari 100 data',
                'data.pagination.prev': 'Sebelumnya',
                'data.pagination.next': 'Berikutnya',
                'data.statistik.card.totalPilgrims': 'Total Jamaah Haji',
                'data.statistik.card.year': 'Tahun 1447H/2026M',
                'data.statistik.card.departed': 'Jamaah Berangkat',
                'data.statistik.card.quota': '89.8% dari kuota',
                'data.statistik.card.waiting': 'Menunggu Keberangkatan',
                'data.statistik.card.waitingQuota': '10.2% dari kuota',
                'data.statistik.card.ppiu': 'PPIU Terdaftar',
                'data.statistik.card.active': 'Aktif',
                'data.statistik.quota.title': 'Distribusi Kuota per Provinsi',
                'data.statistik.quota.westJava': 'Jawa Barat',
                'data.statistik.quota.centralJava': 'Jawa Tengah',
                'data.statistik.quota.eastJava': 'Jawa Timur',
                'data.statistik.trend.title': 'Trend Pendaftaran',
                'data.month.jan': 'Jan',
                'data.month.feb': 'Feb',
                'data.month.mar': 'Mar',
                'data.month.apr': 'Apr',
                'data.month.may': 'Mei',
                'data.kbihu.search': 'Cari KBIHU berdasarkan nama atau lokasi...',
                'data.kbihu.label.address': 'Alamat:',
                'data.kbihu.label.founded': 'Tahun Berdiri:',
                'data.kbihu.label.leader': 'Nama Pimpinan:',
                'data.kbihu.label.phone': 'Telp:',
                'data.kbihu.empty': 'Belum ada data KBIHU.',
                'data.ppiu.search': 'Cari PPIU berdasarkan nama...',
                'data.ppiu.table.name': 'Nama PPIU',
                'data.ppiu.table.director': 'Direktur',
                'data.ppiu.table.address': 'Alamat Cabang',
                'data.ppiu.table.phone': 'No Telp',
                'data.ppiu.table.accreditation': 'Terakreditasi',
                'data.ppiu.table.maps': 'Maps',
                'data.ppiu.empty': 'Belum ada data PPIU.',
                'data.table.no': 'No',
                'data.maps.open': 'Buka Maps',
                'data.search.noMatch': 'Tidak ada data yang cocok.'
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
                'data.ppiu.title': 'List of PPIU (Umrah Travel Organizers)',
                'data.berhakLunas.search': 'Search by name or queue number...',
                'data.berhakLunas.province.all': 'All Provinces',
                'data.berhakLunas.province.westJava': 'West Java',
                'data.berhakLunas.province.centralJava': 'Central Java',
                'data.berhakLunas.province.eastJava': 'East Java',
                'data.berhakLunas.table.no': 'No',
                'data.berhakLunas.table.name': 'Name',
                'data.berhakLunas.table.queue': 'Queue Number',
                'data.berhakLunas.table.province': 'Province',
                'data.berhakLunas.table.status': 'Status',
                'data.berhakLunas.sample.name': 'Sample Pilgrim Name',
                'data.berhakLunas.sample.province1': 'West Java',
                'data.berhakLunas.sample.province2': 'Central Java',
                'data.berhakLunas.sample.status': 'Eligible',
                'data.berhakLunas.pagination': 'Showing 1-10 of 100 records',
                'data.pagination.prev': 'Previous',
                'data.pagination.next': 'Next',
                'data.statistik.card.totalPilgrims': 'Total Hajj Pilgrims',
                'data.statistik.card.year': 'Year 1447H/2026M',
                'data.statistik.card.departed': 'Pilgrims Departed',
                'data.statistik.card.quota': '89.8% of quota',
                'data.statistik.card.waiting': 'Waiting for Departure',
                'data.statistik.card.waitingQuota': '10.2% of quota',
                'data.statistik.card.ppiu': 'Registered PPIU',
                'data.statistik.card.active': 'Active',
                'data.statistik.quota.title': 'Quota Distribution by Province',
                'data.statistik.quota.westJava': 'West Java',
                'data.statistik.quota.centralJava': 'Central Java',
                'data.statistik.quota.eastJava': 'East Java',
                'data.statistik.trend.title': 'Registration Trend',
                'data.month.jan': 'Jan',
                'data.month.feb': 'Feb',
                'data.month.mar': 'Mar',
                'data.month.apr': 'Apr',
                'data.month.may': 'May',
                'data.kbihu.search': 'Search KBIHU by name or location...',
                'data.kbihu.label.address': 'Address:',
                'data.kbihu.label.founded': 'Founded:',
                'data.kbihu.label.leader': 'Leader:',
                'data.kbihu.label.phone': 'Phone:',
                'data.kbihu.empty': 'No KBIHU data yet.',
                'data.ppiu.search': 'Search PPIU by name...',
                'data.ppiu.table.name': 'PPIU Name',
                'data.ppiu.table.director': 'Director',
                'data.ppiu.table.address': 'Branch Address',
                'data.ppiu.table.phone': 'Phone',
                'data.ppiu.table.accreditation': 'Accreditation',
                'data.ppiu.table.maps': 'Maps',
                'data.ppiu.empty': 'No PPIU data yet.',
                'data.table.no': 'No',
                'data.maps.open': 'Open Maps',
                'data.search.noMatch': 'No matching data.'
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

