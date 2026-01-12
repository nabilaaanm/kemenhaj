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
                <div class="stat-value">85%</div>
            </div>
        </div>

        <div class="stat-card purple">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Konten Selesai</div>
                <div class="stat-value">72</div>
            </div>
        </div>

        <div class="stat-card pink">
            <div class="stat-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-label">Kunjungan Unik</div>
                <div class="stat-value">1,234</div>
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
                <div class="stat-value">5,678</div>
            </div>
        </div>
    </div>
</div>

<!-- Content List -->
<div class="content-list">
    <div class="content-item">
        <div class="content-thumbnail">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div class="content-details">
            <div class="content-title">Panduan Ibadah Haji 2024</div>
            <div class="content-description">Panduan lengkap untuk jamaah haji yang akan berangkat ke Tanah Suci, meliputi persiapan, rukun, dan sunnah haji.</div>
            <div class="content-meta">12 Slide • Diterbitkan 2 hari lalu</div>
        </div>
        <div class="content-actions">
            <div class="toggle-switch active" onclick="this.classList.toggle('active')"></div>
            <div class="action-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div class="action-icon delete">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="content-item">
        <div class="content-thumbnail">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="content-details">
            <div class="content-title">Informasi Umrah Terbaru</div>
            <div class="content-description">Update informasi terkini mengenai paket umrah, persyaratan, dan prosedur perjalanan umrah ke Tanah Suci.</div>
            <div class="content-meta">8 Slide • Diterbitkan 5 hari lalu</div>
        </div>
        <div class="content-actions">
            <div class="toggle-switch" onclick="this.classList.toggle('active')"></div>
            <div class="action-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div class="action-icon delete">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="content-item">
        <div class="content-thumbnail">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="content-details">
            <div class="content-title">Galeri Foto Kegiatan Haji</div>
            <div class="content-description">Kumpulan foto dokumentasi kegiatan ibadah haji dan umrah di berbagai lokasi, termasuk foto jamaah dan aktivitas di Tanah Suci.</div>
            <div class="content-meta">24 Foto • Diterbitkan 1 minggu lalu</div>
        </div>
        <div class="content-actions">
            <div class="toggle-switch active" onclick="this.classList.toggle('active')"></div>
            <div class="action-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div class="action-icon delete">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection
