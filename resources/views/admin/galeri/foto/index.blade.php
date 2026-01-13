@extends('admin.layout')

@section('title', 'Daftar Foto')
@section('page-title', 'Daftar Foto')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h3>Daftar Foto Galeri</h3>
        <a href="{{ route('admin.galeri.foto.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Foto
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

    @if ($fotos->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Foto</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Judul</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Kategori</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Tanggal</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fotos as $foto)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;">
                                @if($foto->file_path)
                                    @php
                                        $fileExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($foto->file_path);
                                        $imageUrl = $fileExists ? asset('storage/' . $foto->file_path) : 'https://via.placeholder.com/80x80/ECB176/FFFFFF?text=File+Missing';
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $foto->title }}" 
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/80x80/ECB176/FFFFFF?text=Error'; this.style.border='1px solid #e5e7eb';">
                                @elseif($foto->url)
                                    <img src="{{ $foto->url }}" alt="{{ $foto->title }}" 
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/80x80/ECB176/FFFFFF?text=URL+Error'; this.style.border='1px solid #e5e7eb';">
                                @else
                                    <div style="width: 80px; height: 80px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <span style="font-size: 10px; color: #9ca3af;">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600; margin-bottom: 4px;">{{ $foto->title }}</div>
                                @if($foto->description)
                                    <div style="font-size: 12px; color: #6b7280;">{{ Str::limit($foto->description, 50) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280;">
                                @if($foto->category)
                                    <span style="padding: 4px 12px; background-color: #fef3e2; color: #ECB176; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        {{ ucfirst($foto->category) }}
                                    </span>
                                @else
                                    <span style="color: #9ca3af;">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $foto->created_at->format('d/m/Y') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <form action="{{ route('admin.galeri.foto.destroy', $foto->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');" style="display: inline;">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada foto</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan foto pertama Anda</p>
            <a href="{{ route('admin.galeri.foto.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Foto
            </a>
        </div>
    @endif
</div>
@endsection
