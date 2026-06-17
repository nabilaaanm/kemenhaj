@extends('admin.layout')

@section('title', 'Lihat Posting')
@section('page-title', 'Lihat Posting')

@section('content')
<div class="card">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
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
                    title: 'Gagal',
                    text: @json(session('error')),
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if (!empty($postingTableError))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: @json($postingTableError),
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
        <div>
            <h3 style="margin: 0;">Daftar Posting</h3>
            <p style="color: #6b7280; margin-top: 6px;">Kelola posting yang tampil di website.</p>
        </div>
        <a href="{{ route('admin.posting.create') }}" style="padding: 10px 14px; background: #ECB176; color: white; border-radius: 8px; text-decoration: none;">
            Tambah Posting
        </a>
    </div>

    @php
        $userRole = session('user.role', 'kontributor');
        $isEditor = in_array($userRole, ['admin', 'editor'], true);
        $pendingContributorCount = $pendingContributorCount ?? 0;

        $sourceDisplayName = function ($post) {
            $name = trim((string) ($post->submitted_by_name ?? ''));
            if ($name === '') {
                return null;
            }

            $genericLabels = ['kontributor', 'editor', 'admin'];
            if (in_array(strtolower($name), $genericLabels, true)) {
                return null;
            }

            return $name;
        };
    @endphp

    <style>
        .posting-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
        }
        .posting-status-badge svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }
        .posting-status-badge.is-active {
            background: #dcfce7;
            color: #166534;
        }
        .posting-status-badge.is-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        .posting-status-badge.is-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        .posting-source-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }
        .posting-source-badge.is-contributor {
            background: #dbeafe;
            color: #1e40af;
        }
        .posting-source-badge.is-editor {
            background: #ede9fe;
            color: #5b21b6;
        }
        .posting-source-badge.is-admin {
            background: #fce7f3;
            color: #9d174d;
        }
        .posting-source-badge svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }
        .posting-source-name {
            font-size: 11px;
            color: #6b7280;
            margin-top: 4px;
        }
        .posting-pending-title-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        .posting-pending-title-badge svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }
    </style>

    @if($isEditor && $pendingContributorCount > 0)
        <div style="margin-bottom: 16px; padding: 14px 16px; border-radius: 12px; border: 1px solid #fcd34d; background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); display: flex; align-items: center; gap: 12px;">
            <svg style="width: 22px; height: 22px; color: #d97706; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <div style="font-weight: 700; color: #92400e;">{{ $pendingContributorCount }} posting dari kontributor menunggu aktivasi</div>
                <div style="font-size: 13px; color: #b45309; margin-top: 2px;">Gunakan switch di kolom status untuk mengaktifkan tanpa perlu membuka halaman edit.</div>
            </div>
        </div>
    @endif

    @if($posts->isEmpty())
        <div style="padding: 14px 16px; border: 1px dashed #d1d5db; border-radius: 10px; color: #6b7280;">
            Belum ada posting.
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="text-align: left; border-bottom: 1px solid #e5e7eb;">
                        <th style="padding: 10px;">Judul</th>
                        <th style="padding: 10px;">Kategori</th>
                        <th style="padding: 10px;">Tanggal</th>
                        <th style="padding: 10px;">Sumber</th>
                        <th style="padding: 10px;">Status</th>
                        @if($isEditor)
                            <th style="padding: 10px; text-align: center;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        @php
                            $fromContributor = $post->submitted_by_role === 'kontributor';
                            $needsReview = $fromContributor && !$post->is_active;
                        @endphp
                        <tr style="border-bottom: 1px solid #f3f4f6; {{ $needsReview ? 'background: #fffbeb;' : '' }}" data-from-contributor="{{ $fromContributor ? '1' : '0' }}" data-needs-review="{{ $needsReview ? '1' : '0' }}">
                            <td style="padding: 10px; min-width: 240px;">
                                <div style="font-weight: 600; color: #111827;">{{ $post->title }}</div>
                                <div style="font-size: 12px; color: #6b7280; margin-top: 2px;">Slug: {{ $post->slug }}</div>
                                @if($needsReview && $isEditor)
                                    <div class="posting-pending-title-badge">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Menunggu Review
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 10px;">{{ $post->category?->name ?? '-' }}</td>
                            <td style="padding: 10px;">{{ $post->published_at?->format('d M Y') ?? $post->created_at?->format('d M Y') ?? '-' }}</td>
                            <td style="padding: 10px; min-width: 140px;">
                                @if($fromContributor)
                                    <span class="posting-source-badge is-contributor">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Kontributor
                                    </span>
                                    @if($sourceDisplayName($post))
                                        <div class="posting-source-name">{{ $sourceDisplayName($post) }}</div>
                                    @endif
                                @elseif($post->submitted_by_role === 'editor')
                                    <span class="posting-source-badge is-editor">Editor</span>
                                @elseif($post->submitted_by_role === 'admin')
                                    <span class="posting-source-badge is-admin">Admin</span>
                                @else
                                    <span style="color: #9ca3af;">-</span>
                                @endif
                            </td>
                            <td style="padding: 10px;">
                                @if($isEditor)
                                    @include('admin.partials.inline-active-switch', [
                                        'postId' => $post->id,
                                        'active' => $post->is_active,
                                        'title' => $post->title,
                                        'id' => 'post_switch_' . $post->id,
                                    ])
                                @else
                                    @if($post->is_active)
                                        <span class="posting-status-badge is-active">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Aktif
                                        </span>
                                    @elseif($fromContributor)
                                        <span class="posting-status-badge is-pending">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Menunggu Review
                                        </span>
                                    @else
                                        <span class="posting-status-badge is-inactive">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Nonaktif
                                        </span>
                                    @endif
                                @endif
                            </td>
                            @if($isEditor)
                                <td style="padding: 10px; text-align: center;">
                                    <div style="display: inline-flex; gap: 8px; align-items: center; flex-wrap: nowrap; justify-content: center;">
                                        <a href="{{ route('admin.posting.edit', $post->id) }}" style="padding: 6px 12px; min-width: 64px; text-align: center; background: #3b82f6; color: white; border-radius: 6px; text-decoration: none; white-space: nowrap;">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.posting.destroy', $post->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Hapus posting ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 6px 12px; min-width: 64px; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; white-space: nowrap;">
                                            Hapus
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div style="margin-top: 20px;">
                {{ $posts->onEachSide(1)->links('pagination.berhak-lunas') }}
            </div>
        @endif
    @endif
</div>

@if($isEditor && $posts->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrf = @json(csrf_token());
    const toggleUrlTemplate = @json(route('admin.posting.toggle-active', ['id' => '__ID__']));

    document.querySelectorAll('.js-posting-active-switch').forEach(function (button) {
        button.addEventListener('click', function () {
            const postId = this.dataset.postId;
            const isActive = this.dataset.active === '1';
            const title = this.dataset.title || 'Posting';
            const actionText = isActive ? 'nonaktifkan' : 'aktifkan';
            const confirmColor = isActive ? '#ef4444' : '#10b981';

            Swal.fire({
                title: isActive ? 'Nonaktifkan posting?' : 'Aktifkan posting?',
                html: '<strong>' + title + '</strong><br><span style="color:#6b7280;font-size:14px;">Posting akan ' + actionText + ' di website publik.</span>',
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

                fetch(toggleUrlTemplate.replace('__ID__', postId), {
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
                            throw new Error(data.message || 'Gagal mengubah status posting.');
                        }
                        return data;
                    });
                })
                .then(function (data) {
                    const nextActive = data.is_active ? '1' : '0';
                    button.dataset.active = nextActive;
                    button.classList.toggle('is-on', data.is_active);
                    button.setAttribute('aria-pressed', data.is_active ? 'true' : 'false');
                    button.setAttribute('aria-label', data.is_active ? 'Nonaktifkan posting' : 'Aktifkan posting');
                    button.querySelector('.inline-active-switch-label').textContent = data.is_active ? 'Aktif' : 'Nonaktif';

                    const row = button.closest('tr');
                    if (row) {
                        const fromContributor = row.dataset.fromContributor === '1';
                        row.style.background = (!data.is_active && fromContributor) ? '#fffbeb' : '';
                        row.dataset.needsReview = (!data.is_active && fromContributor) ? '1' : '0';
                        const reviewBadge = row.querySelector('.posting-pending-title-badge');
                        if (reviewBadge) {
                            reviewBadge.style.display = (!data.is_active && fromContributor) ? 'inline-flex' : 'none';
                        }
                    }

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
@endif
@endsection
