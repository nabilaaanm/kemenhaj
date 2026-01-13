@extends('admin.layout')

@section('title', 'Tambah Video')
@section('page-title', 'Tambah Video')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.galeri.video.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Video
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Tambah Video ke Galeri</h3>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '<li style="margin-bottom: 8px;">{{ addslashes($error) }}</li>';
                @endforeach
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: '<ul style="text-align: left; margin: 0; padding-left: 20px; list-style-type: disc;">' + errorMessages + '</ul>',
                    showConfirmButton: true,
                    confirmButtonColor: '#ECB176',
                    width: '600px'
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
                    html: '<p style="text-align: left;">{{ addslashes(session('error')) }}</p>',
                    showConfirmButton: true,
                    confirmButtonColor: '#ECB176',
                    width: '600px'
                });
            });
        </script>
    @endif

    <form action="{{ route('admin.galeri.video.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul Video <span style="color: #ef4444;">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: Kegiatan Haji 2024">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical;"
                      placeholder="Deskripsi video (opsional)">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kategori</label>
            <select name="category"
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
                <option value="">Pilih Kategori</option>
                <option value="kegiatan" {{ old('category') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="informasi" {{ old('category') == 'informasi' ? 'selected' : '' }}>Informasi</option>
                <option value="tutorial" {{ old('category') == 'tutorial' ? 'selected' : '' }}>Tutorial</option>
            </select>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Durasi</label>
            <input type="text" name="duration" value="{{ old('duration') }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: 5:30">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Upload File Video</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Format: MP4 (Maksimal {{ ini_get('upload_max_filesize') }})</p>
            <p style="color: #ef4444; font-size: 12px; margin-bottom: 8px; font-style: italic;">⚠️ Catatan: Batas upload saat ini adalah {{ ini_get('upload_max_filesize') }}. Untuk file yang lebih besar, gunakan URL video (YouTube, Vimeo, dll).</p>
            <input type="file" name="file" accept="video/mp4"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Thumbnail Video</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Format: JPEG, JPG, PNG (Maksimal 2MB)</p>
            <input type="file" name="thumbnail" accept="image/jpeg,image/jpg,image/png"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;"
                   onchange="previewThumbnail(this)">
            <div id="thumbnailPreview" style="margin-top: 16px; display: none;">
                <img id="previewThumbnailImg" src="" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 8px; border: 1px solid #d1d5db;">
            </div>
        </div>

        <div style="margin-bottom: 24px; padding: 16px; background-color: #f9fafb; border-radius: 8px; text-align: center;">
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">ATAU</p>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Masukkan URL Video <span style="color: #ef4444;">*</span></label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Masukkan link video dari YouTube, Vimeo, atau platform lainnya. Video akan langsung ditampilkan sebagai embed.</p>
            <p style="color: #10b981; font-size: 12px; margin-bottom: 8px; font-style: italic;">✓ Disarankan: Gunakan URL video untuk menghindari batas upload file.</p>
            <input type="url" name="url" value="{{ old('url') }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="https://www.youtube.com/watch?v=... atau https://vimeo.com/...">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background-color 0.2s;">
                Simpan Video
            </button>
            <a href="{{ route('admin.galeri.video.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function previewThumbnail(input) {
        const preview = document.getElementById('thumbnailPreview');
        const previewImg = document.getElementById('previewThumbnailImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endsection
