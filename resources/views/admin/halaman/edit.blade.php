@extends('admin.layout')

@section('title', 'Edit Halaman')
@section('page-title', 'Edit Halaman')

@section('content')
<div class="card">
    <h3>Edit Halaman</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Perbarui data halaman.</p>

    <form method="POST" action="{{ route('admin.halaman.edit', $page->slug) }}" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Judul</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Slug (opsional)</label>
                <input type="text" name="slug" value="{{ old('slug', $page->slug) }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Posisi Menu</label>
                <select name="group" required
                        style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
                    <option value="header" {{ old('group', $page->group) === 'header' ? 'selected' : '' }}>Header (menu utama)</option>
                    <option value="profil" {{ old('group', $page->group) === 'profil' ? 'selected' : '' }}>Submenu Profil</option>
                    <option value="berita" {{ old('group', $page->group) === 'berita' ? 'selected' : '' }}>Submenu Berita</option>
                    <option value="galeri" {{ old('group', $page->group) === 'galeri' ? 'selected' : '' }}>Submenu Galeri</option>
                    <option value="layanan" {{ old('group', $page->group) === 'layanan' ? 'selected' : '' }}>Submenu Layanan</option>
                    <option value="data-informasi" {{ old('group', $page->group) === 'data-informasi' ? 'selected' : '' }}>Submenu Data & Informasi</option>
                    <option value="lk-pih" {{ old('group', $page->group) === 'lk-pih' ? 'selected' : '' }}>Submenu LK & PIH</option>
                    <option value="regulasi" {{ old('group', $page->group) === 'regulasi' ? 'selected' : '' }}>Submenu Regulasi</option>
                </select>
                <p style="color: #6b7280; font-size: 12px; margin-top: 6px;">Jika posisi menu diubah, halaman dipindahkan ke bagian bawah submenu baru.</p>
            </div>
            <div style="padding-top: 8px;">
                @include('admin.partials.active-toggle', [
                    'checked' => old('is_active', $page->is_active),
                    'label' => 'Aktif',
                    'description' => 'Halaman ditampilkan di menu website',
                ])
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Gambar Sampul</label>
            @if($page->cover_url)
                <div style="margin-bottom: 8px;">
                    <img src="{{ $page->cover_url }}" alt="{{ $page->title }}" style="max-width: 240px; border-radius: 8px; border: 1px solid #e5e7eb;">
                </div>
            @endif
            <input type="file" name="cover_image" accept="image/*"
                   style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Deskripsi</label>
            <textarea name="description" rows="3"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{{ old('description', $page->description) }}</textarea>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Konten (detail)</label>
            <p style="font-size: 12px; color: #6b7280; margin: 0 0 8px;">Gunakan toolbar untuk menambah gambar, link, dan mengatur perataan teks. Gambar diunggah ke server agar konten tidak hilang saat disimpan.</p>
            <textarea name="content" rows="8" class="js-rich-content"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{!! old('content', $page->content) !!}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Kontributor</label>
                <input type="text" name="contributor" value="{{ old('contributor', $page->contributor) }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Editor</label>
                <input type="text" name="editor" value="{{ old('editor', $page->editor) }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Sumber</label>
                <input type="text" name="source" value="{{ old('source', $page->source) }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:8px;">Fotografer</label>
                <input type="text" name="photographer" value="{{ old('photographer', $page->photographer) }}"
                       style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-weight:600; margin-bottom:8px;">Lainnya</label>
            <textarea name="other_info" rows="3"
                      style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">{{ old('other_info', $page->other_info) }}</textarea>
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600;">
            Simpan
        </button>
    </form>
</div>
@include('admin.posting._tinymce', ['tinymceUploadUrl' => route('admin.halaman.upload-editor-image')])
@endsection
