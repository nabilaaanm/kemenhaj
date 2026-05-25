@extends('admin.layout')

@section('title', 'Daftar PPIU')
@section('page-title', 'Daftar PPIU')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-bottom: 24px;">
        <button type="button" id="ppiuImportButton"
                style="padding: 10px 20px; background-color: #f3f4f6; color: #374151; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; cursor: pointer;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Import Excel
        </button>
        <a href="{{ route('admin.data-informasi.ppiu.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Data
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
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
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if ($data->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama PPIU</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Direktur</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Alamat Cabang</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No Telp</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Terakreditasi</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Maps URL</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; color: #374151;">{{ ($data->firstItem() ?? 0) + $index }}</td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600;">{{ $item->nama }}</div>
                            </td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->direktur ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->alamat }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->no_telp ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->terakreditasi ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280; max-width: 220px; word-wrap: break-word;">
                                @php
                                    $mapsUrl = $item->maps_url;
                                    if (!$mapsUrl && $item->latitude !== null && $item->longitude !== null) {
                                        $mapsUrl = 'https://www.google.com/maps?q=' . $item->latitude . ',' . $item->longitude;
                                    }
                                @endphp
                                {{ $mapsUrl ?: '-' }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.data-informasi.ppiu.edit', $item->no_izin) }}" 
                                       style="padding: 6px 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.data-informasi.ppiu.destroy', $item->no_izin) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 16px;">
            {{ $data->onEachSide(1)->links('pagination.berhak-lunas') }}
        </div>
    @else
        <div style="text-align: center; padding: 48px; color: #6b7280;">
            <svg style="width: 64px; height: 64px; margin: 0 auto 16px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada data</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan data pertama Anda</p>
            <a href="{{ route('admin.data-informasi.ppiu.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Data
            </a>
        </div>
    @endif
</div>

<div id="ppiuImportModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); z-index: 9999; align-items: center; justify-content: center; padding: 24px;">
    <div style="background: #fff; width: 100%; max-width: 520px; border-radius: 16px; padding: 24px; position: relative; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);">
        <button type="button" id="ppiuImportClose" style="position: absolute; top: 14px; right: 14px; background: transparent; border: none; font-size: 18px; cursor: pointer;">✕</button>
        <h3 style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Import Data PPIU</h3>
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 16px;">
            Unggah file .xls, .xlsx, atau .csv. Kolom yang didukung: Nama, Direktur, Alamat Cabang, No Telp, Terakreditasi, Latitude, Longitude, Maps Url.
        </p>
        <a href="{{ route('admin.data-informasi.ppiu.template') }}"
           style="display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #7c2d12; text-decoration: none; margin-bottom: 16px; padding: 8px 12px; border-radius: 999px; background: #fff7ed; border: 1px solid #fed7aa; box-shadow: 0 6px 14px rgba(15, 23, 42, 0.08); transition: transform 0.2s ease, box-shadow 0.2s ease;">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Download Template Excel
        </a>
        <form action="{{ route('admin.data-informasi.ppiu.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                   style="width: 100%; padding: 12px; border: 1px dashed #cbd5f5; border-radius: 10px; background: #f8fafc; margin-bottom: 16px;">
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" id="ppiuImportCancel" style="padding: 8px 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f3f4f6; color: #374151; font-weight: 600; cursor: pointer;">Import</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openBtn = document.getElementById('ppiuImportButton');
        const modal = document.getElementById('ppiuImportModal');
        const closeBtn = document.getElementById('ppiuImportClose');
        const cancelBtn = document.getElementById('ppiuImportCancel');

        const closeModal = () => {
            modal.style.display = 'none';
        };

        openBtn?.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
        closeBtn?.addEventListener('click', closeModal);
        cancelBtn?.addEventListener('click', closeModal);
        modal?.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endsection
