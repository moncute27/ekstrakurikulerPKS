<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - PKS SMKN 2 Purwakarta</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom CSS Base -->
    <link rel="stylesheet" href="{{ asset('backend/dashboard.css') }}">

    <style>
        :root {
            --pks-navy: #0b1e36;
            --pks-navy-light: #152d4e;
            --pks-navy-dark: #071322;
            --pks-red: #c5161d;
            --pks-gold: #d97706;
            --pks-gold-light: #f59e0b;
            --pks-dark: #1e293b;
            --pks-gray: #64748b;
            --pks-light: #f8fafc;
            --pks-border: #e2e8f0;
            --pks-success: #10b981;
            --pks-danger: #ef4444;
        }

        body {
            background: #eef2f6 !important;
            padding: 20px !important;
            font-family: 'Poppins', sans-serif !important;
            color: var(--pks-dark);
        }

        .dashboard-container {
            display: flex;
            width: 100%;
            max-width: 1380px;
            min-height: 92vh;
            margin: 0 auto;
            background: #ffffff !important;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(11, 30, 54, 0.12);
        }

        /* SIDEBAR PKS THEME */
        .sidebar {
            width: 275px;
            flex-shrink: 0;
            background: var(--pks-navy) !important;
            padding: 25px 18px;
            display: flex;
            flex-direction: column;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .brand img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--pks-gold);
            box-shadow: 0 0 12px rgba(217, 119, 6, 0.4);
        }

        .brand-text h2 {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .brand-text p {
            font-size: 11px;
            color: #cbd5e1;
            margin: 0;
            line-height: 1.3;
        }

        .brand-badge {
            display: inline-block;
            background: rgba(217, 119, 6, 0.2);
            color: var(--pks-gold-light);
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            border: 1px solid rgba(217, 119, 6, 0.3);
            margin-top: 4px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
        }

        .menu-category-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            font-weight: 700;
            margin: 12px 0 4px 10px;
        }

        .sidebar-menu a.nav-item,
        .sidebar-menu a.menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-menu a.nav-item i,
        .sidebar-menu a.menu-item i {
            font-size: 16px;
            width: 22px;
            text-align: center;
            color: #94a3b8;
            transition: all 0.2s ease;
        }

        .sidebar-menu a.nav-item:hover,
        .sidebar-menu a.menu-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar-menu a.nav-item:hover i,
        .sidebar-menu a.menu-item:hover i {
            color: var(--pks-gold-light);
        }

        .sidebar-menu a.nav-item.active,
        .sidebar-menu a.menu-item.active {
            background: linear-gradient(135deg, var(--pks-red) 0%, #991b1b 100%) !important;
            color: #ffffff !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(197, 22, 29, 0.35);
        }

        .sidebar-menu a.nav-item.active i,
        .sidebar-menu a.menu-item.active i {
            color: #ffffff !important;
        }

        .sidebar-footer {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .btn-view-site {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-view-site:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            text-decoration: none;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 500;
            transition: 0.2s;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .logout-btn:hover {
            background: var(--pks-red);
            color: #ffffff;
        }

        /* MAIN CONTENT AREA */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f8fafc;
            min-width: 0;
            overflow-y: auto;
        }

        /* TOPBAR */
        .topbar {
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid var(--pks-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--pks-dark);
            cursor: pointer;
        }

        .topbar-title h1 {
            font-size: 18px;
            font-weight: 700;
            color: var(--pks-navy);
            margin: 0;
        }

        .topbar-title span {
            font-size: 12px;
            color: var(--pks-gray);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .live-date {
            font-size: 12px;
            color: var(--pks-gray);
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .admin-dropdown-wrapper {
            position: relative;
        }

        .admin-profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            background: #f8fafc;
            padding: 6px 14px;
            border-radius: 30px;
            border: 1px solid var(--pks-border);
            transition: 0.2s;
        }
        .admin-profile-btn:hover {
            background: #f1f5f9;
        }

        .admin-profile-btn .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--pks-navy), var(--pks-navy-light));
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            border: 2px solid var(--pks-gold);
        }

        .admin-profile-btn .info {
            text-align: left;
            line-height: 1.2;
        }

        .admin-profile-btn .info strong {
            display: block;
            font-size: 13px;
            color: var(--pks-dark);
        }

        .admin-profile-btn .info small {
            font-size: 11px;
            color: var(--pks-gray);
        }

        .dropdown-menu-custom {
            display: none;
            position: absolute;
            right: 0;
            top: 110%;
            width: 200px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--pks-border);
            padding: 8px 0;
            z-index: 50;
        }

        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: var(--pks-dark);
            text-decoration: none;
            font-size: 13px;
            transition: 0.2s;
        }

        .dropdown-menu-custom a:hover {
            background: #f1f5f9;
            color: var(--pks-red);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--pks-border);
            margin: 6px 0;
        }

        /* CONTENT BODY */
        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* ALERTS */
        .alert-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success-custom {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger-custom {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
        }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background: rgba(11, 30, 54, 0.65);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 25px;
            background: var(--pks-navy);
            color: #ffffff;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 22px;
            cursor: pointer;
            transition: 0.2s;
        }
        .modal-close:hover {
            color: #f87171;
        }

        .modal-body {
            padding: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--pks-dark);
        }

        .form-group label .required {
            color: var(--pks-red);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--pks-border);
            border-radius: 8px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--pks-dark);
            transition: 0.2s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--pks-navy-light);
            box-shadow: 0 0 0 3px rgba(21, 45, 78, 0.12);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 15px;
            border-top: 1px solid var(--pks-border);
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: #e2e8f0;
            color: #475569;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-cancel:hover {
            background: #cbd5e1;
        }

        .btn-submit {
            padding: 10px 22px;
            background: linear-gradient(135deg, var(--pks-red) 0%, #991b1b 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 4px 10px rgba(197, 22, 29, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-submit:hover {
            background: #a51319;
            transform: translateY(-1px);
        }

        /* PAGINATION STYLING */
        .pagination-container {
            margin-top: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: var(--pks-gray);
        }

        .pagination-container nav {
            display: flex;
            gap: 6px;
        }

        .pagination-container .pagination {
            display: flex;
            list-style: none;
            gap: 5px;
            margin: 0;
            padding: 0;
        }

        .pagination-container .page-item .page-link {
            display: block;
            padding: 6px 12px;
            border: 1px solid var(--pks-border);
            border-radius: 6px;
            color: var(--pks-dark);
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .pagination-container .page-item.active .page-link {
            background: var(--pks-navy);
            color: #ffffff;
            border-color: var(--pks-navy);
        }

        .pagination-container .page-item.disabled .page-link {
            color: #94a3b8;
            pointer-events: none;
            background: #f8fafc;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                bottom: 0;
                z-index: 999;
                box-shadow: 10px 0 25px rgba(0, 0, 0, 0.25);
            }
            .sidebar.show {
                left: 0;
            }
            .hamburger-btn {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="dashboard-container">

        <!-- ================= SIDEBAR ================= -->
        <aside class="sidebar" id="mainSidebar">
            <!-- BRAND -->
            <div class="brand">
                <img src="{{ asset('img/logo pks.jpeg') }}" alt="Logo PKS">
                <div class="brand-text">
                    <h2>ADMIN PKS <i class="fa-solid fa-shield-halved" style="color: var(--pks-gold-light); font-size: 13px;"></i></h2>
                    <p>Patroli Keamanan Sekolah</p>
                    <p>SMKN 2 PURWAKARTA</p>
                    <span class="brand-badge"><i class="fa-solid fa-award"></i> Panel Disiplin</span>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="sidebar-menu">
                <div class="menu-category-title">Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>

                <div class="menu-category-title">Informasi & Profil</div>
                <a href="{{ route('admin.profil') }}" class="nav-item {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                    <i class="fa-solid fa-id-card"></i>
                    <span>Profil PKS</span>
                </a>

                <a href="{{ route('admin.organisasi') }}" class="nav-item {{ request()->routeIs('admin.organisasi*') ? 'active' : '' }}">
                    <i class="fa-solid fa-sitemap"></i>
                    <span>Struktur Organisasi</span>
                </a>

                <div class="menu-category-title">Publikasi & Giat</div>
                <a href="{{ route('admin.berita') }}" class="nav-item {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>

                <a href="{{ route('admin.galeri') }}" class="nav-item {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i>
                    <span>Galeri Foto</span>
                </a>

                <a href="{{ route('admin.prestasi') }}" class="nav-item {{ request()->routeIs('admin.prestasi*') ? 'active' : '' }}">
                    <i class="fa-solid fa-trophy"></i>
                    <span>Prestasi Juara</span>
                </a>

                <div class="menu-category-title">Keanggotaan & Jadwal</div>
                <a href="{{ route('admin.anggota') }}" class="nav-item {{ request()->routeIs('admin.anggota*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Data Anggota</span>
                </a>

                <a href="{{ route('admin.agenda') }}" class="nav-item {{ request()->routeIs('admin.agenda*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Agenda Patroli</span>
                </a>

                <div class="menu-category-title">Sistem & Pengguna</div>
                <a href="{{ route('admin.user') }}" class="nav-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Kelola User</span>
                </a>
            </nav>

            <!-- SIDEBAR FOOTER -->
            <div class="sidebar-footer">
                <a href="{{ route('beranda') }}" target="_blank" class="btn-view-site">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Lihat Website</span>
                </a>

                <a href="{{ route('logout') }}" class="logout-btn">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar / Logout</span>
                </a>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="topbar">
                <div class="topbar-left">
                    <button class="hamburger-btn" id="sidebarToggle" type="button" title="Menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="topbar-title">
                        <h1>@yield('page_title', 'Admin Dashboard')</h1>
                        <span>@yield('page_subtitle', 'Panel Kontrol Ekstrakurikuler PKS SMKN 2 Purwakarta')</span>
                    </div>
                </div>

                <div class="topbar-right">
                    <div class="live-date">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>

                    <!-- ADMIN PROFILE DROPDOWN -->
                    <div class="admin-dropdown-wrapper">
                        <div class="admin-profile-btn" id="adminDropdownBtn">
                            <div class="avatar">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <div class="info">
                                <strong>{{ Auth::user()->nama ?? 'Admin PKS' }}</strong>
                                <small>{{ Auth::user()->role ?? 'Administrator' }}</small>
                            </div>
                            <i class="fa-solid fa-chevron-down" style="font-size: 11px; color: var(--pks-gray);"></i>
                        </div>

                        <div class="dropdown-menu-custom" id="adminDropdownMenu">
                            <a href="{{ route('admin.admin-profile') }}">
                                <i class="fa-solid fa-user-pen"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('admin.admin-profile') }}">
                                <i class="fa-solid fa-key"></i>
                                <span>Ganti Password</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('beranda') }}" target="_blank">
                                <i class="fa-solid fa-globe"></i>
                                <span>Kunjungi Web</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" style="color: var(--pks-red);">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">
                <!-- FLASH MESSAGES -->
                @if(session('success'))
                    <div class="alert-custom alert-success-custom">
                        <div>
                            <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="alert-close" onclick="this.parentElement.remove();">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-custom alert-danger-custom">
                        <div>
                            <i class="fa-solid fa-triangle-exclamation" style="margin-right: 8px;"></i>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="alert-close" onclick="this.parentElement.remove();">&times;</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-custom alert-danger-custom" style="display: block;">
                        <div style="font-weight: 700; margin-bottom: 6px;">
                            <i class="fa-solid fa-circle-xmark"></i> Terdapat kesalahan pengisian data:
                        </div>
                        <ul style="margin-left: 20px; font-size: 13px;">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>

        </main>

    </div>

    <!-- SCRIPTS -->
    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainSidebar = document.getElementById('mainSidebar');
        if (sidebarToggle && mainSidebar) {
            sidebarToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                mainSidebar.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!mainSidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    mainSidebar.classList.remove('show');
                }
            });
        }

        // Admin Dropdown Toggle
        const adminDropdownBtn = document.getElementById('adminDropdownBtn');
        const adminDropdownMenu = document.getElementById('adminDropdownMenu');
        if (adminDropdownBtn && adminDropdownMenu) {
            adminDropdownBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                adminDropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function () {
                adminDropdownMenu.classList.remove('show');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
