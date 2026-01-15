@extends('admin.layout')

@section('title', 'Daftar Layanan')
@section('page-title', 'Daftar Layanan')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 24px;">
        <a href="{{ route('admin.layanan.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Layanan
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

    @if ($services->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Icon</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Deskripsi</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">URL</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Urutan</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;">
                                @if($service->icon)
                                    @php
                                        $iconUrl = asset('storage/' . $service->icon);
                                    @endphp
                                    <img src="{{ $iconUrl }}" alt="{{ $service->name }}" 
                                         style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px;"
                                         onerror="this.onerror=null; this.src='{{ asset('image/lambang.png') }}';">
                                @else
                                    <div style="width: 64px; height: 64px; background-color: #8B6914; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('image/lambang.png') }}" alt="Logo" style="width: 48px; height: 48px; object-contain;">
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600; margin-bottom: 4px;">{{ $service->name }}</div>
                            </td>
                            <td style="padding: 12px; color: #6b7280;">
                                <div style="font-size: 14px;">{{ Str::limit($service->description ?? '-', 50) }}</div>
                            </td>
                            <td style="padding: 12px; color: #6b7280;">
                                <a href="{{ $service->url }}" target="_blank" rel="noopener noreferrer" 
                                   style="color: #ECB176; text-decoration: none; font-size: 12px; word-break: break-all;">
                                    {{ Str::limit($service->url, 40) }}
                                </a>
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $service->order }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.layanan.edit', $service->id) }}" 
                                       style="padding: 6px 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $service->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');" style="display: inline;">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada layanan</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan layanan pertama Anda</p>
            <a href="{{ route('admin.layanan.create') }}" 
               style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                Tambah Layanan
            </a>
        </div>
    @endif
</div>
@endsection
