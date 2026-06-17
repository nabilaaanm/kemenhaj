@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .greeting-banner {
        background: linear-gradient(135deg, rgba(236, 177, 118, 0.15) 0%, rgba(236, 177, 118, 0.25) 100%);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .greeting-content h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }
    .greeting-content p {
        font-size: 16px;
        color: #6b7280;
        margin: 0;
    }
    .greeting-illustration {
        width: 200px;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .greeting-illustration svg {
        width: 100%;
        height: 100%;
    }
    .overview-section {
        margin-bottom: 32px;
    }
    .overview-title {
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 20px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon svg {
        width: 28px;
        height: 28px;
    }
    .stat-content {
        flex: 1;
    }
    .stat-label {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 4px;
    }
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }
    .stat-card.yellow .stat-icon {
        background: #fef3c7;
    }
    .stat-card.yellow .stat-icon svg {
        color: #f59e0b;
    }
    .stat-card.purple .stat-icon {
        background: #ede9fe;
    }
    .stat-card.purple .stat-icon svg {
        color: #8b5cf6;
    }
    .stat-card.pink .stat-icon {
        background: #fce7f3;
    }
    .stat-card.pink .stat-icon svg {
        color: #ec4899;
    }
    .stat-card.orange .stat-icon {
        background: #fed7aa;
    }
    .stat-card.orange .stat-icon svg {
        color: #ECB176;
    }
    .content-list {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .content-item {
        padding: 20px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: background 0.2s;
    }
    .content-item:last-child {
        border-bottom: none;
    }
    .content-item:hover {
        background: #f9fafb;
    }
    .content-thumbnail {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        background: linear-gradient(135deg, #ECB176 0%, #d4a066 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .content-thumbnail svg {
        width: 40px;
        height: 40px;
        color: white;
    }
    .content-details {
        flex: 1;
        min-width: 0;
    }
    .content-title {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 4px;
    }
    .content-description {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 8px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .content-meta {
        font-size: 12px;
        color: #9ca3af;
    }
    .content-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .toggle-switch {
        position: relative;
        width: 48px;
        height: 24px;
        background: #d1d5db;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .toggle-switch.active {
        background: #ECB176;
    }
    .toggle-switch::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: white;
        top: 2px;
        left: 2px;
        transition: transform 0.3s;
    }
    .toggle-switch.active::after {
        transform: translateX(24px);
    }
    .action-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
    }
    .action-icon:hover {
        background: #f3f4f6;
    }
    .action-icon svg {
        width: 18px;
        height: 18px;
        color: #6b7280;
    }
    .action-icon.delete:hover {
        background: #fee2e2;
    }
    .action-icon.delete:hover svg {
        color: #dc2626;
    }
</style>
@endpush

@section('content')
<!-- Greeting Banner -->
<div class="greeting-banner">
    <div class="greeting-content">
        <h2>Halo, {{ $user['name'] }}!</h2>
        <p>Siap memulai hari dengan mengelola konten Kementerian Haji dan Umrah?</p>
    </div>
    <div class="greeting-illustration">
        <svg viewBox="0 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="20" y="80" width="80" height="50" rx="4" fill="#ECB176"/>
            <rect x="30" y="90" width="60" height="30" rx="2" fill="white"/>
            <circle cx="50" cy="105" r="3" fill="#ECB176"/>
            <circle cx="70" cy="105" r="3" fill="#ECB176"/>
            <path d="M100 100 L120 80 L140 100" stroke="#ECB176" stroke-width="3" fill="none"/>
            <circle cx="150" cy="60" r="20" fill="#fef3c7"/>
            <path d="M140 60 Q150 50 160 60" stroke="#f59e0b" stroke-width="2" fill="none"/>
            <rect x="160" y="100" width="30" height="30" rx="4" fill="#d4a066"/>
        </svg>
    </div>
</div>

<!-- Overview Statistics -->
<div class="overview-section">
    <h3 class="overview-title">Ringkasan</h3>
    <div class="stats-grid">
        <div class="stat-card yellow">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Tingkat Publikasi</div>
                <div class="stat-value">{{ $stats['publication_rate'] ?? 0 }}%</div>
            </div>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Konten Aktif</div>
                <div class="stat-value">{{ number_format($stats['active'] ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="stat-card pink">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Konten</div>
                <div class="stat-value">{{ number_format($stats['total'] ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="stat-card orange">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Total Kunjungan</div>
                <div class="stat-value">{{ number_format($stats['total_views'] ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Content List -->
<div class="content-list">
    @if(($recentItems ?? collect())->isEmpty())
        <div class="content-item" style="justify-content: center; text-align: center;">
            <div class="content-details">
                <div class="content-title">Belum ada konten terbaru</div>
                <div class="content-description">Konten yang baru diposting akan muncul di sini.</div>
            </div>
        </div>
    @else
        @foreach($recentItems as $item)
            <div class="content-item">
                <div class="content-thumbnail" style="overflow: hidden;">
                    @if(!empty($item['image']))
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    @endif
                </div>
                <div class="content-details">
                    <div class="content-title">{{ $item['title'] }}</div>
                    <div class="content-description">{{ $item['description'] ?: '-' }}</div>
                    <div class="content-meta">
                        {{ $item['type'] }} • {{ \Illuminate\Support\Carbon::parse($item['date'])->translatedFormat('d M Y') }}
                    </div>
                </div>
                <div class="content-actions">
                    @if(!empty($item['url']))
                        @if($canEditDashboardItems ?? false)
                            <a href="{{ $item['url'] }}" class="action-icon" title="Buka detail">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        @else
                            <button type="button"
                                    class="action-icon js-dashboard-edit-blocked"
                                    data-title="{{ $item['title'] }}"
                                    title="Edit tidak tersedia"
                                    style="border: none; background: transparent;">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

@if(!($canEditDashboardItems ?? true))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-dashboard-edit-blocked').forEach(function (button) {
        button.addEventListener('click', function () {
            const title = this.dataset.title || 'Konten ini';
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak',
                html: '<strong>' + title + '</strong><br><span style="color:#6b7280;font-size:14px;">Anda tidak memiliki akses untuk mengedit konten ini. Hubungi admin atau editor jika perlu perubahan.</span>',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#ECB176',
            });
        });
    });
});
</script>
@endif
@endsection
