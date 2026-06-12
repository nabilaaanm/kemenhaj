@extends('admin.layout')

@section('title', 'Lihat Halaman')
@section('page-title', 'Lihat Halaman')

@section('content')
<div class="card">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ addslashes(session('success')) }}',
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
                    text: '{{ addslashes(session('error')) }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    <div style="display:flex; justify-content: space-between; align-items:center; margin-bottom: 16px;">
        <p style="color: #6b7280;">Daftar semua halaman custom.</p>
        <a href="{{ route('admin.halaman.create') }}" style="padding: 8px 14px; background-color: #ECB176; color: white; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none;">
            + Tambah Halaman
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:10px;">Judul</th>
                    <th style="padding:10px;">Slug</th>
                    <th style="padding:10px;">Menu</th>
                    <th style="padding:10px;">Status</th>
                    <th style="padding:10px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:10px;">{{ $page->title }}</td>
                        <td style="padding:10px;">{{ $page->slug }}</td>
                        <td style="padding:10px;">{{ ucfirst($page->group) }}</td>
                        <td style="padding:10px;">
                            <span style="display:inline-flex; align-items:center; justify-content:center; padding:4px 10px; border-radius:999px; font-size:12px; font-weight:600; color: {{ $page->is_active ? '#065f46' : '#991b1b' }}; background-color: {{ $page->is_active ? '#dcfce7' : '#fee2e2' }}; border: 1px solid {{ $page->is_active ? '#86efac' : '#fca5a5' }};">
                                {{ $page->is_active ? 'Aktif' : 'Non Aktif' }}
                            </span>
                        </td>
                        <td style="padding:10px; display:flex; gap:8px;">
                            <a href="{{ route('admin.halaman.edit', $page->slug) }}" style="padding:6px 10px; background:#3b82f6; color:white; border-radius:6px; font-size:12px; text-decoration: none;">Edit</a>
                            <form action="{{ route('admin.halaman.destroy', $page->slug) }}" method="POST" onsubmit="return confirm('Hapus halaman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding:6px 10px; background:#ef4444; color:white; border:none; border-radius:6px; font-size:12px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:16px; color:#6b7280;">Belum ada halaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pages->hasPages())
        <div style="margin-top: 20px;">
            {{ $pages->onEachSide(1)->links('pagination.berhak-lunas') }}
        </div>
    @endif
</div>
@endsection
