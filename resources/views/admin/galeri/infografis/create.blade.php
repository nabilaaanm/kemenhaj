@extends('admin.layout')

@section('title', 'Tambah Infografis')
@section('page-title', 'Tambah Infografis')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.galeri.infografis.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Infografis
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Tambah Infografis ke Galeri</h3>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: '<ul style="text-align: left; margin: 0; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    showConfirmButton: true
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
                    showConfirmButton: true
                });
            });
        </script>
    @endif

    <form action="{{ route('admin.galeri.infografis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul Infografis <span style="color: #ef4444;">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: Panduan Ibadah Haji">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical;"
                      placeholder="Deskripsi infografis (opsional)">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kategori</label>
            <select name="category"
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
                <option value="">Pilih Kategori</option>
                <option value="haji" {{ old('category') == 'haji' ? 'selected' : '' }}>Haji</option>
                <option value="umrah" {{ old('category') == 'umrah' ? 'selected' : '' }}>Umrah</option>
                <option value="informasi" {{ old('category') == 'informasi' ? 'selected' : '' }}>Informasi</option>
            </select>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Upload File Infografis</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Format: JPEG, JPG, PNG (Maksimal 10MB)</p>
            <input type="file" name="file" accept="image/jpeg,image/jpg,image/png"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;"
                   onchange="previewImage(this)">
            <div id="imagePreview" style="margin-top: 16px; display: none;">
                <img id="previewImg" src="" alt="Preview" style="max-width: 100%; max-height: 400px; border-radius: 8px; border: 1px solid #d1d5db;">
            </div>
        </div>

        <div style="margin-bottom: 24px; padding: 16px; background-color: #f9fafb; border-radius: 8px; text-align: center;">
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">ATAU</p>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Masukkan URL Infografis</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Masukkan link gambar infografis dari internet</p>
            <input type="url" name="url" value="{{ old('url') }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="https://example.com/infografis.png">
            <div id="urlPreview" style="margin-top: 16px; display: none;">
                <img id="urlPreviewImg" src="" alt="Preview" style="max-width: 100%; max-height: 400px; border-radius: 8px; border: 1px solid #d1d5db;"
                     onerror="this.style.display='none'; document.getElementById('urlPreview').style.display='none';">
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background-color 0.2s;">
                Simpan Infografis
            </button>
            <a href="{{ route('admin.galeri.infografis.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
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

    // Preview URL image
    document.querySelector('input[name="url"]').addEventListener('input', function() {
        const url = this.value;
        const urlPreview = document.getElementById('urlPreview');
        const urlPreviewImg = document.getElementById('urlPreviewImg');
        
        if (url && url.startsWith('http')) {
            urlPreviewImg.src = url;
            urlPreview.style.display = 'block';
        } else {
            urlPreview.style.display = 'none';
        }
    });
</script>
@endsection
