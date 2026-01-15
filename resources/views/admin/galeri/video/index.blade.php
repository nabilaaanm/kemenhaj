@extends('admin.layout')

@section('title', 'Daftar Video')
@section('page-title', 'Daftar Video')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 24px;">
        <a href="{{ route('admin.galeri.video.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Video
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

    @if ($videos->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Thumbnail</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Judul</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Kategori</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Durasi</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Tanggal</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;">
                                @if($video->url && (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false || strpos($video->url, 'vimeo.com') !== false))
                                    @php
                                        // Generate thumbnail URL untuk YouTube
                                        $thumbnailUrl = '';
                                        if (strpos($video->url, 'youtube.com/watch?v=') !== false || strpos($video->url, 'youtu.be/') !== false) {
                                            $videoId = '';
                                            if (strpos($video->url, 'youtube.com/watch?v=') !== false) {
                                                $parts = parse_url($video->url);
                                                parse_str($parts['query'] ?? '', $query);
                                                $videoId = $query['v'] ?? '';
                                            } elseif (strpos($video->url, 'youtu.be/') !== false) {
                                                $parts = parse_url($video->url);
                                                $videoId = trim($parts['path'] ?? '', '/');
                                            }
                                            if ($videoId) {
                                                $thumbnailUrl = 'https://img.youtube.com/vi/' . $videoId . '/maxresdefault.jpg';
                                            }
                                        }
                                    @endphp
                                    @if($thumbnailUrl)
                                        <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}" 
                                             style="width: 120px; height: 68px; object-fit: cover; border-radius: 8px;"
                                             onerror="this.onerror=null; this.src='https://img.youtube.com/vi/{{ $videoId ?? '' }}/hqdefault.jpg';">
                                    @else
                                        <div style="width: 120px; height: 68px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 32px; height: 32px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                @elseif($video->thumbnail_url)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" 
                                         style="width: 120px; height: 68px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 120px; height: 68px; background-color: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <svg style="width: 32px; height: 32px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600; margin-bottom: 4px;">{{ $video->title }}</div>
                                @if($video->description)
                                    <div style="font-size: 12px; color: #6b7280;">{{ Str::limit($video->description, 50) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280;">
                                @if($video->category)
                                    <span style="padding: 4px 12px; background-color: #fef3e2; color: #ECB176; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        {{ ucfirst($video->category) }}
                                    </span>
                                @else
                                    <span style="color: #9ca3af;">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $video->duration ?? '-' }}
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $video->created_at->format('d/m/Y') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <form action="{{ route('admin.galeri.video.destroy', $video->id) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');" style="display: inline;">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada video</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan video pertama Anda</p>
            <a href="{{ route('admin.galeri.video.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Video
            </a>
        </div>
    @endif
</div>
@endsection
