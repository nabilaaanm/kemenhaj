@extends('admin.layout')

@section('title', 'Tambah Slide')
@section('page-title', 'Tambah Slide')

@section('content')
<div class="card" style="max-width: 960px;">
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

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: '{{ session('warning') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    <form method="POST" action="{{ route('admin.pengaturan.slideshow.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Urutan</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            @error('title')
                <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="4"
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-family: inherit; resize: vertical;">{{ old('description') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Teks Tombol</label>
                <input type="text" name="button_text" value="{{ old('button_text') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                       placeholder="Contoh: Baca Selengkapnya →">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Link Tombol</label>
                <input type="text" name="button_url" value="{{ old('button_url') }}"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                       placeholder="https://...">
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Gambar Slide</label>
            <input type="file" name="image" accept="image/*" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Ukuran rekomendasi: 1920 x 600 px. Format: JPG/PNG. Maks 4MB.</p>
            @error('image')
                <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: inline-flex; align-items: center; gap: 8px; color: #374151;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Aktif
            </label>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" style="padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Simpan
            </button>
            <a href="{{ route('admin.pengaturan.slideshow') }}" style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
