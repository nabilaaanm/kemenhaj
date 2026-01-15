@extends('admin.layout')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h3>Kelola Pengguna Sistem</h3>
        <a href="{{ route('admin.pengaturan.pengguna.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    <p style="color: #6b7280; margin-bottom: 24px;">Hanya admin yang dapat menambah, mengedit, dan menghapus pengguna.</p>

    <!-- SweetAlert2 -->
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

    @if ($users->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Email</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Role</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Tanggal Dibuat</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600;">{{ $user->name }}</div>
                            </td>
                            <td style="padding: 12px; color: #374151;">{{ $user->email }}</td>
                            <td style="padding: 12px;">
                                @if($user->role === 'admin')
                                    <span style="padding: 4px 12px; background-color: #fef3c7; color: #92400e; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        Admin
                                    </span>
                                @elseif($user->role === 'editor')
                                    <span style="padding: 4px 12px; background-color: #dbeafe; color: #1e40af; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        Editor
                                    </span>
                                @else
                                    <span style="padding: 4px 12px; background-color:rgb(214, 248, 216); color:rgb(61, 163, 48); border-radius: 12px; font-size: 12px; font-weight: 600;">
                                        Kontributor
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 12px; color: #6b7280; font-size: 14px;">
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.pengaturan.pengguna.edit', $user->id) }}" 
                                       style="padding: 6px 12px; background-color: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>
                                    @if($user->role !== 'admin')
                                        <form action="{{ route('admin.pengaturan.pengguna.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;"
                                                    onclick="event.preventDefault(); Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: 'Pengguna ini akan dihapus secara permanen!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#ECB176',
                                                        cancelButtonColor: '#6b7280',
                                                        confirmButtonText: 'Ya, Hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            this.closest('form').submit();
                                                        }
                                                    });">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 48px; color: #6b7280;">
            <svg style="width: 64px; height: 64px; margin: 0 auto 16px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada pengguna</p>
            <p style="font-size: 14px; color: #9ca3af;">Klik tombol "Tambah Pengguna" untuk menambahkan pengguna baru</p>
        </div>
    @endif
</div>
@endsection
