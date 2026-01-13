@extends('admin.layout')

@section('title', 'Edit Regulasi')
@section('page-title', 'Edit Regulasi')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.regulasi.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Regulasi
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Edit Regulasi: {{ Str::limit($regulation->title, 50) }}</h3>

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

    <form action="{{ route('admin.regulasi.update', $regulation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul Regulasi <span style="color: #ef4444;">*</span></label>
            <input type="text" name="title" value="{{ old('title', $regulation->title) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: Peraturan Presiden (Perpres) Nomor 92 Tahun 2025 tentang Kementerian Haji dan Umrah">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical;"
                      placeholder="Deskripsi regulasi (opsional)">{{ old('description', $regulation->description) }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kategori <span style="color: #ef4444;">*</span></label>
            <select name="category" required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
                <option value="">Pilih Kategori</option>
                <option value="uu" {{ old('category', $regulation->category) == 'uu' ? 'selected' : '' }}>Undang Undang</option>
                <option value="perpres" {{ old('category', $regulation->category) == 'perpres' ? 'selected' : '' }}>Peraturan Presiden</option>
                <option value="lainnya" {{ old('category', $regulation->category) == 'lainnya' ? 'selected' : '' }}>Peraturan Lainnya</option>
            </select>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Tanggal Regulasi <span style="color: #ef4444;">*</span></label>
            <input type="date" name="regulation_date" value="{{ old('regulation_date', $regulation->regulation_date->format('Y-m-d')) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">File PDF</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Format: PDF (Maksimal 10MB). Kosongkan jika tidak ingin mengubah.</p>
            @if($regulation->file_url)
                <div style="margin-bottom: 12px;">
                    <p style="color: #6b7280; font-size: 12px; margin-bottom: 8px;">File saat ini:</p>
                    <a href="{{ $regulation->file_url }}" target="_blank" style="color: #ECB176; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        Lihat PDF Saat Ini
                    </a>
                </div>
            @endif
            <input type="file" name="file" accept="application/pdf"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Urutan</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Urutan tampilan (angka lebih kecil akan muncul lebih dulu)</p>
            <input type="number" name="order" value="{{ old('order', $regulation->order) }}" min="0"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="0">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background-color 0.2s;">
                Perbarui Regulasi
            </button>
            <a href="{{ route('admin.regulasi.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
