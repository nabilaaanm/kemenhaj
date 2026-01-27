@extends('admin.layout')

@section('title', 'Lihat Posting')
@section('page-title', 'Lihat Posting')

@section('content')
<div class="card">
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

    @if (!empty($postingTableError))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ $postingTableError }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
        <div>
            <h3 style="margin: 0;">Daftar Posting</h3>
            <p style="color: #6b7280; margin-top: 6px;">Kelola posting yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.posting.create') }}" style="padding: 10px 14px; background: #ECB176; color: white; border-radius: 8px; text-decoration: none;">
            Tambah Posting
        </a>
    </div>

    @php
        $isEditor = in_array(session('user.role', 'kontributor'), ['admin', 'editor']);
    @endphp

    @if($posts->isEmpty())
        <div style="padding: 14px 16px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">
            Belum ada posting.
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="text-align: left; border-bottom: 1px solid #e5e7eb;">
                        <th style="padding: 10px;">Judul</th>
                        <th style="padding: 10px;">Kategori</th>
                        <th style="padding: 10px;">Tanggal</th>
                        <th style="padding: 10px;">Status</th>
                        @if($isEditor)
                            <th style="padding: 10px; text-align: center;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 10px; min-width: 240px;">
                                <div style="font-weight: 600; color: #111827;">{{ $post->title }}</div>
                                <div style="font-size: 12px; color: #6b7280;">Slug: {{ $post->slug }}</div>
                            </td>
                            <td style="padding: 10px;">{{ $post->category?->name ?? '-' }}</td>
                            <td style="padding: 10px;">{{ $post->published_at?->format('d M Y') ?? '-' }}</td>
                            <td style="padding: 10px;">
                                @if($post->is_active)
                                    <span style="padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 999px; font-size: 12px; font-weight: 600;">Aktif</span>
                                @else
                                    <span style="padding: 4px 10px; background: #fee2e2; color: #991b1b; border-radius: 999px; font-size: 12px; font-weight: 600;">Nonaktif</span>
                                @endif
                            </td>
                            @if($isEditor)
                                <td style="padding: 10px; text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; align-items: center; flex-wrap: nowrap; justify-content: center;">
                                        <a href="{{ route('admin.posting.edit', $post->id) }}" style="padding: 6px 12px; min-width: 64px; text-align: center; background: #3b82f6; color: white; border-radius: 6px; text-decoration: none; white-space: nowrap;">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.posting.destroy', $post->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus posting ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 6px 12px; min-width: 64px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; white-space: nowrap;">
                                            Hapus
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
