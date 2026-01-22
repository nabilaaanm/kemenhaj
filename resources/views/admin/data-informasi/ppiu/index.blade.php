@extends('admin.layout')

@section('title', 'Daftar PPIU')
@section('page-title', 'Daftar PPIU')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-bottom: 24px;">
        <button type="button" id="ppiuImportButton"
                style="padding: 10px 20px; background-color: #f3f4f6; color: #374151; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; cursor: pointer;">
            <svg style="width: 18px; height: 18px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v12m0 0l3.5-3.5M12 16l-3.5-3.5M4 20h16"/>
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
                            <td style="padding: 12px; color: #374151;">{{ $index + 1 }}</td>
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
                                    <a href="{{ route('admin.data-informasi.ppiu.edit', $item->id) }}" 
                                       style="padding: 6px 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.data-informasi.ppiu.destroy', $item->id) }}" method="POST" 
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

<div id="ppiuImportModal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); display: none; align-items: center; justify-content: center; padding: 16px; z-index: 60;">
    <div style="background: white; width: 100%; max-width: 520px; border-radius: 14px; padding: 20px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: #111827;">Import Data PPIU</h3>
            <button type="button" id="ppiuImportClose" style="border: none; background: transparent; font-size: 20px; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        <p style="margin: 0 0 16px; color: #6b7280; font-size: 14px;">
            Unggah file Excel (.xlsx/.xls/.csv) untuk menambahkan data secara massal.
        </p>
        <form action="{{ route('admin.data-informasi.ppiu.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">File Excel</label>
            <input type="file" name="file" accept=".xlsx,.xls,.csv"
                   style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
            <div style="margin-top: 8px; font-size: 12px; color: #9ca3af;">
                Kolom yang dibaca: Nama, Direktur, Alamat Cabang, No Telp, Terakreditasi, Latitude, Longitude, Maps Url.
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px;">
                <button type="button" id="ppiuImportCancel"
                        style="padding: 10px 16px; border: 1px solid #e5e7eb; background: #f9fafb; border-radius: 8px; cursor: pointer;">
                    Batal
                </button>
                <button type="submit"
                        style="padding: 10px 18px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Upload & Import
                </button>
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
