@extends('admin.layout')

@section('title', 'Statistik Haji')
@section('page-title', 'Statistik Haji')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ addslashes(session('success')) }}',
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ addslashes(session('error')) }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#ECB176'
                });
            });
        </script>
    @endif

    <style>
        .stat-page { display: grid; gap: 20px; }
        .stat-hero {
            background: linear-gradient(135deg, #16213e 0%, #1e3a5f 55%, #234876 100%);
            border-radius: 16px;
            padding: 24px 28px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .stat-hero::after {
            content: '';
            position: absolute;
            right: -30px;
            top: -30px;
            width: 180px;
            height: 180px;
            background: rgba(236, 177, 118, 0.2);
            border-radius: 50%;
        }
        .stat-hero h2 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 6px;
            position: relative;
            z-index: 1;
        }
        .stat-hero p {
            margin: 0;
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            max-width: 520px;
            position: relative;
            z-index: 1;
        }
        .stat-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }
        .stat-metric {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-metric:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(22, 33, 62, 0.08);
        }
        .stat-metric-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 18px;
        }
        .stat-metric-icon.gold { background: #fef3e2; color: #b45309; }
        .stat-metric-icon.blue { background: #eff6ff; color: #1d4ed8; }
        .stat-metric-icon.green { background: #ecfdf5; color: #047857; }
        .stat-metric-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }
        .stat-metric-value {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            line-height: 1.2;
        }
        .stat-metric-sub {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }
        .stat-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        @media (max-width: 900px) {
            .stat-grid-2 { grid-template-columns: 1fr; }
        }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .stat-card h3 {
            font-size: 17px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .stat-card h3 .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ECB176;
        }
        .stat-card-desc {
            color: #6b7280;
            font-size: 13px;
            margin: 0 0 20px;
            line-height: 1.5;
        }
        .stat-export-preview {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }
        .stat-export-preview-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 6px;
        }
        .stat-export-preview-value {
            font-size: 15px;
            font-weight: 700;
            color: #16213e;
        }
        .stat-export-preview-value span {
            color: #ECB176;
        }
        .stat-field label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
            margin-bottom: 8px;
        }
        .stat-field select {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .stat-field select:focus {
            outline: none;
            border-color: #ECB176;
            box-shadow: 0 0 0 3px rgba(236, 177, 118, 0.25);
        }
        .stat-format-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 18px;
        }
        .stat-format-option {
            position: relative;
        }
        .stat-format-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .stat-format-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 14px 10px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            color: #4b5563;
            transition: all 0.2s;
            background: #fafafa;
        }
        .stat-format-option input:checked + label {
            border-color: #16213e;
            background: #16213e;
            color: #fff;
        }
        .stat-format-icon { font-size: 22px; }
        .stat-btn-primary {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #16213e, #1e3a5f);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .stat-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22, 33, 62, 0.25);
        }
        .stat-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #f3f4f6;
            color: #374151;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #e5e7eb;
            transition: background 0.2s;
        }
        .stat-btn-secondary:hover { background: #e5e7eb; }
        .stat-btn-accent {
            padding: 12px 22px;
            background: #ECB176;
            color: #16213e;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
        }
        .stat-btn-dark {
            padding: 10px 16px;
            background: #111827;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }
        .stat-year-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .stat-year-chip {
            padding: 8px 14px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .stat-year-chip:hover { background: #fecaca; }
        .stat-alert {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 14px;
        }
        .stat-file-input {
            width: 100%;
            padding: 12px;
            border: 1px dashed #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background: #fafafa;
        }
        .stat-divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .stat-hint {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 16px;
            line-height: 1.5;
        }
    </style>

    <div class="stat-page">
        <div class="stat-hero">
            <h2>Statistik Haji</h2>
            <p>Kelola, impor, dan ekspor data jamaah haji. Statistik halaman publik diperbarui otomatis setelah import.</p>
        </div>

        <div class="stat-metrics">
            <div class="stat-metric">
                <div class="stat-metric-icon gold">📊</div>
                <div class="stat-metric-label">Total Data</div>
                <div class="stat-metric-value">{{ number_format($total) }}</div>
                <div class="stat-metric-sub">seluruh jamaah tercatat</div>
            </div>
            <div class="stat-metric">
                <div class="stat-metric-icon blue">🕐</div>
                <div class="stat-metric-label">Pembaruan Terakhir</div>
                <div class="stat-metric-value" style="font-size: 15px;">
                    {{ $lastUpdated ? $lastUpdated->format('d M Y') : '-' }}
                </div>
                <div class="stat-metric-sub">{{ $lastUpdated ? $lastUpdated->format('H:i') : 'belum ada data' }}</div>
            </div>
            <div class="stat-metric">
                <div class="stat-metric-icon green">📅</div>
                <div class="stat-metric-label">Rentang Tahun</div>
                <div class="stat-metric-value" style="font-size: 15px;">
                    @if($tahunMin && $tahunMax)
                        @if($tahunMin === $tahunMax)
                            {{ $tahunMin }}
                        @else
                            {{ $tahunMin }} — {{ $tahunMax }}
                        @endif
                    @else
                        -
                    @endif
                </div>
                <div class="stat-metric-sub">
                    @if(($tahunTersedia ?? collect())->isNotEmpty())
                        {{ $tahunTersedia->count() }} tahun tersimpan
                    @else
                        belum ada tahun
                    @endif
                </div>
            </div>
        </div>

        <div class="stat-grid-2">
            <div class="stat-card">
                <h3><span class="dot"></span> Ekspor Data</h3>
                <p class="stat-card-desc">
                    Unduh data dalam Excel, CSV, atau PDF. Jika memilih semua tahun, file akan menampilkan rentang tahun (dari — sampai).
                </p>

                @if ($errors->any())
                    <div class="stat-alert">{{ $errors->first() }}</div>
                @endif

                <div class="stat-export-preview">
                    <div class="stat-export-preview-label">Periode yang akan diekspor</div>
                    <div class="stat-export-preview-value" id="export-periode-preview">
                        @if($tahunMin && $tahunMax)
                            Tahun <span>{{ $tahunMin }}</span> sampai <span>{{ $tahunMax }}</span>
                        @else
                            Belum ada data tahun
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.data-informasi.statistik.export') }}" method="GET">
                    <div class="stat-field" style="margin-bottom: 16px;">
                        <label for="export-tahun">Pilih Tahun</label>
                        <select name="tahun" id="export-tahun" required
                                data-tahun-min="{{ $tahunMin ?? '' }}"
                                data-tahun-max="{{ $tahunMax ?? '' }}">
                            <option value="all">Semua tahun</option>
                            @foreach(($tahunTersedia ?? collect()) as $year)
                                <option value="{{ $year }}">Tahun {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label style="display:block;font-weight:600;font-size:13px;color:#374151;margin-bottom:10px;">Format File</label>
                    <div class="stat-format-grid">
                        <div class="stat-format-option">
                            <input type="radio" name="format" id="fmt-xlsx" value="xlsx" checked>
                            <label for="fmt-xlsx">
                                <span class="stat-format-icon">📗</span>
                                Excel
                            </label>
                        </div>
                        <div class="stat-format-option">
                            <input type="radio" name="format" id="fmt-csv" value="csv">
                            <label for="fmt-csv">
                                <span class="stat-format-icon">📄</span>
                                CSV
                            </label>
                        </div>
                        <div class="stat-format-option">
                            <input type="radio" name="format" id="fmt-pdf" value="pdf">
                            <label for="fmt-pdf">
                                <span class="stat-format-icon">📕</span>
                                PDF
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="stat-btn-accent" style="margin-top: 14px; width: 100%;">
                        Unduh Data <i class="fa-solid fa-download"></i>
                    </button>
                </form>
            </div>

            <div class="stat-card">
                <h3><span class="dot"></span> Import & Template</h3>
                <p class="stat-card-desc">
                    Unggah file Excel berisi data jamaah. Gunakan template agar kolom sesuai format sistem.
                </p>

                <a href="{{ route('admin.data-informasi.statistik.template') }}" class="stat-btn-secondary" style="margin-bottom: 18px;">
                    📥 Download Template Excel
                </a>

                <form action="{{ route('admin.data-informasi.statistik.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="stat-field">
                        <label>File Excel / CSV</label>
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required class="stat-file-input">
                    </div>
                    <button type="submit" class="stat-btn-accent" style="margin-top: 14px; width: 100%;">
                        Import Statistik
                    </button>
                </form>
            </div>
        </div>

        <div class="stat-card">
            <h3><span class="dot"></span> Perbarui Data per Tahun</h3>
            <p class="stat-card-desc">
                Unggah file untuk mengganti seluruh data pada tahun tertentu.
            </p>
            @if(($tahunTersedia ?? collect())->isNotEmpty())
                <form action="{{ route('admin.data-informasi.statistik.import') }}" method="POST" enctype="multipart/form-data"
                      style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: end; max-width: 720px;">
                    @csrf
                    <div class="stat-field" style="margin:0;">
                        <label>Tahun</label>
                        <select name="force_year" required>
                            @foreach($tahunTersedia as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="stat-field" style="margin:0;">
                        <label>File</label>
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required class="stat-file-input">
                    </div>
                    <button type="submit" class="stat-btn-dark">Perbarui</button>
                </form>
            @else
                <p style="color:#9ca3af;font-size:13px;">Import data terlebih dahulu untuk mengaktifkan fitur ini.</p>
            @endif

            @if(($tahunTersedia ?? collect())->isNotEmpty())
                <hr class="stat-divider">
                <h3 style="font-size:15px;margin:0 0 10px;">Hapus Data Tahun</h3>
                <div class="stat-year-chips">
                    @foreach($tahunTersedia as $year)
                        <form action="{{ route('admin.data-informasi.statistik.delete-year') }}" method="POST"
                              onsubmit="return confirm('Hapus semua data tahun {{ $year }}?')" style="display:inline;">
                            @csrf
                            <input type="hidden" name="tahun" value="{{ $year }}">
                            <button type="submit" class="stat-year-chip">Hapus {{ $year }}</button>
                        </form>
                    @endforeach
                </div>
            @endif

            <p class="stat-hint">
                Kolom yang dikenali: Nomor Porsi, Nama Calon Haji, Pendidikan, KBIHU, Alamat, Kelurahan, Kecamatan, Usia, Jenis Kelamin, Tahun Keberangkatan.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('export-tahun');
            const preview = document.getElementById('export-periode-preview');
            if (!select || !preview) return;

            const minYear = select.dataset.tahunMin;
            const maxYear = select.dataset.tahunMax;

            function updatePreview() {
                const val = select.value;
                if (val === 'all') {
                    if (minYear && maxYear) {
                        if (minYear === maxYear) {
                            preview.innerHTML = 'Tahun <span>' + minYear + '</span>';
                        } else {
                            preview.innerHTML = 'Tahun <span>' + minYear + '</span> sampai <span>' + maxYear + '</span>';
                        }
                    } else {
                        preview.textContent = 'Belum ada data tahun';
                    }
                } else {
                    preview.innerHTML = 'Tahun <span>' + val + '</span>';
                }
            }

            select.addEventListener('change', updatePreview);
            updatePreview();
        });
    </script>
@endsection
