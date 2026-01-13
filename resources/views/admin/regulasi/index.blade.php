@extends('admin.layout')

@section('title', 'Daftar Regulasi')
@section('page-title', 'Daftar Regulasi')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h3>Daftar Regulasi</h3>
        <a href="{{ route('admin.regulasi.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Regulasi
        </a>
    </div>

    <!-- SweetAlert2 -->
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
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if ($regulations->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; table-layout: auto;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; min-width: 300px;">Judul</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Kategori</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Tanggal</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">File</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Urutan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Status</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regulations as $regulation)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; color: #374151; max-width: 400px; word-wrap: break-word;">
                                <div style="font-weight: 600; margin-bottom: 4px; line-height: 1.5;">{{ $regulation->title }}</div>
                                @if($regulation->description)
                                    <div style="font-size: 12px; color: #6b7280; margin-top: 4px; line-height: 1.4;">{{ Str::limit($regulation->description, 100) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; white-space: nowrap;">
                                <span style="padding: 4px 12px; background-color: #ECB176; color: #000; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                                    {{ $regulation->badge_text }}
                                </span>
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px; white-space: nowrap;">
                                {{ $regulation->regulation_date->format('d/m/Y') }}
                            </td>
                            <td style="padding: 12px; white-space: nowrap;">
                                @if($regulation->file_url)
                                    <a href="{{ $regulation->file_url }}" target="_blank" style="color: #ECB176; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg style="width: 16px; height: 16px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Lihat PDF</span>
                                    </a>
                                @else
                                    <span style="color: #9ca3af; font-size: 12px;">Tidak ada file</span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px; white-space: nowrap; text-align: center;">
                                {{ $regulation->order }}
                            </td>
                            <td style="padding: 12px; white-space: nowrap;">
                                <span style="padding: 4px 12px; background-color: {{ $regulation->is_active ? '#d1fae5' : '#fee2e2' }}; color: {{ $regulation->is_active ? '#065f46' : '#991b1b' }}; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                                    {{ $regulation->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center; white-space: nowrap;">
                                <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: nowrap;">
                                    <a href="{{ route('admin.regulasi.edit', $regulation->id) }}" 
                                       style="padding: 6px 12px; background-color: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none; white-space: nowrap;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.regulasi.destroy', $regulation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; white-space: nowrap;"
                                                onclick="event.preventDefault(); Swal.fire({
                                                    title: 'Apakah Anda yakin?',
                                                    text: 'Regulasi ini akan dihapus secara permanen!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#ECB176',
                                                    cancelButtonColor: '#6b7280',
                                                    confirmButtonText: 'Ya, Hapus!',
                                                    cancelButtonText: 'Batal'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        this.closest('form').submit();
                                                    }
                                                });">
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
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada regulasi</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan regulasi pertama Anda</p>
            <a href="{{ route('admin.regulasi.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Regulasi
            </a>
        </div>
    @endif
</div>
@endsection
