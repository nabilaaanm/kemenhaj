<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    @include('partials.favicon')
    <title>Data dan Informasi - {{ $siteSetting->title_suffix }}</title>
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

<!-- ================= MAIN CONTENT ================= -->
<main class="container-fixed py-12 w-full" style="width: 100%; max-width: 100%; box-sizing: border-box;">
    
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 page-title" style="color: #111827;" data-i18n="data.title">
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
                <h2 class="text-2xl font-bold mb-6" style="color: #111827;" data-i18n="data.berhakLunas.title">
                    Daftar Jamaah Berhak Lunas
                </h2>
                
                <!-- Search -->
                <form class="mb-6 flex flex-col md:flex-row gap-4" method="GET" action="{{ url('/data-informasi') }}">
                    <div class="flex-1 relative">
                        <input type="text" id="berhakLunasSearch" name="nomor_porsi"
                            value="{{ $berhakLunasQuery ?? '' }}"
                            placeholder="Masukkan nomor porsi..." 
                            class="w-full border rounded-xl px-4 py-3 text-sm focus-custom"
                            style="background: #f8fafc; border-color: #e5e7eb;">
                        <svg class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button type="submit" class="px-5 py-3 rounded-xl text-sm font-semibold text-white btn-custom" style="min-width: 120px;">
                        Cari
                    </button>
                    @if(!empty($berhakLunasSearched) && $berhakLunasSearched)
                        <a href="{{ url('/data-informasi') }}" class="px-5 py-3 rounded-xl text-sm font-semibold reset-btn"
                           style="min-width: 120px; text-align: center; background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb;">
                            Reset
                        </a>
                    @endif
                </form>

                @if(!empty($berhakLunasSearched) && $berhakLunasSearched)
                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-gray-100" style="background: #ffffff;">
                        <table class="w-full text-sm">
                            <thead style="background: #f8fafc;">
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.no">No</th>
                                    <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.queue">Nomor Porsi</th>
                                    <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.name">Nama</th>
                                    <th class="text-left py-3 px-4 font-semibold">Nama Ayah</th>
                                    <th class="text-left py-3 px-4 font-semibold" data-i18n="data.berhakLunas.table.status">Status</th>
                                    <th class="text-left py-3 px-4 font-semibold">Keterangan</th>
                                    <th class="text-left py-3 px-4 font-semibold">No Paspor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berhakLunasResults as $index => $item)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-3 px-4 text-gray-600">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium text-gray-800">{{ $item->nomor_porsi }}</td>
                                        <td class="py-3 px-4 font-semibold text-gray-900">{{ $item->nama }}</td>
                                        <td class="py-3 px-4 text-gray-600">{{ $item->nama_ayah ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold"
                                                style="background-color: var(--color-primary-bg); color: #111827;">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">{{ $item->keterangan ?? '-' }}</td>
                                        <td class="py-3 px-4 text-gray-600">{{ $item->nomor_paspor ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4 px-4 text-center text-gray-500" colspan="7">
                                            Data tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>

        <!-- Statistik Tab -->
        <div id="tab-statistik" class="tab-panel">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="stat-header">
                    <h2 class="text-2xl font-bold" style="color: #111827;" data-i18n="data.statistik.title">
                        Statistik Haji dan Umrah Kota Cirebon
                    </h2>
                    <form method="GET" action="{{ url('/data-informasi') }}" class="stat-filter">
                        <input type="hidden" name="tab" value="statistik">
                        <select name="tahun" class="stat-filter__select focus-custom" onchange="this.form.submit()">
                            @foreach(($statYearOptions ?? []) as $year)
                                <option value="{{ $year }}" {{ (int) $year === (int) ($statTotals['year_selected'] ?? 0) ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                @if(($statTotals['total'] ?? 0) === 0)
                    <div class="text-center text-gray-500 py-12">
                        Belum ada data statistik. Silakan impor data melalui halaman admin.
                    </div>
                @else
                    <!-- Statistics Cards -->
                    <div class="stat-card-grid mb-6">
                        <div class="stat-card stat-card--primary">
                            <div class="stat-card__icon" aria-hidden="true">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="stat-card__body">
                                <h3 class="stat-card__title">Total Jamaah</h3>
                                <p class="stat-card__value">{{ number_format($statTotals['total']) }}</p>
                            @if($statTotals['latest_year'])
                                    <p class="stat-card__meta">Data terbaru tahun {{ $statTotals['latest_year'] }}</p>
                            @endif
                            </div>
                        </div>
                        <div class="stat-card stat-card--secondary">
                            <div class="stat-card__icon" aria-hidden="true">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div class="stat-card__body">
                                <h3 class="stat-card__title">Jamaah Berangkat per Tahun</h3>
                                <p class="stat-card__value">{{ number_format($statTotals['total_departed']) }}</p>
                                <p class="stat-card__meta">Tahun {{ $statTotals['year_selected'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="stat-panel stat-panel--wide">
                            <h3 class="text-sm font-semibold mb-2">Total Jamaah per Tahun</h3>
                            <div class="stat-panel__chart stat-panel__chart--wide">
                                <canvas id="chartPerYear" width="600" height="170"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <div class="stat-panel stat-panel--chart">
                            <h3 class="text-sm font-semibold mb-2">Distribusi Jenis Kelamin</h3>
                            <div class="stat-panel__chart">
                                <canvas id="chartGender" width="360" height="200"></canvas>
                            </div>
                        </div>
                        <div class="stat-panel stat-panel--chart">
                            <h3 class="text-sm font-semibold mb-2">Distribusi Usia</h3>
                            <div class="stat-panel__chart">
                                <canvas id="chartAge" width="360" height="200"></canvas>
                            </div>
                        </div>
                        <div class="stat-panel stat-panel--chart">
                            <h3 class="text-sm font-semibold mb-2">Distribusi Pendidikan</h3>
                            <div class="stat-panel__chart">
                                <canvas id="chartEducation" width="360" height="200"></canvas>
                            </div>
                        </div>
                        <div class="stat-panel stat-panel--chart stat-panel--tall">
                            <h3 class="text-sm font-semibold mb-1">Distribusi Kecamatan</h3>
                            <p class="text-xs text-gray-500 mb-2">Harjamukti, Kejaksan, Lemahwungkuk, Pekalipan, Kesambi, dan Lainnya</p>
                            <div class="stat-panel__chart">
                                <canvas id="chartKecamatan" width="360" height="230"></canvas>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- KBHU Tab -->
        <div id="tab-kbihu" class="tab-panel">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #111827;" data-i18n="data.kbihu.title">
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
                                           style="background-color: var(--color-primary);">
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
                <h2 class="text-2xl font-bold mb-6" style="color: #111827;" data-i18n="data.ppiu.title">
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
                                               style="background-color: var(--color-primary);">
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
    
    /* Footer */
    .footer-custom {
        background-color: var(--color-primary);
    }
    .footer-text {
        color: var(--footer-text) !important;
    }
    .footer-muted {
        color: var(--footer-muted) !important;
    }
    .footer-custom a.footer-muted:hover {
        color: var(--footer-text) !important;
        opacity: 1;
    }
    
    /* Tab Styles */
    .data-tab {
        position: relative;
        color: #6B7280;
        border-bottom: 2px solid transparent;
    }
    
    .data-tab:hover {
        color: var(--color-primary);
    }
    
    .data-tab.active {
        color: var(--color-primary);
        border-bottom-color: var(--color-primary);
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
        background-color: var(--color-primary-bg);
        color: var(--color-primary);
        padding-left: 24px;
    }
    
    /* Active state for dropdown toggle */
    .dropdown-menu:hover .dropdown-toggle,
    .dropdown-menu.active .dropdown-toggle {
        color: var(--color-primary);
    }
    .reset-btn:hover {
        background: #ffffff;
        border-color: var(--color-primary);
        color: var(--color-primary);
        box-shadow: 0 8px 16px rgba(15, 23, 42, 0.08);
        transform: translateY(-1px);
    }

    .stat-card {
        box-shadow: 0 12px 26px rgba(15, 23, 42, 0.12);
    }
    .stat-card-grid {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }
    .stat-filter {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .stat-filter__select {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 15px;
        font-weight: 600;
        background: #ffffff;
        min-width: 110px;
        box-shadow: 0 8px 16px rgba(15, 23, 42, 0.08);
    }
    .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        border-radius: 16px;
        padding: 14px 16px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
        will-change: transform;
    }
    .stat-card:hover,
    .stat-card:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.16);
        filter: saturate(1.04);
    }
    .stat-card:active {
        transform: translateY(0);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.14);
        filter: saturate(1.02);
    }
    @media (hover: none) {
        .stat-card:hover {
            transform: none;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.12);
            filter: none;
        }
    }
    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.12;
        background: radial-gradient(circle at 85% 15%, rgba(255,255,255,0.6), transparent 55%);
        pointer-events: none;
    }
    .stat-card--primary {
        background: linear-gradient(140deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    }
    .stat-card--secondary {
        background: linear-gradient(140deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    }
    .stat-card__icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-card__icon svg {
        width: 26px;
        height: 26px;
        color: #ffffff;
    }
    .stat-card__title {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        opacity: 0.85;
        margin-bottom: 6px;
    }
    .stat-card__value {
        font-size: 26px;
        font-weight: 700;
        line-height: 1.1;
    }
    .stat-card__meta {
        font-size: 12px;
        opacity: 0.8;
        margin-top: 6px;
    }
    @media (max-width: 1024px) {
        .stat-card-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .stat-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    @media (max-width: 640px) {
        .stat-card-grid {
            grid-template-columns: 1fr;
        }
        .stat-card {
            padding: 12px 14px;
        }
        .stat-card__value {
            font-size: 22px;
        }
    }
    .stat-panel {
        background: #ffffff;
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 12px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .stat-panel__chart {
        flex: 1;
        min-height: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-panel--chart {
        min-height: 260px;
    }
    .stat-panel--wide {
        grid-column: span 2;
    }
    .stat-panel__chart--wide {
        height: 220px;
    }
    .stat-panel canvas {
        width: 100%;
        height: 100%;
        display: block;
    }
    .stat-panel--tall canvas {
        height: 100%;
    }
    @media (max-width: 768px) {
        .stat-panel--wide {
            grid-column: span 1;
        }
        .stat-panel {
            padding: 10px;
        }
        .stat-panel__chart--wide {
            height: 180px;
        }
        .stat-panel--chart {
            min-height: 220px;
        }
        .stat-panel__chart {
            height: 180px;
        }
        .stat-panel--tall .stat-panel__chart {
            height: 220px;
        }
        .stat-panel canvas {
            height: 100%;
        }
        .stat-panel--tall canvas {
            height: 100%;
        }
    }
    
    
    
</style>

<script>
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.data-tab');
        const tabPanels = document.querySelectorAll('.tab-panel');

        const urlParams = new URLSearchParams(window.location.search);
        const initialTab = urlParams.get('tab');
        if (initialTab) {
            tabs.forEach(t => t.classList.remove('active'));
            tabPanels.forEach(p => p.classList.remove('active'));
            const targetTabBtn = document.querySelector(`.data-tab[data-tab="${initialTab}"]`);
            const targetPanel = document.getElementById('tab-' + initialTab);
            if (targetTabBtn && targetPanel) {
                targetTabBtn.classList.add('active');
                targetPanel.classList.add('active');
            }
        }
        
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
        });

    });

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statData = @json($statChartData ?? []);
        if (!statData) {
            return;
        }
        const safe = (key) => statData && statData[key] ? statData[key] : { labels: [], data: [] };

        const baseColors = [
            '#ECB176', '#1f2937', '#60a5fa', '#34d399',
            '#f87171', '#fbbf24', '#a78bfa', '#2dd4bf'
        ];

        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            animation: false,
            devicePixelRatio: 1,
            interaction: {
                mode: 'nearest',
                intersect: true,
                axis: 'xy'
            },
            elements: {
                bar: {
                    hoverBackgroundColor: undefined
                }
            },
            events: ['mousemove', 'click', 'touchstart', 'touchmove'],
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    mode: 'nearest',
                    intersect: true,
                    displayColors: false
                }
            },
            scales: {
                x: { ticks: { font: { size: 11 } } },
                y: { ticks: { font: { size: 11 } }, beginAtZero: true }
            }
        };

        const makeBar = (id, labels, data, horizontal = false) => {
            const el = document.getElementById(id);
            if (!el) return;
            new Chart(el, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        data,
                        backgroundColor: baseColors,
                        borderRadius: 6,
                        hoverOffset: 0,
                        hoverBorderWidth: 0,
                    }]
                },
                options: {
                    ...baseOptions,
                    indexAxis: horizontal ? 'y' : 'x',
                }
            });
        };

        const makeLine = (id, labels, data) => {
            const el = document.getElementById(id);
            if (!el) return;
            new Chart(el, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        data,
                        borderColor: '#ECB176',
                        backgroundColor: 'rgba(236, 177, 118, 0.2)',
                        tension: 0.35,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 4,
                    }]
                },
                options: {
                    ...baseOptions,
                    scales: { y: { beginAtZero: true } }
                }
            });
        };

        const makeDoughnut = (id, labels, data) => {
            const el = document.getElementById(id);
            if (!el) return;
            new Chart(el, {
                type: 'doughnut',
                data: {
                    labels,
                    datasets: [{
                        data,
                        backgroundColor: baseColors,
                        borderWidth: 0,
                        hoverOffset: 0,
                        hoverBorderWidth: 0,
                    }]
                },
                options: {
                    ...baseOptions,
                    cutout: '62%'
                }
            });
        };

        const perYear = safe('perYear');
        const gender = safe('gender');
        const age = safe('age');
        const education = safe('education');
        const kecamatan = safe('kecamatan');

        makeBar('chartPerYear', perYear.labels, perYear.data);
        makeDoughnut('chartGender', gender.labels, gender.data);
        makeBar('chartAge', age.labels, age.data);
        makeBar('chartEducation', education.labels, education.data);
        makeBar('chartKecamatan', kecamatan.labels, kecamatan.data, true);
    });
</script>

</body>
</html>

