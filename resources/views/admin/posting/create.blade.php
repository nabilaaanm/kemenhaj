@extends('admin.layout')

@section('title', 'Tambah Posting')
@section('page-title', 'Tambah Posting')

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

    @if (!empty($tableError))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ $tableError }}',
                    timer: 4000,
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

    <h3>Tambah Posting Baru</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Lengkapi detail posting agar tampil di halaman publik.</p>

    <form method="POST" action="{{ route('admin.posting.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;"
                       placeholder="Judul posting">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kategori</label>
                <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Tanggal</label>
                <input type="date" name="published_at" value="{{ old('published_at') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Isi Lengkap</label>
                <textarea name="content" rows="8" class="js-rich-content"
                          style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;"
                          placeholder="Tulis isi berita lengkap">{!! old('content') !!}</textarea>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Gambar Sampul</label>
                <input type="file" name="cover_image"
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;"
                       placeholder="Contoh: Cirebon">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Editor</label>
                <input type="text" name="editor_name" value="{{ old('editor_name') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kontributor</label>
                <input type="text" name="contributor_name" value="{{ old('contributor_name') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Fotografer</label>
                <input type="text" name="photographer_name" value="{{ old('photographer_name') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Penulis</label>
                <input type="text" name="writer_name" value="{{ old('writer_name') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Sumber</label>
                <input type="text" name="source" value="{{ old('source') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px;"
                       placeholder="Contoh: Humas Kemenhaj">
            </div>
            @if(in_array(session('user.role', 'kontributor'), ['admin', 'editor']))
                <div style="display: flex; align-items: center; gap: 8px; margin-top: 28px;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label style="font-weight: 600; color: #374151;">Tampilkan di publik</label>
                </div>
            @endif
        </div>

        <div style="margin-top: 24px; display: flex; gap: 12px;">
            <button type="submit" style="padding: 12px 18px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
                Simpan Posting
            </button>
            <a href="{{ route('admin.posting.index') }}" style="padding: 12px 18px; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; color: #374151;">
                Batal
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
        selector: 'textarea.js-rich-content',
        height: 420
    });
</script>
@endsection
