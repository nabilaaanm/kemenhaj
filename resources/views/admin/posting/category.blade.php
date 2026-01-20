@extends('admin.layout')

@section('title', 'Kategori Posting')
@section('page-title', 'Kategori Posting')

@section('content')
<div class="card">
    <h3>Kategori Posting</h3>
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

    <p style="color: #6b7280; margin-bottom: 16px;">Kategori ini akan digunakan saat membuat posting.</p>

    <form action="{{ route('admin.posting.category.store') }}" method="POST" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center; margin-bottom: 20px;">
        @csrf
        <input type="text" name="name" placeholder="Nama kategori" value="{{ old('name') }}"
               style="flex: 1 1 240px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
        <button type="submit" style="padding: 10px 16px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer;">
            Tambah Kategori
        </button>
    </form>

    @if(count($categories) === 0)
        <div style="padding: 14px 16px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">
            Belum ada kategori.
        </div>
    @else
        <div style="display: grid; gap: 12px;">
            @foreach($categories as $category)
                <div style="padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px; background: #f9fafb; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                    <div>
                        <strong>{{ $category->name }}</strong>
                        <div style="font-size: 12px; color: #6b7280; margin-top: 6px;">Slug: {{ $category->slug }}</div>
                    </div>
                    <form action="{{ route('admin.posting.category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 6px 10px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer;">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
