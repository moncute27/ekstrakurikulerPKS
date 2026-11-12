@extends('frontend.layout')

@section('title', 'Beranda')

@push('styles')
<style>
    /* ================= HERO SECTION ================= */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 120px 24px 80px 24px;
        background: linear-gradient(135deg, #b91c1c(11, 30, 54, 0.94) 0%, rgba(7, 19, 34, 0.96) 100%);
        overflow: hidden;
    }

    .hero-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: 0.28;
        filter: saturate(1.1);
        z-index: 1;
    }

    .hero-decor-shape {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: #f8fafc;
        clip-path: ellipse(55% 100% at 50% 100%);
        z-index: 3;
    }

    .hero-container {
        position: relative;
        z-index: 2;
        max-width: 960px;
        text-align: center;
        color: #ffffff;
    }

    .hero-badge-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(217, 119, 6, 0.22);
        color: var(--pks-gold-light);
        border: 1.5px solid rgba(217, 119, 6, 0.5);
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 12.5px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 24px;
        box-shadow: 0 0 15px rgba(217, 119, 6, 0.3);
    }

    .hero-crest {
        width: 95px;
        height: 95px;
        border-radius: 50%;
        margin: 0 auto 20px auto;
        border: 3px solid var(--pks-gold);
        box-shadow: 0 0 25px rgba(217, 119, 6, 0.5);
        display: block;
        object-fit: cover;
    }

    .hero-title {
        font-size: 44px;
        font-weight: 900;
        line-height: 1.15;
        letter-spacing: -0.5px;
        margin-bottom: 18px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
    }

    .hero-title span {
        background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-title .highlight {
        color: var(--pks-gold-light);
        -webkit-text-fill-color: var(--pks-gold-light);
        display: block;
        font-size: 32px;
        margin-top: 6px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .hero-desc {
        font-size: 16.5px;
        color: #e2e8f0;
        max-width: 720px;
        margin: 0 auto 35px auto;
        line-height: 1.7;
        font-weight: 400;
    }

    .hero-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 28px;
        background: linear-gradient(135deg, var(--pks-red) 0%, #991b1b 100%);
        color: #ffffff;
        text-decoration: none;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 6px 20px rgba(197, 22, 29, 0.4);
        transition: all 0.25s;
    }
    .btn-hero-primary:hover {
        background: #a51319;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(197, 22, 29, 0.5);
    }

    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 26px;
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        text-decoration: none;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: all 0.25s;
    }
    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 30px; }
        .hero-title .highlight { font-size: 24px; }
        .hero-desc { font-size: 14px; }
    }

    /* ================= COUNTERS SECTION ================= */
    .counters-section {
        position: relative;
        z-index: 10;
        margin-top: -50px;
        padding: 0 24px 60px 24px;
    }

    .counters-grid {
        max-width: 1140px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    @media (max-width: 992px) {
        .counters-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 540px) {
        .counters-grid { grid-template-columns: 1fr; }
    }

    .counter-card {
        background: #ffffff;
        padding: 24px 20px;
        border-radius: 16px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 10px 30px  #b91c1c;(11, 30, 54, 0.06);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: 0.3s;
    }
    .counter-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px #b91c1c;(11, 30, 54, 0.12);
        border-color: var(--pks-gold);
    }

    .counter-icon {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .counter-icon.blue { background: #eff6ff; color: #1d4ed8; }
    .counter-icon.gold { background: #fef3c7; color: #b45309; }
    .counter-icon.green { background: #ecfdf5; color: #047857; }
    .counter-icon.red { background: #fef2f2; color: #b91c1c; }

    .counter-info h3 {
        font-size: 28px;
        font-weight: 800;
        color: var(--pks-navy);
        line-height: 1;
        margin-bottom: 4px;
    }

    .counter-info p {
        font-size: 12.5px;
        color: var(--pks-gray);
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ================= SECTION COMMON ================= */
    .home-section {
        padding: 70px 24px;
    }

    .home-section.alt-bg {
        background: #f1f5f9;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* ================= LEADERSHIP / SAMBUTAN ================= */
    .leaders-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 40px;
    }
    @media (max-width: 800px) {
        .leaders-grid { grid-template-columns: 1fr; }
    }

    .leader-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid var(--pks-border);
        padding: 28px;
        display: flex;
        gap: 22px;
        align-items: center;
        box-shadow: 0 4px 20px #b91c1c;(0,0,0,0.02);
        transition: 0.3s;
    }
    .leader-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px #b91c1c;(0,0,0,0.06);
    }

    .leader-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--pks-gold);
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25);
    }

    .leader-info h4 {
        font-size: 17px;
        font-weight: 700;
        color: var(--pks-navy);
        margin-bottom: 4px;
    }

    .leader-role {
        display: inline-block;
        background: rgba(197, 22, 29, 0.1);
        color: var(--pks-red);
        font-size: 11px;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 20px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .leader-quote {
        font-size: 13px;
        color: var(--pks-gray);
        font-style: italic;
        line-height: 1.5;
    }

    /* ================= CORE VALUES ================= */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 40px;
    }
    @media (max-width: 992px) {
        .values-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 540px) {
        .values-grid { grid-template-columns: 1fr; }
    }

    .value-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 28px 22px;
        text-align: center;
        border: 1px solid var(--pks-border);
        transition: 0.3s;
    }
    .value-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(11, 30, 54, 0.08);
        border-color: var(--pks-gold);
    }

    .value-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pks-navy) 0%, var(--pks-navy-light) 100%);
        color: var(--pks-gold-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 18px auto;
        box-shadow: 0 6px 15px rgba(11, 30, 54, 0.2);
    }

    .value-box h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--pks-navy);
        margin-bottom: 8px;
    }

    .value-box p {
        font-size: 13px;
        color: var(--pks-gray);
        line-height: 1.5;
        margin: 0;
    }

    /* ================= NEWS CARDS ================= */
    .news-grid-home {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 35px;
    }
    @media (max-width: 900px) {
        .news-grid-home { grid-template-columns: 1fr; }
    }

    .news-card-item {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--pks-border);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        transition: 0.3s;
    }
    .news-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    }

    .news-card-img-wrap {
        height: 190px;
        width: 100%;
        overflow: hidden;
        position: relative;
    }
    .news-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .news-card-item:hover .news-card-img-wrap img {
        transform: scale(1.06);
    }

    .news-card-cat {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: var(--pks-red);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .news-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .news-card-meta {
        font-size: 11.5px;
        color: var(--pks-gray);
        margin-bottom: 8px;
        display: flex;
        gap: 12px;
    }

    .news-card-body h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--pks-navy);
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .news-card-body p {
        font-size: 13px;
        color: var(--pks-gray);
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .news-card-link {
        font-size: 13px;
        font-weight: 700;
        color: var(--pks-red);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }
    .news-card-link:hover {
        color: var(--pks-navy);
        transform: translateX(4px);
    }

    /* ================= ACHIEVEMENTS PREVIEW ================= */
    .achievements-grid-home {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 35px;
    }
    @media (max-width: 900px) {
        .achievements-grid-home { grid-template-columns: 1fr; }
    }

    .achievement-card-home {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--pks-border);
        padding: 24px;
        display: flex;
        gap: 18px;
        align-items: flex-start;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: 0.3s;
    }
    .achievement-card-home:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(217, 119, 6, 0.1);
        border-color: var(--pks-gold);
    }

    .achievement-trophy-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: #fef3c7;
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .achievement-card-info h4 {
        font-size: 15.5px;
        font-weight: 700;
        color: var(--pks-navy);
        margin-bottom: 4px;
    }

    .achievement-badge-pill {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        color: #1e40af;
        background: #eff6ff;
        padding: 2px 8px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .achievement-card-info p {
        font-size: 12.5px;
        color: var(--pks-gray);
        line-height: 1.4;
        margin: 0;
    }

    /* ================= GALLERY PREVIEW ================= */
    .gallery-preview-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 35px;
    }
    @media (max-width: 800px) {
        .gallery-preview-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 500px) {
        .gallery-preview-grid { grid-template-columns: 1fr; }
    }

    .gallery-preview-item {
        position: relative;
        height: 200px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }

    .gallery-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .gallery-preview-item:hover img {
        transform: scale(1.08);
    }

    .gallery-preview-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(11, 30, 54, 0.85) 0%, transparent 60%);
        display: flex;
        align-items: flex-end;
        padding: 16px;
        color: #ffffff;
        opacity: 0.9;
    }

    .gallery-preview-overlay p {
        font-size: 12.5px;
        font-weight: 600;
        margin: 0;
        line-height: 1.3;
    }

    /* ================= CTA BANNER ================= */
    .cta-pks-banner {
        background: linear-gradient(135deg, var(--pks-navy) 0%, var(--pks-navy-light) 100%);
        border-radius: 20px;
        padding: 50px 30px;
        text-align: center;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        border: 2px solid var(--pks-gold);
        box-shadow: 0 15px 35px rgba(11, 30, 54, 0.2);
    }

    .cta-pks-banner h3 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .cta-pks-banner p {
        font-size: 15px;
        color: #cbd5e1;
        max-width: 650px;
        margin: 0 auto 28px auto;
    }
</style>
@endpush

@section('content')

<!-- ================= HERO SECTION ================= -->
<section class="hero-section">
    <img src="{{ asset('img/poto pkss.jpg') }}" class="hero-bg-img" alt="Background PKS SMKN 2 Purwakarta">
    <div class="hero-decor-shape"></div>

    <div class="hero-container" data-aos="fade-up">
        <img src="{{ asset('img/logo pks.jpeg') }}" class="hero-crest" alt="Lambang PKS">

        <div class="hero-badge-tag">
            <i class="fa-solid fa-shield-halved"></i> Patroli Keamanan Sekolah &bull; Disiplin &bull; Tanggap &bull; Teladan
        </div>

        <h1 class="hero-title">
            <span>EKSTRAKURIKULER PKS</span>
            <span class="highlight">SMKN 2 PURWAKARTA</span>
        </h1>

        <p class="hero-desc">
            Membentuk insan pelajar yang berkarakter kokoh, berdisiplin tinggi, bertanggung jawab, dan mengabdi sebagai pelopor keselamatan berlalu lintas serta ketertiban lingkungan sekolah.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('profil') }}" class="btn-hero-primary">
                <i class="fa-solid fa-id-card"></i> Jelajahi Profil PKS
            </a>
            <a href="{{ route('berita') }}" class="btn-hero-secondary">
                <i class="fa-solid fa-newspaper"></i> Warta Kegiatan Terbaru
            </a>
        </div>
    </div>
</section>

<!-- ================= COUNTERS SECTION ================= -->
<section class="counters-section">
    <div class="counters-grid">
        <div class="counter-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="counter-icon blue">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="counter-info">
                <h3>{{ $totalAnggota }}</h3>
                <p>Anggota Aktif</p>
            </div>
        </div>

        <div class="counter-card" data-aos="zoom-in" data-aos-delay="200">
            <div class="counter-icon gold">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="counter-info">
                <h3>{{ $totalPrestasi }}</h3>
                <p>Prestasi Juara</p>
            </div>
        </div>

        <div class="counter-card" data-aos="zoom-in" data-aos-delay="300">
            <div class="counter-icon green">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="counter-info">
                <h3>{{ $totalAgenda }}</h3>
                <p>Agenda Patroli</p>
            </div>
        </div>

        <div class="counter-card" data-aos="zoom-in" data-aos-delay="400">
            <div class="counter-icon red">
                <i class="fa-solid fa-camera"></i>
            </div>
            <div class="counter-info">
                <h3>{{ $totalGaleri }}</h3>
                <p>Dokumentasi Foto</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= SAMBUTAN & KEPEMIMPINAN ================= -->
<section class="home-section">
    <div class="section-container">
        <div class="section-title-wrap" data-aos="fade-up">
            <span class="section-tag"><i class="fa-solid fa-award"></i> Kepemimpinan PKS</span>
            <h2 class="section-title">Bimbingan & Keteladanan</h2>
            <div class="section-divider"></div>
        </div>

        <div class="leaders-grid">
            <div class="leader-card" data-aos="fade-right" data-aos-delay="100">
                <img src="{{ asset('img/pembina.jpeg') }}" class="leader-photo" alt="Pembina PKS">
                <div class="leader-info">
                    <span class="leader-role">Pembina PKS</span>
                    <h4>{{ $pembina->nama_pengurus ?? 'Lilis Aisyah Yuniarti, S.Pd.' }}</h4>
                    <p class="leader-quote">
                        "Kedisiplinan adalah jembatan emas menuju kesuksesan. PKS mengajarkan bahwa ketertiban berawal dari komitmen diri sendiri."
                    </p>
                </div>
            </div>

            <div class="leader-card" data-aos="fade-left" data-aos-delay="200">
                <img src="{{ asset('img/pelatih.jpeg') }}" class="leader-photo" alt="Pelatih PKS">
                <div class="leader-info">
                    <span class="leader-role">Pelatih PKS</span>
                    <h4>{{ $pelatih->nama_pengurus ?? 'Lutfiah Aprilina' }}</h4>
                    <p class="leader-quote">
                        "Latihan keras, kekompakan barisan, dan jiwa korsa yang suci menghasilkan kader penjaga ketertiban yang berwibawa."
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= CORE PILLARS ================= -->
<section class="home-section alt-bg">
    <div class="section-container">
        <div class="section-title-wrap" data-aos="fade-up">
            <span class="section-tag"><i class="fa-solid fa-shield"></i> Nilai Luhur</span>
            <h2 class="section-title">4 Pilar Utama PKS</h2>
            <div class="section-divider"></div>
        </div>

        <div class="values-grid">
            <div class="value-box" data-aos="fade-up" data-aos-delay="100">
                <div class="value-icon-circle">
                    <i class="fa-solid fa-stopwatch-20"></i>
                </div>
                <h4>Disiplin Presisi</h4>
                <p>Tepat waktu, taat aturan, dan konsisten dalam menjalankan tugas pengamanan sekolah.</p>
            </div>

            <div class="value-box" data-aos="fade-up" data-aos-delay="200">
                <div class="value-icon-circle">
                    <i class="fa-solid fa-traffic-light"></i>
                </div>
                <h4>Tertib Berlalu Lintas</h4>
                <p>Menguasai 12 gerakan dasar pengaturan lalu lintas demi keselamatan seluruh warga sekolah.</p>
            </div>

            <div class="value-box" data-aos="fade-up" data-aos-delay="300">
                <div class="value-icon-circle">
                    <i class="fa-solid fa-person-military-pointing"></i>
                </div>
                <h4>Kepemimpinan Tangguh</h4>
                <p>Menjadi teladan sikap dan etika bagi seluruh rekan pelajar di dalam maupun luar kelas.</p>
            </div>

            <div class="value-box" data-aos="fade-up" data-aos-delay="400">
                <div class="value-icon-circle">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h4>Solidaritas & Korsa</h4>
                <p>Saling menjaga, saling mendukung, dan menjunjung tinggi rasa persaudaraan korps PKS.</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= BERITA TERBARU ================= -->
<section class="home-section">
    <div class="section-container">
        <div class="section-title-wrap" data-aos="fade-up">
            <span class="section-tag"><i class="fa-solid fa-newspaper"></i> Kabar Terkini</span>
            <h2 class="section-title">Warta & Informasi PKS</h2>
            <div class="section-divider"></div>
        </div>

        <div class="news-grid-home">
            @forelse($beritaTerbaru as $index => $b)
                <div class="news-card-item" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="news-card-img-wrap">
                        @if($b->foto_berita && file_exists(public_path($b->foto_berita)))
                            <img src="{{ asset($b->foto_berita) }}" alt="{{ $b->judul_berita }}">
                        @else
                            <img src="{{ asset('img/smk2.jpeg') }}" alt="{{ $b->judul_berita }}">
                        @endif
                        <span class="news-card-cat">{{ $b->kategori }}</span>
                    </div>
                    <div class="news-card-body">
                        <div>
                            <div class="news-card-meta">
                                <span><i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime($b->tanggal)) }}</span>
                                <span><i class="fa-regular fa-user"></i> {{ $b->penulis }}</span>
                            </div>
                            <h4>{{ $b->judul_berita }}</h4>
                            <p>{{ Str::limit($b->isi_berita, 100) }}</p>
                        </div>
                        <a href="{{ route('berita') }}?q={{ urlencode($b->judul_berita) }}" class="news-card-link">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: var(--pks-gray);">Belum ada berita terbaru.</p>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 35px;" data-aos="fade-up">
            <a href="{{ route('berita') }}" class="btn-hero-primary" style="background: var(--pks-navy);">
                <i class="fa-solid fa-newspaper"></i> Lihat Semua Berita &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ================= PRESTASI UNGGULAN ================= -->
<section class="home-section alt-bg">
    <div class="section-container">
        <div class="section-title-wrap" data-aos="fade-up">
            <span class="section-tag"><i class="fa-solid fa-trophy"></i> Kebanggaan Korps</span>
            <h2 class="section-title">Prestasi & Penghargaan</h2>
            <div class="section-divider"></div>
        </div>

        <div class="achievements-grid-home">
            @forelse($prestasiUnggulan as $index => $p)
                <div class="achievement-card-home" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="achievement-trophy-icon">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="achievement-card-info">
                        <span class="achievement-badge-pill">{{ $p->tingkat_lomba }} &bull; {{ $p->juara }}</span>
                        <h4>{{ $p->nama }}</h4>
                        <p>{{ Str::limit($p->deskripsi, 85) }}</p>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: var(--pks-gray);">Belum ada data prestasi.</p>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 35px;" data-aos="fade-up">
            <a href="{{ route('prestasi') }}" class="btn-hero-primary" style="background: var(--pks-red);">
                <i class="fa-solid fa-award"></i> Lihat Seluruh Prestasi &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ================= DOKUMENTASI GALERI ================= -->
<section class="home-section">
    <div class="section-container">
        <div class="section-title-wrap" data-aos="fade-up">
            <span class="section-tag"><i class="fa-solid fa-camera"></i> Rekam Jejak</span>
            <h2 class="section-title">Dokumentasi Kegiatan</h2>
            <div class="section-divider"></div>
        </div>

        <div class="gallery-preview-grid">
            @forelse($galeriCuplikan as $index => $g)
                <div class="gallery-preview-item" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 80 }}">
                    <img src="{{ asset($g->foto) }}" alt="{{ $g->judul }}">
                    <div class="gallery-preview-overlay">
                        <p><i class="fa-solid fa-camera" style="color: var(--pks-gold-light); margin-right: 6px;"></i> {{ $g->judul }}</p>
                    </div>
                </div>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: var(--pks-gray);">Belum ada foto kegiatan.</p>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 35px;" data-aos="fade-up">
            <a href="{{ route('galeri') }}" class="btn-hero-primary" style="background: var(--pks-navy);">
                <i class="fa-solid fa-images"></i> Buka Galeri Lengkap &rarr;
            </a>
        </div>
    </div>
</section>

<!-- ================= CTA BANNER ================= -->
<section class="home-section" style="padding-top: 0;">
    <div class="section-container">
        <div class="cta-pks-banner" data-aos="zoom-in">
            <i class="fa-solid fa-shield-halved" style="font-size: 42px; color: var(--pks-gold-light); margin-bottom: 15px; display: inline-block;"></i>
            <h3>Siap Menjadi Bagian dari Korps PKS?</h3>
            <p>
                Bergabunglah bersama Patroli Keamanan Sekolah SMKN 2 Purwakarta. Bangun mental kepemimpinan tangguh, disiplin, dan persaudaraan tanpa batas!
            </p>
            <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('anggota') }}" class="btn-hero-primary" style="background: var(--pks-gold); color: var(--pks-navy-dark);">
                    <i class="fa-solid fa-users"></i> Lihat Anggota Aktif
                </a>
                <a href="{{ route('profil') }}" class="btn-hero-secondary">
                    <i class="fa-solid fa-circle-info"></i> Pelajari Janji & Sapta PKS
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
