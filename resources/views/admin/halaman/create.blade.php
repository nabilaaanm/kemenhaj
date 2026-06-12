@extends('admin.layout')

@section('title', 'Tambah Halaman')
@section('page-title', 'Tambah Halaman')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.halaman.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Halaman
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Periksa Input',
                    text: '{{ $errors->first() }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif
    <h3>Tambah Halaman Baru</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Buat halaman baru untuk ditampilkan di menu header atau submenu.</p>

    <form method="POST" action="{{ route('admin.halaman.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Slug (opsional)</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Posisi Menu</label>
                <select name="group" required
                        style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
                    <option value="header" {{ old('group') === 'header' ? 'selected' : '' }}>Header (menu utama)</option>
                    <option value="profil" {{ old('group') === 'profil' ? 'selected' : '' }}>Submenu Profil</option>
                    <option value="berita" {{ old('group') === 'berita' ? 'selected' : '' }}>Submenu Berita</option>
                    <option value="galeri" {{ old('group') === 'galeri' ? 'selected' : '' }}>Submenu Galeri</option>
                    <option value="layanan" {{ old('group') === 'layanan' ? 'selected' : '' }}>Submenu Layanan</option>
                    <option value="data-informasi" {{ old('group') === 'data-informasi' ? 'selected' : '' }}>Submenu Data & Informasi</option>
                    <option value="lk-pih" {{ old('group') === 'lk-pih' ? 'selected' : '' }}>Submenu LK & PIH</option>
                    <option value="regulasi" {{ old('group') === 'regulasi' ? 'selected' : '' }}>Submenu Regulasi</option>
                </select>
                <p style="color: #6b7280; font-size: 12px; margin-top: 6px;">Halaman baru otomatis ditambahkan di bagian bawah submenu yang dipilih.</p>
            </div>
            <div style="padding-top: 8px;">
                @include('admin.partials.active-toggle', [
                    'checked' => old('is_active', true),
                    'label' => 'Aktif',
                    'description' => 'Halaman ditampilkan di menu website',
                ])
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Gambar Sampul</label>
            <input type="file" name="cover_image" accept="image/*"
                   style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Deskripsi</label>
            <textarea name="description" rows="3"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Konten (detail)</label>
            <p style="font-size: 12px; color: #6b7280; margin: 0 0 8px;">Gunakan toolbar untuk menambah gambar, link, dan mengatur perataan teks. Gambar diunggah ke server agar konten tidak hilang saat disimpan.</p>
            <textarea name="content" rows="8" class="js-rich-content"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{!! old('content') !!}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Kontributor</label>
                <input type="text" name="contributor" value="{{ old('contributor') }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Editor</label>
                <input type="text" name="editor" value="{{ old('editor') }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Sumber</label>
                <input type="text" name="source" value="{{ old('source') }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Fotografer</label>
                <input type="text" name="photographer" value="{{ old('photographer') }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Lainnya</label>
            <textarea name="other_info" rows="3"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{{ old('other_info') }}</textarea>
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600;">
            Simpan
        </button>
    </form>
</div>
@include('admin.posting._tinymce', ['tinymceUploadUrl' => route('admin.halaman.upload-editor-image')])
@endsection
