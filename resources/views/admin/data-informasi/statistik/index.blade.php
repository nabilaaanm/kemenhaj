@extends('admin.layout')

@section('title', 'Statistik Haji')
@section('page-title', 'Statistik Haji')

@section('content')
    <!-- SweetAlert2 -->
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

    <div class="card">
        <h3>Import Data Statistik</h3>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 18px;">
            Unggah file Excel (xlsx/xls/csv) berisi data jamaah. Setelah import, statistik di halaman publik akan otomatis diperbarui.
        </p>

        <div style="display: flex; gap: 16px; margin-bottom: 18px; flex-wrap: wrap;">
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 16px; border-radius: 10px;">
                <div style="font-size: 12px; color: #6b7280;">Total Data</div>
                <div style="font-size: 20px; font-weight: 700; color: #111827;">{{ number_format($total) }}</div>
            </div>
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 16px; border-radius: 10px;">
                <div style="font-size: 12px; color: #6b7280;">Pembaruan Terakhir</div>
                <div style="font-size: 14px; font-weight: 600; color: #111827;">
                    {{ $lastUpdated ? $lastUpdated->format('d M Y, H:i') : '-' }}
                </div>
            </div>
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 16px; border-radius: 10px; min-width: 160px;">
                <div style="font-size: 12px; color: #6b7280;">Tahun Tersimpan</div>
                <div style="font-size: 14px; font-weight: 600; color: #111827;">
                    @if(($tahunTersedia ?? collect())->isNotEmpty())
                        {{ $tahunTersedia->implode(', ') }}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <a href="{{ route('admin.data-informasi.statistik.template') }}"
               style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; background: #f3f4f6; color: #374151; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; border: 1px solid #e5e7eb;">
                Download Template Excel
            </a>
        </div>

        <form action="{{ route('admin.data-informasi.statistik.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">File Excel</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>
            <button type="submit"
                    style="padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                Import Statistik
            </button>
        </form>

        <hr style="margin: 24px 0; border: none; border-top: 1px solid #e5e7eb;">

        <h3 style="margin-bottom: 12px;">Perbarui Data Tahun</h3>
        <p style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">
            Unggah file untuk mengganti data pada tahun tertentu. Semua baris akan disimpan ke tahun yang dipilih.
        </p>
        <form action="{{ route('admin.data-informasi.statistik.import') }}" method="POST" enctype="multipart/form-data" style="display: grid; gap: 12px; max-width: 520px;">
            @csrf
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Pilih Tahun</label>
                <select name="force_year" required
                        style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    @foreach(($tahunTersedia ?? collect()) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">File Excel</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>
            <button type="submit"
                    style="padding: 10px 16px; background-color: #111827; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer;">
                Perbarui Tahun
            </button>
        </form>

        <h3 style="margin: 24px 0 12px;">Hapus Data Tahun</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            @foreach(($tahunTersedia ?? collect()) as $year)
                <form action="{{ route('admin.data-informasi.statistik.delete-year') }}" method="POST" onsubmit="return confirm('Hapus semua data tahun {{ $year }}?')">
                    @csrf
                    <input type="hidden" name="tahun" value="{{ $year }}">
                    <button type="submit"
                            style="padding: 8px 12px; background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; border-radius: 999px; font-weight: 600; font-size: 12px; cursor: pointer;">
                        Hapus {{ $year }}
                    </button>
                </form>
            @endforeach
        </div>

        <div style="margin-top: 20px; font-size: 13px; color: #6b7280;">
            Kolom yang dikenali: Nomor Porsi, Nama Calon Haji, Pendidikan, KBIHU, Alamat, Kelurahan, Kecamatan, Usia,
            Jenis Kelamin, Tahun Keberangkatan.
        </div>
    </div>
@endsection
