@extends('admin.layout')

@section('title', 'Edit Posting')
@section('page-title', 'Edit Posting')

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

    <h3>Edit Posting</h3>

    <form method="POST" action="{{ route('admin.posting.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kategori</label>
                <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Tanggal</label>
                <input type="date" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi Singkat</label>
                <textarea name="excerpt" rows="3" class="js-rich-excerpt"
                          style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">{!! old('excerpt', $post->excerpt) !!}</textarea>
            </div>
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Isi Lengkap</label>
                <textarea name="content" rows="8" class="js-rich-content"
                          style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">{!! old('content', $post->content) !!}</textarea>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Gambar Sampul</label>
                <input type="file" name="cover_image"
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
                @if($post->cover_url)
                    <div style="margin-top: 10px;">
                        <img src="{{ $post->cover_url }}" alt="Sampul" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px;">
                    </div>
                @endif
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $post->location) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Editor</label>
                <input type="text" name="editor_name" value="{{ old('editor_name', $post->editor_name) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kontributor</label>
                <input type="text" name="contributor_name" value="{{ old('contributor_name', $post->contributor_name) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Fotografer</label>
                <input type="text" name="photographer_name" value="{{ old('photographer_name', $post->photographer_name) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Penulis</label>
                <input type="text" name="writer_name" value="{{ old('writer_name', $post->writer_name) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Sumber</label>
                <input type="text" name="source" value="{{ old('source', $post->source) }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="display: flex; align-items: center; gap: 8px; margin-top: 28px;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $post->is_active) ? 'checked' : '' }}>
                <label style="font-weight: 600; color: #374151;">Tampilkan di publik</label>
            </div>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 12px;">
            <button type="submit" style="padding: 12px 18px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.posting.index') }}" style="padding: 12px 18px; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; color: #374151;">
                Kembali
            </a>
        </div>
    </form>
</div>
<script src="https://cdn.tiny.cloud/1/7d9sxbgag2cw1r4ro2xb9fd14o86qhizw4iys2ac1rg5kh7d/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const baseTinyConfig = {
        menubar: 'file edit view insert format tools table help',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help quickbars emoticons',
        toolbar: [
            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify',
            'bullist numlist outdent indent | link image media table | removeformat | preview fullscreen | code'
        ],
        toolbar_mode: 'sliding',
        branding: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }'
    };

    tinymce.init({
        ...baseTinyConfig,
        selector: 'textarea.js-rich-excerpt',
        height: 220
    });

    tinymce.init({
        ...baseTinyConfig,
        selector: 'textarea.js-rich-content',
        height: 420
    });
</script>
@endsection
