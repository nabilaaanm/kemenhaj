@extends('admin.layout')

@section('title', 'Daftar Infografis')
@section('page-title', 'Daftar Infografis')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h3>Daftar Infografis Galeri</h3>
        <a href="{{ route('admin.galeri.infografis.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Infografis
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

    @if ($infografis->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Infografis</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Judul</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Kategori</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Tanggal</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($infografis as $infografisItem)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;">
                                <img src="{{ $infografisItem->image_url }}" alt="{{ $infografisItem->title }}" 
                                     style="width: 100px; height: 120px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600; margin-bottom: 4px;">{{ $infografisItem->title }}</div>
                                @if($infografisItem->description)
                                    <div style="font-size: 12px; color: #6b7280;">{{ Str::limit($infografisItem->description, 50) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280;">
                                @if($infografisItem->category)
                                    <span style="padding: 4px 12px; background-color: #fef3e2; color: #ECB176; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        {{ ucfirst($infografisItem->category) }}
                                    </span>
                                @else
                                    <span style="color: #9ca3af;">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $infografisItem->created_at->format('d/m/Y') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <form action="{{ route('admin.galeri.infografis.destroy', $infografisItem->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus infografis ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                        Hapus
                                    </button>
                                </form>
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
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada infografis</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan infografis pertama Anda</p>
            <a href="{{ route('admin.galeri.infografis.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Infografis
            </a>
        </div>
    @endif
</div>
@endsection
