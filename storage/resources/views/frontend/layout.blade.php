<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ekstrakurikuler PKS') - SMKN 2 Purwakarta</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --pks-navy:#c5161d;
            --pks-navy-light:#c5161d;
            --pks-navy-dark:#c5161d;
            --pks-red: #c5161d;
            --pks-red-dark: #991b1b;
            --pks-gold: #d97706;
            --pks-gold-light: #f59e0b;
            --pks-gold-glow: rgba(245, 158, 11, 0.4);
            --pks-dark:#c5161d;
            --pks-gray: #64748b;
            --pks-light: #f8fafc;
            --pks-border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #f8fafc;
            color: var(--pks-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ================= NAVIGATION ================= */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            transition: all 0.3s ease;
            background: #c5161d;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-container {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
        }

        .site-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .site-logo img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--pks-gold);
            box-shadow: 0 0 10px var(--pks-gold-glow);
            transition: transform 0.3s;
        }

        .site-logo:hover img {
            transform: scale(1.06) rotate(5deg);
        }

        .logo-text h1 {
            font-size: 15px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
            margin: 0;
            line-height: 1.2;
        }

        .logo-text p {
            font-size: 11px;
            font-weight: 500;
            color: #94a3b8;
            margin: 0;
            letter-spacing: 0.3px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .nav-links a {
            color: #e2e8f0;
            text-decoration: none;
            padding: 8px 14px;
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-links a i {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-links a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a.active {
            background: var(--pks-red);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(197, 22, 29, 0.35);
        }

        .btn-nav-login {
            background: linear-gradient(135deg, var(--pks-gold) 0%, var(--pks-gold-light) 100%) !important;
            color: var(--pks-navy-dark) !important;
            font-weight: 700 !important;
            box-shadow: 0 3px 10px rgba(217, 119, 6, 0.3) !important;
            margin-left: 8px;
        }

        .btn-nav-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(217, 119, 6, 0.4) !important;
            color: var(--pks-navy-dark) !important;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 22px;
            cursor: pointer;
        }

        /* ================= PAGE HERO SUB-HEADER ================= */
        .page-header-banner {
            position: relative;
            background: linear-gradient(135deg, var(--pks-navy-dark) 0%, var(--pks-navy) 100%);
            padding: 130px 20px 60px 20px;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
            border-bottom: 3px solid var(--pks-gold);
        }

        .page-header-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset("img/POTO PKS3.jpeg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.18;
            filter: blur(1px);
        }

        .page-header-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .page-header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(217, 119, 6, 0.2);
            color: var(--pks-gold-light);
            border: 1px solid rgba(217, 119, 6, 0.4);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .page-header-title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
        }

        .page-header-desc {
            font-size: 15px;
            color: #cbd5e1;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .page-header-line {
            width: 60px;
            height: 4px;
            background: var(--pks-red);
            margin: 16px auto 0 auto;
            border-radius: 2px;
        }

        /* ================= MAIN CONTAINER ================= */
        .main-wrapper {
            max-width: 1240px;
            margin: 0 auto;
            padding: 50px 20px;
            min-height: 60vh;
        }

        /* ================= CARDS & UTILS ================= */
        .section-title-wrap {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(197, 22, 29, 0.1);
            color: var(--pks-red);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--pks-navy);
            letter-spacing: -0.5px;
        }

        .section-divider {
            width: 50px;
            height: 3px;
            background: var(--pks-gold);
            margin: 12px auto 0 auto;
            border-radius: 2px;
        }

        /* ================= FILTER PILLS ================= */
        .filter-pills-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }

        .filter-pill {
            padding: 8px 18px;
            background: #ffffff;
            color: var(--pks-navy);
            border: 1.5px solid var(--pks-border);
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .filter-pill:hover {
            border-color: var(--pks-navy);
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        .filter-pill.active {
            background: var(--pks-navy);
            color: #ffffff;
            border-color: var(--pks-navy);
            box-shadow: 0 4px 12px rgba(11, 30, 54, 0.25);
        }

        /* ================= PAGINATION ================= */
        .pagination-box {
            margin-top: 45px;
            display: flex;
            justify-content: center;
        }

        .pagination-box nav {
            display: flex;
            gap: 6px;
        }

        .pagination-box .pagination {
            display: flex;
            list-style: none;
            gap: 6px;
            margin: 0;
            padding: 0;
        }

        .pagination-box .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border: 1px solid var(--pks-border);
            border-radius: 8px;
            color: var(--pks-navy);
            background: #ffffff;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .pagination-box .page-item:hover .page-link {
            background: #f1f5f9;
            border-color: var(--pks-navy);
        }

        .pagination-box .page-item.active .page-link {
            background: var(--pks-red);
            color: #ffffff;
            border-color: var(--pks-red);
            box-shadow: 0 4px 10px rgba(197, 22, 29, 0.3);
        }

        .pagination-box .page-item.disabled .page-link {
            color: #94a3b8;
            pointer-events: none;
            background: #f8fafc;
        }

        /* ================= FOOTER ================= */
        .site-footer {
            background: var(--pks-navy-dark);
            color: #ffffff;
            padding-top: 60px;
            border-top: 4px solid var(--pks-gold);
            position: relative;
        }

        .footer-grid {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px 40px 24px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
        }

        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }

        .footer-col h3 {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 32px;
            height: 2px;
            background: var(--pks-gold);
        }

        .footer-col p {
            font-size: 13.5px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .footer-brand img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid var(--pks-gold);
        }

        .footer-brand h4 {
            font-size: 15px;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
        }
        .footer-brand span {
            font-size: 11px;
            color: var(--pks-gold-light);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .footer-links a:hover {
            color: var(--pks-gold-light);
            transform: translateX(4px);
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 13px;
            color: #cbd5e1;
        }

        .footer-contact-item i {
            color: var(--pks-gold-light);
            margin-top: 4px;
            font-size: 14px;
        }

        .footer-bottom {
            background: #040a12;
            padding: 20px 24px;
            text-align: center;
            font-size: 12.5px;
            color: #64748b;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* ================= MOBILE NAVIGATION ================= */
        @media (max-width: 1024px) {
            .nav-links {
                position: fixed;
                top: 68px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 68px);
                background: var(--pks-navy);
                flex-direction: column;
                align-items: flex-start;
                padding: 30px;
                gap: 12px;
                transition: left 0.3s ease;
                overflow-y: auto;
            }

            .nav-links.show {
                left: 0;
            }

            .nav-links a {
                width: 100%;
                padding: 12px 18px;
                font-size: 15px;
            }

            .btn-nav-login {
                margin-left: 0;
                margin-top: 10px;
                text-align: center;
                justify-content: center;
            }

            .mobile-menu-toggle {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ================= NAVBAR ================= -->
    <header class="site-header" id="siteHeader">
        <div class="header-container">
            <a href="{{ route('beranda') }}" class="site-logo">
                <img src="{{ asset('img/logo pks.jpeg') }}" alt="Logo PKS SMKN 2 Purwakarta">
                <div class="logo-text">
                    <h1>PKS SMKN 2 PURWAKARTA</h1>
                    <p>Patroli Keamanan Sekolah</p>
                </div>
            </a>

            <nav>
                <ul class="nav-links" id="navMenu">
                    <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Beranda</a></li>
                    <li><a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}"><i class="fa-solid fa-id-card"></i> Profil</a></li>
                    <li><a href="{{ route('organisasi') }}" class="{{ request()->routeIs('organisasi') ? 'active' : '' }}"><i class="fa-solid fa-sitemap"></i> Organisasi</a></li>
                    <li><a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
                    <li><a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}"><i class="fa-solid fa-images"></i> Galeri</a></li>
                    <li><a href="{{ route('prestasi') }}" class="{{ request()->routeIs('prestasi') ? 'active' : '' }}"><i class="fa-solid fa-trophy"></i> Prestasi</a></li>
                    <li><a href="{{ route('anggota') }}" class="{{ request()->routeIs('anggota') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Anggota</a></li>
                    <li><a href="{{ route('agenda') }}" class="{{ request()->routeIs('agenda') ? 'active' : '' }}"><i class="fa-solid fa-calendar-check"></i> Agenda</a></li>
                    <li>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn-nav-login">
                                <i class="fa-solid fa-gauge-high"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-nav-login">
                                <i class="fa-solid fa-right-to-bracket"></i> Login
                            </a>
                        @endauth
                    </li>
                </ul>
            </nav>

            <button class="mobile-menu-toggle" id="menuToggle" type="button" aria-label="Buka Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    @yield('header_banner')

    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col" data-aos="fade-up">
                <div class="footer-brand">
                    <img src="{{ asset('img/logo pks.jpeg') }}" alt="Logo PKS">
                    <div>
                        <h4>PKS SMKN 2 PURWAKARTA</h4>
                        <span>Patroli Keamanan Sekolah</span>
                    </div>
                </div>
                <p>
                    Wadah pembinaan kedisiplinan, ketertiban lalu lintas, dan kepemimpinan siswa SMKN 2 Purwakarta. Berkomitmen membentuk generasi berkarakter teladan, berani, dan berintegritas.
                </p>
                <div style="font-size: 12px; color: var(--pks-gold-light); font-weight: 600; margin-top: 10px;">
                    <i class="fa-solid fa-quote-left"></i> Tegakkan Disiplin, Junjung Kebersamaan, Mengabdi untuk Keamanan Sekolah.
                </div>
            </div>

            <div class="footer-col" data-aos="fade-up" data-aos-delay="100">
                <h3>Navigasi Cepat</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('beranda') }}"><i class="fa-solid fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('profil') }}"><i class="fa-solid fa-chevron-right"></i> Profil & Sejarah</a></li>
                    <li><a href="{{ route('organisasi') }}"><i class="fa-solid fa-chevron-right"></i> Struktur Pengurus</a></li>
                    <li><a href="{{ route('berita') }}"><i class="fa-solid fa-chevron-right"></i> Warta & Kegiatan</a></li>
                    <li><a href="{{ route('prestasi') }}"><i class="fa-solid fa-chevron-right"></i> Prestasi Juara</a></li>
                </ul>
            </div>

            <div class="footer-col" data-aos="fade-up" data-aos-delay="200">
                <h3>Informasi Lain</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('galeri') }}"><i class="fa-solid fa-chevron-right"></i> Dokumentasi Foto</a></li>
                    <li><a href="{{ route('anggota') }}"><i class="fa-solid fa-chevron-right"></i> Daftar Anggota</a></li>
                    <li><a href="{{ route('agenda') }}"><i class="fa-solid fa-chevron-right"></i> Agenda Kegiatan</a></li>
                    <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i> Portal Administrator</a></li>
                </ul>
            </div>

            <div class="footer-col" data-aos="fade-up" data-aos-delay="300">
                <h3>Sekretariat & Markas</h3>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-school"></i>
                    <span>SMK Negeri 2 Purwakarta<br>Jl. Jend. Ahmad Yani No. 98, Purwakarta, Jawa Barat 41114</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>pks@smkn2purwakarta.sch.id</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-instagram"></i>
                    <span>&#64;pks_smkn2pwk</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 40,
        });

        // Mobile Menu Toggle
        const menuToggle = document.getElementById("menuToggle");
        const navMenu = document.getElementById("navMenu");

        menuToggle.addEventListener("click", function () {
            navMenu.classList.toggle("show");
            const icon = menuToggle.querySelector("i");
            if (navMenu.classList.contains("show")) {
                icon.classList.remove("fa-bars");
                icon.classList.add("fa-xmark");
            } else {
                icon.classList.remove("fa-xmark");
                icon.classList.add("fa-bars");
            }
        });

        // Close on link click
        document.querySelectorAll(".nav-links a").forEach(link => {
            link.addEventListener("click", () => {
                navMenu.classList.remove("show");
                const icon = menuToggle.querySelector("i");
                if (icon) {
                    icon.classList.remove("fa-xmark");
                    icon.classList.add("fa-bars");
                }
            });
        });

        // Header shadow on scroll
        window.addEventListener("scroll", () => {
            const header = document.getElementById("siteHeader");
            if (window.scrollY > 50) {
                header.style.boxShadow = "0 10px 25px rgba(0, 0, 0, 0.25)";
            } else {
                header.style.boxShadow = "none";
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
