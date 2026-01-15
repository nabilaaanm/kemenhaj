@extends('admin.layout')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.pengaturan.pengguna') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Manajemen Pengguna
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Edit Pengguna</h3>

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

    <form action="{{ route('admin.pengaturan.pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Lengkap <span style="color: #ef4444;">*</span></label>
            <input type="text" name="name" value="{{ old('name', $pengguna->name) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: John Doe">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Email <span style="color: #ef4444;">*</span></label>
            <input type="email" name="email" value="{{ old('email', $pengguna->email) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="contoh@kemenhaj.go.id">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Password Baru</label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Kosongkan jika tidak ingin mengubah password</p>
            <input type="password" name="password"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Minimal 6 karakter">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Ulangi password baru">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Role <span style="color: #ef4444;">*</span></label>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">Pilih role untuk pengguna</p>
            <select name="role" required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
                <option value="">-- Pilih Role --</option>
                <option value="kontributor" {{ old('role', $pengguna->role) === 'kontributor' ? 'selected' : '' }}>Kontributor</option>
                <option value="editor" {{ old('role', $pengguna->role) === 'editor' ? 'selected' : '' }}>Editor</option>
            </select>
            <div style="margin-top: 8px; padding: 12px; background-color: #f3f4f6; border-radius: 8px; font-size: 13px; color: #6b7280;">
                <strong>Kontributor:</strong> Dapat membuat dan mengelola postingan sendiri<br>
                <strong>Editor:</strong> Dapat membuat, mengedit, dan menghapus semua postingan serta mengelola halaman dan galeri
            </div>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background-color 0.2s;">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.pengaturan.pengguna') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
