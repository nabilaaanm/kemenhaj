<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/png" href="{{ asset('image/lambang.png') }}">
    <title>@yield('title', 'Admin') - Kementerian Haji dan Umrah Kota Cirebon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: #f3f4f6;
        }
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a1f2e 0%, #16213e 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .sidebar-header img {
            height: 48px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }
        .sidebar-header-text {
            flex: 1;
            min-width: 0;
        }
        .sidebar-header h1 {
            font-size: 14px;
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 2px;
        }
        .sidebar-header p {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            line-height: 1.3;
        }
        .sidebar-menu {
            padding: 20px 0;
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            margin: 2px 12px;
            border-radius: 10px;
        }
        .menu-item:hover {
            background: rgba(236, 177, 118, 0.15);
            color: white;
            transform: translateX(4px);
        }
        .menu-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #ECB176;
            border-radius: 0 4px 4px 0;
        }
        .menu-item.has-submenu {
            justify-content: space-between;
            cursor: pointer;
        }
        .menu-item .menu-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }
        .submenu-arrow {
            transition: transform 0.3s ease;
            font-size: 12px;
            opacity: 0.7;
        }
        .menu-item.has-submenu.active .submenu-arrow {
            transform: rotate(180deg);
        }
        .submenu {
            display: none;
            background: rgba(0, 0, 0, 0.2);
            margin: 4px 12px;
            border-radius: 8px;
            overflow: hidden;
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 500px;
            }
        }
        .submenu.active {
            display: block;
        }
        .submenu-item {
            padding: 12px 20px 12px 52px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            transition: all 0.2s ease;
            position: relative;
        }
        .submenu-item::before {
            content: '';
            position: absolute;
            left: 36px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: all 0.2s ease;
        }
        .submenu-item:hover {
            background: rgba(236, 177, 118, 0.1);
            color: white;
            padding-left: 56px;
        }
        .submenu-item:hover::before {
            background: #ECB176;
            transform: scale(1.3);
        }
        .submenu-item.active {
            color: #ECB176;
            background: rgba(236, 177, 118, 0.15);
            font-weight: 600;
        }
        .submenu-item.active::before {
            background: #ECB176;
            transform: scale(1.3);
        }
        /* Active Users Section */
        .active-users-section {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .active-users-title {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .active-users-list {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .active-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ECB176;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: visible;
        }
        .active-user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .active-user-avatar svg {
            width: 24px;
            height: 24px;
            color: rgba(255, 255, 255, 0.7);
        }
        .active-user-more {
            background: rgba(236, 177, 118, 0.2);
            border: 2px solid #ECB176;
            color: #ECB176;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* World Map Section */
        .world-map-section {
            padding: 20px;
            margin-top: auto;
        }
        .world-map-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 16px;
            height: 180px;
            position: relative;
            overflow: hidden;
        }
        .world-map {
            width: 100%;
            height: 100%;
            opacity: 0.3;
            object-fit: contain;
        }
        .world-map-lines {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }
        .world-map-lines svg {
            width: 100%;
            height: 100%;
        }
        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
        }
        .topbar {
            background-color: white;
            padding: 16px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            position: relative;
        }
        .topbar h2 {
            font-size: 20px;
            font-weight: 600;
            color: #374151;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-info-topbar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-right: 16px;
            border-right: 1px solid #e5e7eb;
        }
        .user-avatar-topbar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ECB176;
            background: rgba(236, 177, 118, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .user-avatar-topbar.role-admin {
            border-color: #ECB176;
            background: rgba(254, 243, 199, 0.3);
        }
        .user-avatar-topbar.role-editor {
            border-color: #1e40af;
            background: rgba(219, 234, 254, 0.3);
        }
        .user-avatar-topbar.role-kontributor {
            border-color: rgb(61, 163, 48);
            background: rgba(214, 248, 216, 0.3);
        }
        .user-avatar-topbar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-avatar-topbar svg {
            width: 24px;
            height: 24px;
            color: #ECB176;
        }
        .user-avatar-topbar.role-admin svg {
            color: #ECB176;
        }
        .user-avatar-topbar.role-editor svg {
            color: #1e40af;
        }
        .user-avatar-topbar.role-kontributor svg {
            color: rgb(61, 163, 48);
        }
        .user-details-topbar {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .user-name-topbar {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-block;
            width: fit-content;
            line-height: 1.2;
        }
        .user-name-topbar.role-admin {
            background-color: #fef3c7;
            color: #92400e;
        }
        .user-name-topbar.role-editor {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .user-name-topbar.role-kontributor {
            background-color: rgb(214, 248, 216);
            color: rgb(61, 163, 48);
        }
        .user-email-topbar {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.2;
        }
    
        .user-name {
            font-size: 14px;
            color: #6b7280;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-admin {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-editor {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-kontributor {
            background-color: #d1fae5;
            color: #065f46;
        }
        .btn-logout {
            padding: 8px 16px;
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-logout:hover {
            background-color: #b91c1c;
        }
        .content-area {
            padding: 24px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }
        .card h3 {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
        }
        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #374151;
            font-size: 24px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <img src="{{ asset('image/lambang.png') }}" alt="Logo">
                <div class="sidebar-header-text">
                    <h1>Kementerian Haji</h1>
                    <p>dan Umrah Kota Cirebon</p>
                </div>
            </div>
            
            <nav class="sidebar-menu">
                @php
                    $userRole = session('user.role', 'kontributor');
                @endphp

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Posting -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.posting.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Posting</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.posting.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posting.create') }}" class="submenu-item {{ request()->routeIs('admin.posting.create') ? 'active' : '' }}">
                        <span>Tambah</span>
                    </a>
                    <a href="{{ route('admin.posting.index') }}" class="submenu-item {{ request()->routeIs('admin.posting.index') ? 'active' : '' }}">
                        <span>Lihat</span>
                    </a>
                    <a href="{{ route('admin.posting.category') }}" class="submenu-item {{ request()->routeIs('admin.posting.category') ? 'active' : '' }}">
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.posting.berita') }}" class="submenu-item {{ request()->routeIs('admin.posting.berita') ? 'active' : '' }}">
                        <span>Berita</span>
                    </a>
                    <a href="{{ route('admin.posting.pengumuman') }}" class="submenu-item {{ request()->routeIs('admin.posting.pengumuman') ? 'active' : '' }}">
                        <span>Pengumuman</span>
                    </a>
                    <a href="{{ route('admin.posting.siaran-pers') }}" class="submenu-item {{ request()->routeIs('admin.posting.siaran-pers') ? 'active' : '' }}">
                        <span>Siaran Pers</span>
                    </a>
                    <a href="{{ route('admin.posting.hoax') }}" class="submenu-item {{ request()->routeIs('admin.posting.hoax') ? 'active' : '' }}">
                        <span>Hoax</span>
                    </a>
                </div>

                @if(in_array($userRole, ['admin', 'editor']))
                <!-- Halaman -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.halaman.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        <span>Halaman</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.halaman.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.halaman.create') }}" class="submenu-item {{ request()->routeIs('admin.halaman.create') ? 'active' : '' }}">
                        <span>Tambah Halaman</span>
                    </a>
                    <a href="{{ route('admin.halaman.index') }}" class="submenu-item {{ request()->routeIs('admin.halaman.index') ? 'active' : '' }}">
                        <span>Lihat Halaman</span>
                    </a>
                </div>

                <!-- Galeri -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Galeri</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.galeri.foto.create') }}" class="submenu-item {{ request()->routeIs('admin.galeri.foto.create') ? 'active' : '' }}">
                        <span>Tambah Foto</span>
                    </a>
                    <a href="{{ route('admin.galeri.foto.index') }}" class="submenu-item {{ request()->routeIs('admin.galeri.foto.index') ? 'active' : '' }}">
                        <span>Lihat Foto</span>
                    </a>
                    <a href="{{ route('admin.galeri.video.create') }}" class="submenu-item {{ request()->routeIs('admin.galeri.video.create') ? 'active' : '' }}">
                        <span>Tambah Video</span>
                    </a>
                    <a href="{{ route('admin.galeri.video.index') }}" class="submenu-item {{ request()->routeIs('admin.galeri.video.index') ? 'active' : '' }}">
                        <span>Lihat Video</span>
                    </a>
                    <a href="{{ route('admin.galeri.infografis.create') }}" class="submenu-item {{ request()->routeIs('admin.galeri.infografis.create') ? 'active' : '' }}">
                        <span>Tambah Infografis</span>
                    </a>
                    <a href="{{ route('admin.galeri.infografis.index') }}" class="submenu-item {{ request()->routeIs('admin.galeri.infografis.index') ? 'active' : '' }}">
                        <span>Lihat Infografis</span>
                    </a>
                </div>

                <!-- Layanan -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Layanan</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.layanan.create') }}" class="submenu-item {{ request()->routeIs('admin.layanan.create') ? 'active' : '' }}">
                        <span>Tambah Layanan</span>
                    </a>
                    <a href="{{ route('admin.layanan.index') }}" class="submenu-item {{ request()->routeIs('admin.layanan.index') ? 'active' : '' }}">
                        <span>Lihat Layanan</span>
                    </a>
                </div>

                <!-- Regulasi -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.regulasi.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Regulasi</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.regulasi.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.regulasi.create') }}" class="submenu-item {{ request()->routeIs('admin.regulasi.create') ? 'active' : '' }}">
                        <span>Tambah Regulasi</span>
                    </a>
                    <a href="{{ route('admin.regulasi.index') }}" class="submenu-item {{ request()->routeIs('admin.regulasi.index') ? 'active' : '' }}">
                        <span>Lihat Regulasi</span>
                    </a>
                </div>
                @endif

                @if($userRole === 'admin')
                <!-- Pengaturan -->
                <div class="menu-item has-submenu {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Pengaturan</span>
                    </div>
                    <span class="submenu-arrow">▼</span>
                </div>
                <div class="submenu {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengaturan.umum') }}" class="submenu-item {{ request()->routeIs('admin.pengaturan.umum') ? 'active' : '' }}">
                        <span>Umum</span>
                    </a>
                    <a href="{{ route('admin.pengaturan.modul') }}" class="submenu-item {{ request()->routeIs('admin.pengaturan.modul') ? 'active' : '' }}">
                        <span>Modul</span>
                    </a>
                    <a href="{{ route('admin.pengaturan.tampilan') }}" class="submenu-item {{ request()->routeIs('admin.pengaturan.tampilan') ? 'active' : '' }}">
                        <span>Tampilan</span>
                    </a>
                    <a href="{{ route('admin.pengaturan.slideshow') }}" class="submenu-item {{ request()->routeIs('admin.pengaturan.slideshow') ? 'active' : '' }}">
                        <span>Slideshow</span>
                    </a>
                    <a href="{{ route('admin.pengaturan.pengguna') }}" class="submenu-item {{ request()->routeIs('admin.pengaturan.pengguna') ? 'active' : '' }}">
                        <span>Pengguna</span>
                    </a>
                </div>

                <!-- Panduan Pengguna -->
                <a href="{{ route('admin.pengaturan.panduan') }}" class="menu-item {{ request()->routeIs('admin.pengaturan.panduan') ? 'active' : '' }}">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Panduan Pengguna</span>
                </a>
                @endif
                
                <!-- Panduan Pengguna untuk Editor dan Kontributor -->
                @if(in_array($userRole, ['editor', 'kontributor']))
                <a href="{{ route('admin.pengaturan.panduan') }}" class="menu-item {{ request()->routeIs('admin.pengaturan.panduan') ? 'active' : '' }}">
                    <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Panduan Pengguna</span>
                </a>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 16px; flex: 0 0 auto;">
                    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                    <h2>@yield('page-title', 'Dashboard')</h2>
                </div>
                <div style="position: absolute; left: 50%; transform: translateX(-50%);">
                    <a href="{{ route('home') }}" 
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background-color: #ECB176; color: white; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; transition: background-color 0.2s; white-space: nowrap;"
                       onmouseover="this.style.backgroundColor='#D99D5F'"
                       onmouseout="this.style.backgroundColor='#ECB176'"
                       target="_blank">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Beranda
                    </a>
                </div>
                <div class="user-menu" style="flex: 0 0 auto; margin-left: auto;">
                    <div class="user-info-topbar">
                        @php
                            $userRole = session('user.role', 'kontributor');
                            $roleClass = 'role-' . $userRole;
                        @endphp
                        <div class="user-avatar-topbar {{ $roleClass }}">
                            @if(session('user.avatar'))
                                <img src="{{ asset('storage/' . session('user.avatar')) }}" alt="{{ session('user.name') }}">
                            @else
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="user-details-topbar">
                            <div class="user-name-topbar {{ $roleClass }}">{{ strtoupper(session('user.name')) }}</div>
                            <div class="user-email-topbar">{{ session('user.email') }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleSubmenu(element) {
            const submenu = element.nextElementSibling;
            if (submenu) {
                submenu.classList.toggle('active');
                element.classList.toggle('active');
                const arrow = element.querySelector('.submenu-arrow');
                if (arrow) {
                    arrow.textContent = submenu.classList.contains('active') ? '▲' : '▼';
                }
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        // Auto expand submenu if active
        document.addEventListener('DOMContentLoaded', function() {
            const activeSubmenu = document.querySelector('.submenu.active');
            if (activeSubmenu) {
                const parent = activeSubmenu.previousElementSibling;
                if (parent && parent.classList.contains('has-submenu')) {
                    activeSubmenu.classList.add('active');
                    parent.classList.add('active');
                    const arrow = parent.querySelector('.submenu-arrow');
                    if (arrow) {
                        arrow.textContent = '▲';
                    }
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
