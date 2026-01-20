@extends('admin.layout')

@section('title', 'Kategori Galeri')
@section('page-title', 'Kategori Galeri')

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

    <h3>Kategori Galeri</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Kelola kategori untuk Foto, Video, dan Infografis.</p>

    <div style="display: grid; gap: 24px; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); align-items: start;">
        <div style="min-width: 0;">
            <h4 style="margin-bottom: 12px; font-weight: 600;">Kategori Foto</h4>
            <form method="POST" action="{{ route('admin.galeri.kategori.store') }}" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px;">
                @csrf
                <input type="hidden" name="type" value="foto">
                <input type="text" name="name" placeholder="Nama kategori foto" style="flex: 1 1 240px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
                <button type="submit" style="padding: 10px 16px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
                    Tambah
                </button>
            </form>
            @if(empty($fotoCategories))
                <div style="padding: 12px 14px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">Belum ada kategori.</div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 10px;">Nama</th>
                                <th style="padding: 10px; text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fotoCategories as $category)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 10px;">{{ $category->name }}</td>
                                    <td style="padding: 10px; text-align: right;">
                                        <form action="{{ route('admin.galeri.kategori.destroy', $category->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 10px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div style="min-width: 0;">
            <h4 style="margin-bottom: 12px; font-weight: 600;">Kategori Video</h4>
            <form method="POST" action="{{ route('admin.galeri.kategori.store') }}" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px;">
                @csrf
                <input type="hidden" name="type" value="video">
                <input type="text" name="name" placeholder="Nama kategori video" style="flex: 1 1 240px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
                <button type="submit" style="padding: 10px 16px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
                    Tambah
                </button>
            </form>
            @if(empty($videoCategories))
                <div style="padding: 12px 14px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">Belum ada kategori.</div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 10px;">Nama</th>
                                <th style="padding: 10px; text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videoCategories as $category)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 10px;">{{ $category->name }}</td>
                                    <td style="padding: 10px; text-align: right;">
                                        <form action="{{ route('admin.galeri.kategori.destroy', $category->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 10px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div style="min-width: 0;">
            <h4 style="margin-bottom: 12px; font-weight: 600;">Kategori Infografis</h4>
            <form method="POST" action="{{ route('admin.galeri.kategori.store') }}" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px;">
                @csrf
                <input type="hidden" name="type" value="infografis">
                <input type="text" name="name" placeholder="Nama kategori infografis" style="flex: 1 1 240px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
                <button type="submit" style="padding: 10px 16px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
                    Tambah
                </button>
            </form>
            @if(empty($infografisCategories))
                <div style="padding: 12px 14px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">Belum ada kategori.</div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                        <thead>
                            <tr style="text-align: left; border-bottom: 1px solid #e5e7eb;">
                                <th style="padding: 10px;">Nama</th>
                                <th style="padding: 10px; text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($infografisCategories as $category)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 10px;">{{ $category->name }}</td>
                                    <td style="padding: 10px; text-align: right;">
                                        <form action="{{ route('admin.galeri.kategori.destroy', $category->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 6px 10px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
