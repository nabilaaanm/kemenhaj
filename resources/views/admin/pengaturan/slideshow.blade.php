@extends('admin.layout')

@section('title', 'Pengaturan Slideshow')
@section('page-title', 'Pengaturan Slideshow')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 24px;">
        <a href="{{ route('admin.pengaturan.slideshow.create') }}" 
           style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Slide
        </a>
    </div>

    <div style="background: #f8fafc; border: 1px dashed #cbd5f5; color: #4b5563; padding: 10px 12px; border-radius: 8px; font-size: 12px; margin-bottom: 16px;">
        Rekomendasi ukuran gambar slideshow: 1920 x 600 px (rasio lebar). Gambar akan di-crop otomatis agar pas.
    </div>

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
        <div style="background-color: #fef3c7; color: #92400e; padding: 12px; border-radius: 8px; margin-bottom: 24px;">
            {{ session('warning') }}
        </div>
    @endif

    @if($slides->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                        <th style="text-align: left; padding: 12px; font-size: 13px; font-weight: 700; color: #374151;">Gambar</th>
                        <th style="text-align: left; padding: 12px; font-size: 13px; font-weight: 700; color: #374151;">Judul</th>
                        <th style="text-align: left; padding: 12px; font-size: 13px; font-weight: 700; color: #374151;">Badge</th>
                        <th style="text-align: left; padding: 12px; font-size: 13px; font-weight: 700; color: #374151;">Status</th>
                        <th style="text-align: center; padding: 12px; font-size: 13px; font-weight: 700; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $slide)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;">
                                <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" style="width: 120px; height: 70px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb;">
                            </td>
                            <td style="padding: 12px;">
                                <div style="font-weight: 700; color: #374151; margin-bottom: 4px;">{{ $slide->title }}</div>
                                @if($slide->description)
                                    <div style="font-size: 12px; color: #6b7280;">{{ \Illuminate\Support\Str::limit($slide->description, 80) }}</div>
                                @endif
                            </td>
                            <td style="padding: 12px; font-size: 12px; color: #6b7280;">
                                {{ $slide->badge ?? '-' }}
                            </td>
                            <td style="padding: 12px;">
                                @include('admin.partials.inline-active-switch', [
                                    'active' => $slide->is_active,
                                    'title' => $slide->title,
                                    'id' => 'slide_switch_' . md5($slide->title),
                                    'switchClass' => 'js-slideshow-active-switch',
                                    'toggleUrl' => route('admin.pengaturan.slideshow.toggle-active', $slide->title),
                                    'entityLabel' => 'slide',
                                ])
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: inline-flex; gap: 8px; align-items: center; justify-content: center; flex-wrap: nowrap;">
                                <a href="{{ route('admin.pengaturan.slideshow.edit', $slide->title) }}" 
                                   style="padding: 6px 12px; background-color: #3b82f6; color: white; border-radius: 6px; text-decoration: none; font-size: 12px; white-space: nowrap;">
                                    Edit
                                </a>
                                <form action="{{ route('admin.pengaturan.slideshow.destroy', $slide->title) }}" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Hapus slide ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 12px; cursor: pointer; white-space: nowrap;">
                                        Hapus
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($slides->hasPages())
            <div style="margin-top: 20px;">
                {{ $slides->onEachSide(1)->links('pagination.berhak-lunas') }}
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 40px; background: #f9fafb; border: 2px dashed #d1d5db; border-radius: 12px;">
            <p style="color: #6b7280; margin-bottom: 16px;">Belum ada slide</p>
            <a href="{{ route('admin.pengaturan.slideshow.create') }}" 
               style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                Tambah Slide Pertama
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrf = @json(csrf_token());

    document.querySelectorAll('.js-slideshow-active-switch').forEach(function (button) {
        button.addEventListener('click', function () {
            const toggleUrl = this.dataset.toggleUrl;
            const isActive = this.dataset.active === '1';
            const title = this.dataset.title || 'Slide';
            const actionText = isActive ? 'nonaktifkan' : 'aktifkan';
            const confirmColor = isActive ? '#ef4444' : '#10b981';

            Swal.fire({
                title: isActive ? 'Nonaktifkan slide?' : 'Aktifkan slide?',
                html: '<strong>' + title + '</strong><br><span style="color:#6b7280;font-size:14px;">Slide akan ' + actionText + ' di slideshow beranda.</span>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, ' + actionText,
                cancelButtonText: 'Batal',
                confirmButtonColor: confirmColor,
                reverseButtons: true,
            }).then(function (result) {
                if (!result.isConfirmed) {
                    return;
                }

                fetch(toggleUrl, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin',
                })
                .then(function (response) {
                    return response.json().then(function (data) {
                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal mengubah status slide.');
                        }
                        return data;
                    });
                })
                .then(function (data) {
                    const nextActive = data.is_active ? '1' : '0';
                    button.dataset.active = nextActive;
                    button.classList.toggle('is-on', data.is_active);
                    button.setAttribute('aria-pressed', data.is_active ? 'true' : 'false');
                    button.setAttribute('aria-label', data.is_active ? 'Nonaktifkan slide' : 'Aktifkan slide');
                    button.querySelector('.inline-active-switch-label').textContent = data.is_active ? 'Aktif' : 'Nonaktif';

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                    });
                })
                .catch(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.message || 'Terjadi kesalahan.',
                        confirmButtonColor: '#ECB176',
                    });
                });
            });
        });
    });
});
</script>
@endsection
