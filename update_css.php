<?php
function replace_style($file, $newStyle) {
    $content = file_get_contents($file);
    $pattern = '/<style>.*?<\/style>/s';
    $replacement = "<style>\n" . $newStyle . "\n</style>";
    $newContent = preg_replace($pattern, $replacement, $content);
    if ($newContent !== null) {
        file_put_contents($file, $newContent);
        echo "Updated $file\n";
    } else {
        echo "Failed to update $file\n";
    }
}

$layoutStyle = <<< 'EOD'
        :root {
            --pks-navy: #1E293B; /* Modern slate */
            --pks-navy-light: #334155;
            --pks-navy-dark: #0F172A;
            --pks-red: #DC2626; /* Vibrant Red */
            --pks-red-dark: #991B1B;
            --pks-gold: #F59E0B;
            --pks-gold-light: #FBBF24;
            --pks-gold-glow: rgba(245, 158, 11, 0.4);
            --pks-dark: #111827;
            --pks-gray: #64748B;
            --pks-light: #FFFFFF;
            --pks-border: #E2E8F0;
            --pks-bg-light: #F8FAFC;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--pks-bg-light); color: var(--pks-dark); line-height: 1.6; overflow-x: hidden; }

        /* NAVIGATION */
        .site-header { position: fixed; top: 0; left: 0; right: 0; z-index: 999; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 2px solid var(--pks-red); box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header-container { max-width: 1240px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; padding: 12px 24px; }
        .site-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .site-logo img { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--pks-red); transition: transform 0.3s; }
        .site-logo:hover img { transform: scale(1.06) rotate(5deg); }
        .logo-text h1 { font-size: 15px; font-weight: 800; color: var(--pks-red); letter-spacing: 0.5px; margin: 0; line-height: 1.2; }
        .logo-text p { font-size: 11px; font-weight: 600; color: var(--pks-gray); margin: 0; letter-spacing: 0.3px; }
        .nav-links { display: flex; align-items: center; gap: 4px; list-style: none; }
        .nav-links a { color: var(--pks-dark); text-decoration: none; padding: 8px 14px; font-size: 13.5px; font-weight: 600; border-radius: 8px; transition: all 0.2s ease; display: flex; align-items: center; gap: 6px; }
        .nav-links a i { font-size: 12px; opacity: 0.8; }
        .nav-links a:hover { color: var(--pks-red); background: rgba(220, 38, 38, 0.08); }
        .nav-links a.active { background: var(--pks-red); color: #ffffff; font-weight: 700; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3); }
        .btn-nav-login { background: linear-gradient(135deg, var(--pks-red) 0%, var(--pks-red-dark) 100%) !important; color: #ffffff !important; font-weight: 700 !important; box-shadow: 0 3px 10px rgba(220, 38, 38, 0.3) !important; margin-left: 8px; border: 2px solid transparent; }
        .btn-nav-login:hover { transform: translateY(-2px); background: #ffffff !important; color: var(--pks-red) !important; border-color: var(--pks-red); box-shadow: 0 5px 15px rgba(220, 38, 38, 0.2) !important; }
        .mobile-menu-toggle { display: none; background: none; border: none; color: var(--pks-dark); font-size: 24px; cursor: pointer; }

        /* PAGE HERO */
        .page-header-banner { position: relative; background: linear-gradient(135deg, var(--pks-red-dark) 0%, var(--pks-red) 100%); padding: 130px 20px 60px 20px; color: #ffffff; text-align: center; overflow: hidden; border-bottom: 4px solid var(--pks-gold); }
        .page-header-banner::before { content: ''; position: absolute; inset: 0; background-image: url('{{ asset("img/POTO PKS3.jpeg") }}'); background-size: cover; background-position: center; opacity: 0.2; filter: grayscale(50%) contrast(120%); }
        .page-header-content { position: relative; z-index: 2; max-width: 800px; margin: 0 auto; }
        .page-header-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.15); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3); padding: 5px 16px; border-radius: 20px; font-size: 11.5px; font-weight: 700; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 1px; backdrop-filter: blur(5px); }
        .page-header-title { font-size: 34px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 12px; text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3); }
        .page-header-desc { font-size: 15px; color: rgba(255, 255, 255, 0.9); max-width: 650px; margin: 0 auto; line-height: 1.6; }
        .page-header-line { width: 60px; height: 4px; background: var(--pks-gold); margin: 16px auto 0 auto; border-radius: 2px; }

        /* MAIN */
        .main-wrapper { max-width: 1240px; margin: 0 auto; padding: 50px 20px; min-height: 60vh; }
        .section-title-wrap { text-align: center; margin-bottom: 40px; }
        .section-tag { display: inline-flex; align-items: center; gap: 6px; background: rgba(220, 38, 38, 0.1); color: var(--pks-red); padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .section-title { font-size: 30px; font-weight: 800; color: var(--pks-dark); letter-spacing: -0.5px; }
        .section-divider { width: 50px; height: 3px; background: var(--pks-red); margin: 14px auto 0 auto; border-radius: 2px; }

        /* FILTER PILLS */
        .filter-pills-container { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 35px; flex-wrap: wrap; }
        .filter-pill { padding: 8px 18px; background: #ffffff; color: var(--pks-dark); border: 1.5px solid var(--pks-border); border-radius: 30px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.25s ease; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.02); }
        .filter-pill:hover { border-color: var(--pks-red); color: var(--pks-red); background: rgba(220, 38, 38, 0.02); transform: translateY(-2px); }
        .filter-pill.active { background: var(--pks-red); color: #ffffff; border-color: var(--pks-red); box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); }

        /* PAGINATION */
        .pagination-box { margin-top: 45px; display: flex; justify-content: center; }
        .pagination-box nav { display: flex; gap: 6px; }
        .pagination-box .pagination { display: flex; list-style: none; gap: 6px; margin: 0; padding: 0; }
        .pagination-box .page-item .page-link { display: inline-flex; align-items: center; justify-content: center; min-width: 38px; height: 38px; padding: 0 12px; border: 1px solid var(--pks-border); border-radius: 8px; color: var(--pks-dark); background: #ffffff; text-decoration: none; font-size: 13.5px; font-weight: 600; transition: all 0.2s; box-shadow: 0 2px 6px rgba(0,0,0,0.02); }
        .pagination-box .page-item:hover .page-link { background: rgba(220, 38, 38, 0.05); color: var(--pks-red); border-color: var(--pks-red); }
        .pagination-box .page-item.active .page-link { background: var(--pks-red); color: #ffffff; border-color: var(--pks-red); box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3); }
        .pagination-box .page-item.disabled .page-link { color: var(--pks-gray); pointer-events: none; background: #F1F5F9; }

        /* FOOTER */
        .site-footer { background: var(--pks-dark); color: #ffffff; padding-top: 60px; border-top: 5px solid var(--pks-red); position: relative; }
        .footer-grid { max-width: 1240px; margin: 0 auto; padding: 0 24px 40px 24px; display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 40px; }
        @media (max-width: 992px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 600px) { .footer-grid { grid-template-columns: 1fr; } }
        .footer-col h3 { font-size: 16px; font-weight: 700; color: #ffffff; margin-bottom: 20px; position: relative; padding-bottom: 10px; }
        .footer-col h3::after { content: ''; position: absolute; left: 0; bottom: 0; width: 32px; height: 3px; background: var(--pks-red); border-radius: 2px; }
        .footer-col p { font-size: 13.5px; color: #CBD5E1; line-height: 1.6; margin-bottom: 15px; }
        .footer-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; }
        .footer-brand img { width: 48px; height: 48px; border-radius: 50%; border: 2px solid var(--pks-light); background: #fff; padding: 2px; }
        .footer-brand h4 { font-size: 16px; font-weight: 800; color: #ffffff; margin: 0; }
        .footer-brand span { font-size: 11px; color: var(--pks-gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: #94A3B8; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
        .footer-links a:hover { color: #ffffff; transform: translateX(4px); }
        .footer-links a i { color: var(--pks-red); }
        .footer-contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; font-size: 13px; color: #CBD5E1; }
        .footer-contact-item i { color: var(--pks-red); margin-top: 4px; font-size: 14px; }
        .footer-bottom { background: #0F172A; padding: 20px 24px; text-align: center; font-size: 13px; color: #64748B; border-top: 1px solid rgba(255, 255, 255, 0.05); }

        /* MOBILE NAV */
        @media (max-width: 1024px) {
            .nav-links { position: fixed; top: 70px; left: -100%; width: 100%; height: calc(100vh - 70px); background: #ffffff; flex-direction: column; align-items: flex-start; padding: 30px; gap: 12px; transition: left 0.3s ease; overflow-y: auto; box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
            .nav-links.show { left: 0; }
            .nav-links a { width: 100%; padding: 14px 18px; font-size: 15px; border-bottom: 1px solid var(--pks-border); }
            .nav-links a:hover { background: rgba(220, 38, 38, 0.05); border-radius: 0; }
            .btn-nav-login { margin: 15px 0 0 0; text-align: center; justify-content: center; width: 100%; border-radius: 8px; }
            .mobile-menu-toggle { display: block; }
        }
EOD;

$berandaStyle = <<< 'EOD'
    /* ================= HERO SECTION ================= */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 24px 80px 24px;
        background: linear-gradient(135deg, rgba(153, 27, 27, 0.95) 0%, rgba(220, 38, 38, 0.85) 100%);
        overflow: hidden;
    }
    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: 0.3;
        mix-blend-mode: multiply;
        z-index: 1;
    }
    .hero-decor-shape {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: var(--pks-bg-light);
        clip-path: ellipse(55% 100% at 50% 100%);
        z-index: 3;
    }
    .hero-container { position: relative; z-index: 2; max-width: 960px; text-align: center; color: #ffffff; }
    .hero-badge-tag { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.2); color: #ffffff; border: 1px solid rgba(255,255,255,0.4); padding: 6px 18px; border-radius: 30px; font-size: 12.5px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 24px; backdrop-filter: blur(4px); box-shadow: 0 0 15px rgba(0,0,0,0.1); }
    .hero-crest { width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 20px auto; border: 4px solid #ffffff; box-shadow: 0 0 25px rgba(0,0,0,0.2); display: block; object-fit: cover; background:#fff; padding:2px;}
    .hero-title { font-size: 46px; font-weight: 900; line-height: 1.15; letter-spacing: -0.5px; margin-bottom: 18px; text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); }
    .hero-title span { color: #ffffff; }
    .hero-title .highlight { color: #FFD700; display: block; font-size: 34px; margin-top: 6px; font-weight: 800; letter-spacing: 1px; }
    .hero-desc { font-size: 16.5px; color: rgba(255,255,255,0.9); max-width: 720px; margin: 0 auto 35px auto; line-height: 1.7; font-weight: 400; }
    .hero-buttons { display: flex; align-items: center; justify-content: center; gap: 16px; flex-wrap: wrap; }
    .btn-hero-primary { display: inline-flex; align-items: center; gap: 10px; padding: 13px 28px; background: #ffffff; color: var(--pks-red); text-decoration: none; border-radius: 30px; font-size: 14px; font-weight: 800; box-shadow: 0 6px 20px rgba(0,0,0,0.15); transition: all 0.25s; }
    .btn-hero-primary:hover { background: #f8fafc; transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
    .btn-hero-secondary { display: inline-flex; align-items: center; gap: 10px; padding: 13px 26px; background: rgba(255, 255, 255, 0.15); color: #ffffff; text-decoration: none; border-radius: 30px; font-size: 14px; font-weight: 600; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.3); transition: all 0.25s; }
    .btn-hero-secondary:hover { background: rgba(255, 255, 255, 0.25); transform: translateY(-3px); }
    @media (max-width: 768px) { .hero-title { font-size: 32px; } .hero-title .highlight { font-size: 24px; } .hero-desc { font-size: 14px; } }

    /* ================= COUNTERS SECTION ================= */
    .counters-section { position: relative; z-index: 10; margin-top: -50px; padding: 0 24px 60px 24px; }
    .counters-grid { max-width: 1140px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
    @media (max-width: 992px) { .counters-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 540px) { .counters-grid { grid-template-columns: 1fr; } }
    .counter-card { background: #ffffff; padding: 24px 20px; border-radius: 16px; border: 1px solid var(--pks-border); box-shadow: 0 10px 30px rgba(0,0,0,0.06); display: flex; align-items: center; gap: 16px; transition: 0.3s; }
    .counter-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color: var(--pks-red); }
    .counter-icon { width: 54px; height: 54px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
    .counter-icon.blue { background: #eff6ff; color: #1d4ed8; }
    .counter-icon.gold { background: #fef3c7; color: #b45309; }
    .counter-icon.green { background: #ecfdf5; color: #047857; }
    .counter-icon.red { background: #fef2f2; color: var(--pks-red); }
    .counter-info h3 { font-size: 28px; font-weight: 800; color: var(--pks-dark); line-height: 1; margin-bottom: 4px; }
    .counter-info p { font-size: 12.5px; color: var(--pks-gray); font-weight: 600; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }

    /* ================= SECTION COMMON ================= */
    .home-section { padding: 70px 24px; background: #ffffff; }
    .home-section.alt-bg { background: var(--pks-bg-light); }
    .section-container { max-width: 1200px; margin: 0 auto; }

    /* ================= LEADERSHIP / SAMBUTAN ================= */
    .leaders-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 40px; }
    @media (max-width: 800px) { .leaders-grid { grid-template-columns: 1fr; } }
    .leader-card { background: #ffffff; border-radius: 16px; border: 1px solid var(--pks-border); padding: 28px; display: flex; gap: 22px; align-items: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04); transition: 0.3s; }
    .leader-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); border-color: var(--pks-red); }
    .leader-photo { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--pks-red); flex-shrink: 0; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15); }
    .leader-info h4 { font-size: 17px; font-weight: 700; color: var(--pks-dark); margin-bottom: 4px; }
    .leader-role { display: inline-block; background: rgba(220, 38, 38, 0.1); color: var(--pks-red); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; margin-bottom: 10px; text-transform: uppercase; }
    .leader-quote { font-size: 13.5px; color: var(--pks-gray); font-style: italic; line-height: 1.5; }

    /* ================= CORE VALUES ================= */
    .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 40px; }
    @media (max-width: 992px) { .values-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 540px) { .values-grid { grid-template-columns: 1fr; } }
    .value-box { background: #ffffff; border-radius: 14px; padding: 28px 22px; text-align: center; border: 1px solid var(--pks-border); transition: 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
    .value-box:hover { transform: translateY(-6px); box-shadow: 0 15px 30px rgba(220, 38, 38, 0.08); border-color: var(--pks-red); }
    .value-icon-circle { width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, var(--pks-red) 0%, var(--pks-red-dark) 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 26px; margin: 0 auto 18px auto; box-shadow: 0 6px 15px rgba(220, 38, 38, 0.25); }
    .value-box h4 { font-size: 17px; font-weight: 800; color: var(--pks-dark); margin-bottom: 8px; }
    .value-box p { font-size: 13.5px; color: var(--pks-gray); line-height: 1.5; margin: 0; }

    /* ================= NEWS CARDS ================= */
    .news-grid-home { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-top: 35px; }
    @media (max-width: 900px) { .news-grid-home { grid-template-columns: 1fr; } }
    .news-card-item { background: #ffffff; border-radius: 14px; border: 1px solid var(--pks-border); overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04); display: flex; flex-direction: column; transition: 0.3s; }
    .news-card-item:hover { transform: translateY(-5px); box-shadow: 0 12px 28px rgba(0,0,0,0.1); border-color: var(--pks-red); }
    .news-card-img-wrap { height: 200px; width: 100%; overflow: hidden; position: relative; }
    .news-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
    .news-card-item:hover .news-card-img-wrap img { transform: scale(1.06); }
    .news-card-cat { position: absolute; bottom: 12px; left: 12px; background: var(--pks-red); color: #ffffff; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .news-card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .news-card-meta { font-size: 12px; color: var(--pks-gray); margin-bottom: 10px; display: flex; gap: 12px; }
    .news-card-meta i { color: var(--pks-red); }
    .news-card-body h4 { font-size: 17px; font-weight: 800; color: var(--pks-dark); line-height: 1.4; margin-bottom: 10px; }
    .news-card-body p { font-size: 14px; color: var(--pks-gray); line-height: 1.6; margin-bottom: 16px; }
    .news-card-link { font-size: 14px; font-weight: 700; color: var(--pks-red); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: 0.2s; }
    .news-card-link:hover { color: var(--pks-red-dark); transform: translateX(4px); }

    /* ================= ACHIEVEMENTS PREVIEW ================= */
    .achievements-grid-home { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-top: 35px; }
    @media (max-width: 900px) { .achievements-grid-home { grid-template-columns: 1fr; } }
    .achievement-card-home { background: #ffffff; border-radius: 14px; border: 1px solid var(--pks-border); padding: 24px; display: flex; gap: 18px; align-items: flex-start; box-shadow: 0 4px 15px rgba(0,0,0,0.04); transition: 0.3s; }
    .achievement-card-home:hover { transform: translateY(-4px); box-shadow: 0 12px 25px rgba(220, 38, 38, 0.08); border-color: var(--pks-red); }
    .achievement-trophy-icon { width: 54px; height: 54px; border-radius: 12px; background: rgba(220, 38, 38, 0.1); color: var(--pks-red); display: flex; align-items: center; justify-content: center; font-size: 26px; flex-shrink: 0; }
    .achievement-card-info h4 { font-size: 16px; font-weight: 800; color: var(--pks-dark); margin-bottom: 6px; }
    .achievement-badge-pill { display: inline-block; font-size: 11.5px; font-weight: 700; color: #ffffff; background: var(--pks-red); padding: 3px 10px; border-radius: 20px; margin-bottom: 8px; }
    .achievement-card-info p { font-size: 13.5px; color: var(--pks-gray); line-height: 1.5; margin: 0; }

    /* ================= GALLERY PREVIEW ================= */
    .gallery-preview-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-top: 35px; }
    @media (max-width: 800px) { .gallery-preview-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 500px) { .gallery-preview-grid { grid-template-columns: 1fr; } }
    .gallery-preview-item { position: relative; height: 220px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 2px solid #ffffff; }
    .gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .gallery-preview-item:hover img { transform: scale(1.1); }
    .gallery-preview-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, transparent 60%); display: flex; align-items: flex-end; padding: 20px; color: #ffffff; opacity: 1; }
    .gallery-preview-overlay p { font-size: 13.5px; font-weight: 600; margin: 0; line-height: 1.4; }

    /* ================= CTA BANNER ================= */
    .cta-pks-banner { background: linear-gradient(135deg, var(--pks-red) 0%, var(--pks-red-dark) 100%); border-radius: 20px; padding: 50px 30px; text-align: center; color: #ffffff; position: relative; overflow: hidden; border: 3px solid rgba(255,255,255,0.2); box-shadow: 0 15px 35px rgba(220, 38, 38, 0.3); }
    .cta-pks-banner h3 { font-size: 30px; font-weight: 800; margin-bottom: 14px; }
    .cta-pks-banner p { font-size: 16px; color: rgba(255,255,255,0.9); max-width: 650px; margin: 0 auto 28px auto; line-height: 1.6; }
    .btn-hero-primary i, .btn-hero-secondary i, .news-card-link i { margin-right: 4px; }
EOD;

replace_style('resources/views/frontend/layout.blade.php', $layoutStyle);
replace_style('resources/views/frontend/beranda.blade.php', $berandaStyle);
?>
