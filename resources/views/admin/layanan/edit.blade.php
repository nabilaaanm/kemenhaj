@extends('admin.layout')

@section('title', 'Edit Layanan')
@section('page-title', 'Edit Layanan')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.layanan.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Layanan
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Edit Layanan</h3>

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

    <form action="{{ route('admin.layanan.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Layanan <span style="color: #ef4444;">*</span></label>
            <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: SISKOPATUH">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical;"
                      placeholder="Deskripsi layanan (opsional)">{{ old('description', $service->description) }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">URL Layanan <span style="color: #ef4444;">*</span></label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Masukkan link aplikasi layanan (akan dibuka di tab baru)</p>
            <input type="url" name="url" value="{{ old('url', $service->url) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="https://siskopatuh.haji.go.id/web/">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Icon Layanan</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Format: JPEG, JPG, PNG (Maksimal 2MB). Jika tidak diisi, akan menggunakan logo default.</p>
            @if($service->icon)
                <div style="margin-bottom: 12px;">
                    <p style="color: #6b7280; font-size: 12px; margin-bottom: 8px;">Icon saat ini:</p>
                    <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}" 
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db;"
                         onerror="this.onerror=null; this.src='{{ asset('image/lambang.png') }}';">
                </div>
            @endif
            <input type="file" name="icon" accept="image/jpeg,image/jpg,image/png"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;"
                   onchange="previewIcon(this)">
            <div id="iconPreview" style="margin-top: 16px; display: none;">
                <img id="previewIconImg" src="" alt="Preview" style="max-width: 100px; max-height: 100px; border-radius: 8px; border: 1px solid #d1d5db;">
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Urutan</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Urutan tampilan (angka lebih kecil akan muncul lebih dulu)</p>
            <input type="number" name="order" value="{{ old('order', $service->order) }}" min="0"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="0">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background-color 0.2s;">
                Perbarui Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function previewIcon(input) {
        const preview = document.getElementById('iconPreview');
        const previewImg = document.getElementById('previewIconImg');
        
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
