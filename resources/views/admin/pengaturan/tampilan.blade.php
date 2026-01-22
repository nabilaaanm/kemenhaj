@extends('admin.layout')

@section('title', 'Pengaturan Tampilan')
@section('page-title', 'Pengaturan Tampilan')

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
        $currentColor = $appearance->primary_color ?? '#ECB176';
        $currentMode = $appearance->mode ?? 'light';
        $defaultPalette = ['#ECB176', '#0EA5E9', '#22C55E', '#EF4444', '#8B5CF6', '#F59E0B', '#10B981', '#64748B'];
        $palette = array_values(array_unique(array_merge([$currentColor], $defaultPalette)));
    @endphp

    <h3 style="margin-bottom: 16px;">Pengaturan Tampilan</h3>
    <p style="color: #6b7280; margin-bottom: 24px;">Atur warna utama dan mode tampilan (light/dark) untuk website.</p>

    <form method="POST" action="{{ route('admin.pengaturan.tampilan.update') }}">
        @csrf

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

        <div style="margin-bottom: 24px;">
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

        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swatches = document.querySelectorAll('.color-swatch');
        const colorPicker = document.getElementById('colorPicker');
        const colorHex = document.getElementById('colorHex');
        const input = document.getElementById('primaryColorInput');

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
@endsection
