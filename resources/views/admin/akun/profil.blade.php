@extends('admin.layout')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ addslashes(session('success')) }}',
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if (session('success_password'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ addslashes(session('success_password')) }}',
                    timer: 2500,
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

    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}"
           style="display: inline-flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-weight: 600;">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
        <div class="card">
            <h3>Informasi Akun</h3>
            <form action="{{ route('admin.akun.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Foto Profil</label>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 72px; height: 72px; border-radius: 999px; border: 2px solid #ECB176; overflow: hidden; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            @if($user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <svg style="width: 32px; height: 32px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <input type="file" name="avatar" accept=".jpg,.jpeg,.png,.webp"
                                   style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;">
                            <div style="margin-top: 6px; font-size: 12px; color: #6b7280;">Format JPG, JPEG, PNG, atau WEBP. Maks 2MB.</div>
                            @if($user->avatar)
                                <div style="margin-top: 10px;">
                                    <button type="submit"
                                            formaction="{{ route('admin.akun.avatar.delete') }}"
                                            formmethod="POST"
                                            onclick="return confirm('Hapus foto profil?')"
                                            style="padding: 8px 12px; background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; border-radius: 8px; font-weight: 600; font-size: 12px; cursor: pointer;">
                                        Hapus Foto
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled
                           style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; background: #f9fafb; color: #6b7280;">
                </div>

                <button type="submit"
                        style="width: 100%; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    Simpan Profil
                </button>
            </form>
        </div>

        <div class="card">
            <h3>Ubah Password</h3>
            <form action="{{ route('admin.akun.password') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Password Saat Ini</label>
                    <input type="password" name="current_password" required
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Password Baru</label>
                    <input type="password" name="password" required
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                           style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                </div>

                <button type="submit"
                        style="width: 100%; padding: 12px 24px; background-color: #1f2937; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    Simpan Password
                </button>
            </form>
        </div>
    </div>
@endsection
