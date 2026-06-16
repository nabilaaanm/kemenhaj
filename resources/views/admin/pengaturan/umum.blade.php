@extends('admin.layout')

@section('title', 'Pengaturan Umum')
@section('page-title', 'Pengaturan Umum')

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
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @php
        $currentColor = old('primary_color', $appearance->primary_color ?? '#ECB176');
        $currentMode = old('mode', $appearance->mode ?? 'light');
        $defaultPalette = ['#ECB176', '#0EA5E9', '#22C55E', '#EF4444', '#8B5CF6', '#F59E0B', '#10B981', '#64748B'];
        $palette = array_values(array_unique(array_merge([$currentColor], $defaultPalette)));
    @endphp

    <h3 style="margin-bottom: 8px;">Pengaturan Umum</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Atur identitas instansi, lambang, warna utama, dan mode tampilan website.</p>

    <form method="POST" action="{{ route('admin.pengaturan.umum.update') }}" enctype="multipart/form-data">
        @csrf

        <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Identitas Instansi</h4>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Kementerian</label>
            <input type="text" name="nama_kemenhaj" value="{{ old('nama_kemenhaj', $setting->nama_kemenhaj) }}"
                   class="form-input" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            @error('nama_kemenhaj')
                <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kota</label>
            <input type="text" name="kota" value="{{ old('kota', $setting->kota) }}"
                   class="form-input" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            @error('kota')
                <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 32px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Lambang Kemenhaj</label>
            <div style="margin-bottom: 12px;">
                <img src="{{ $setting->lambang_url }}" alt="Lambang" style="height: 80px; width: auto; border: 1px solid #d1d5db; border-radius: 8px; padding: 8px;">
            </div>
            <input type="file" name="lambang" accept="image/*"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Format: PNG, JPG, maksimal 2MB. Perubahan akan tampil di sidebar admin, header, footer, dan favicon website.</p>
            @error('lambang')
                <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        @if($appearance)
        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 0 0 32px;">

        <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #374151;">Tampilan Website</h4>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Warna Utama</label>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
                @foreach($palette as $color)
                    <button type="button"
                            class="color-swatch"
                            data-color="{{ $color }}"
                            style="width: 36px; height: 36px; border-radius: 999px; border: 2px solid {{ $currentColor === $color ? '#111827' : '#e5e7eb' }}; background: {{ $color }}; cursor: pointer;">
                    </button>
                @endforeach
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <input type="color" id="colorPicker" value="{{ $currentColor }}"
                       style="width: 44px; height: 36px; border: 1px solid #d1d5db; border-radius: 8px; padding: 0;">
                <input type="text" id="colorHex" value="{{ $currentColor }}" readonly
                       style="width: 120px; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;">
            </div>
            <input type="hidden" name="primary_color" id="primaryColorInput" value="{{ $currentColor }}">
            @error('primary_color')
                <div style="color: #dc2626; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 32px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Mode Tampilan</label>
            <div style="display: flex; gap: 16px;">
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="radio" name="mode" value="light" {{ $currentMode === 'light' ? 'checked' : '' }}>
                    <span>Light Mode</span>
                </label>
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="radio" name="mode" value="dark" {{ $currentMode === 'dark' ? 'checked' : '' }}>
                    <span>Dark Mode</span>
                </label>
            </div>
            @error('mode')
                <div style="color: #dc2626; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" style="padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

@if($appearance)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swatches = document.querySelectorAll('.color-swatch');
        const colorPicker = document.getElementById('colorPicker');
        const colorHex = document.getElementById('colorHex');
        const input = document.getElementById('primaryColorInput');

        if (!colorPicker || !colorHex || !input) return;

        const setColor = (color) => {
            input.value = color;
            colorPicker.value = color;
            colorHex.value = color;
            swatches.forEach((btn) => {
                btn.style.borderColor = btn.dataset.color === color ? '#111827' : '#e5e7eb';
            });
        };

        swatches.forEach((btn) => {
            btn.addEventListener('click', () => setColor(btn.dataset.color));
        });

        colorPicker.addEventListener('input', (e) => {
            setColor(e.target.value);
        });
    });
</script>
@endif
@endsection
