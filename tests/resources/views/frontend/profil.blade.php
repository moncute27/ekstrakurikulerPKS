@extends('frontend.layout')

@section('title', 'Profil PKS')

@section('header_banner')
<div class="page-header-banner">
    <div class="page-header-content" data-aos="fade-up">
        <span class="page-header-badge"><i class="fa-solid fa-id-card"></i> Identitas & Karakter</span>
        <h1 class="page-header-title">PROFIL EKSTRAKURIKULER PKS</h1>
        <p class="page-header-desc">
            Mengenal lebih dekat Patroli Keamanan Sekolah SMK Negeri 2 Purwakarta, visi, misi, sejarah pendirian, makna lambang, dan janji suci anggota.
        </p>
        <div class="page-header-line"></div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .profile-layout-grid {
        display: grid;
        grid-template-columns: 1.1fr 2fr;
        gap: 35px;
        align-items: flex-start;
    }
    @media (max-width: 900px) {
        .profile-layout-grid { grid-template-columns: 1fr; }
    }

    .pks-badge-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid var(--pks-border);
        padding: 35px 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(11, 30, 54, 0.05);
        position: sticky;
        top: 90px;
    }

    .pks-crest-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--pks-gold);
        box-shadow: 0 0 25px var(--pks-gold-glow);
        margin: 0 auto 20px auto;
        display: block;
    }

    .pks-badge-card h2 {
        font-size: 20px;
        font-weight: 800;
        color: var(--pks-navy);
        margin-bottom: 6px;
    }

    .pks-badge-card p {
        font-size: 13px;
        color: var(--pks-gray);
        margin-bottom: 24px;
    }

    .info-item-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 10px;
        margin-bottom: 12px;
        text-align: left;
        border: 1px solid var(--pks-border);
    }

    .info-item-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: var(--pks-navy);
        color: var(--pks-gold-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .info-item-text span {
        font-size: 11px;
        font-weight: 600;
        color: var(--pks-gray);
        display: block;
        text-transform: uppercase;
    }

    .info-item-text strong {
        font-size: 13.5px;
        color: var(--pks-navy);
    }

    /* RIGHT CONTENT */
    .profile-content-section {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid var(--pks-border);
        padding: 35px;
        box-shadow: 0 10px 30px rgba(11, 30, 54, 0.05);
        margin-bottom: 30px;
    }

    .profile-content-section h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--pks-navy);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 12px;
    }

    .profile-content-section p {
        font-size: 14.5px;
        color: #334155;
        line-height: 1.8;
        margin-bottom: 18px;
    }

    .visi-misi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }
    @media (max-width: 650px) {
        .visi-misi-grid { grid-template-columns: 1fr; }
    }

    .visi-card, .misi-card {
        padding: 24px;
        border-radius: 14px;
        background: #f8fafc;
        border: 1px solid var(--pks-border);
    }

    .visi-card h4, .misi-card h4 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .visi-card h4 { color: #1d4ed8; }
    .misi-card h4 { color: var(--pks-red); }

    .visi-card p, .misi-card p {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.7;
        margin: 0;
        white-space: pre-line;
    }

    /* 12 GERAKAN LALU LINTAS GRID */
    .traffic-move-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 20px;
    }
    @media (max-width: 768px) {
        .traffic-move-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
        .traffic-move-grid { grid-template-columns: 1fr; }
    }

    .traffic-move-item {
        background: #f8fafc;
        border: 1px solid var(--pks-border);
        border-radius: 10px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        font-weight: 600;
        color: var(--pks-navy);
    }

    .traffic-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--pks-gold);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div class="main-wrapper">
    <div class="profile-layout-grid">
        <!-- LEFT: LOGO & IDENTITY SUMMARY -->
        <div class="pks-badge-card" data-aos="fade-right">
            <img src="{{ asset($profil->logo ?? 'img/logo pks.jpeg') }}" class="pks-crest-img" alt="Logo PKS SMKN 2 Purwakarta">
            <h2>PKS SMKN 2 PURWAKARTA</h2>
            <p>Patroli Keamanan Sekolah</p>

            <div class="info-item-box">
                <div class="info-item-icon"><i class="fa-solid fa-school"></i></div>
                <div class="info-item-text">
                    <span>Sekolah</span>
                    <strong>SMKN 2 Purwakarta</strong>
                </div>
            </div>

            <div class="info-item-box">
                <div class="info-item-icon"><i class="fa-solid fa-award"></i></div>
                <div class="info-item-text">
                    <span>Bina Sinergi</span>
                    <strong>Satlantas Polres Purwakarta</strong>
                </div>
            </div>

            <div class="info-item-box">
                <div class="info-item-icon"><i class="fa-solid fa-users"></i></div>
                <div class="info-item-text">
                    <span>Status Organisasi</span>
                    <strong>Ekstrakurikuler Kedisiplinan</strong>
                </div>
            </div>

            <div class="info-item-box">
                <div class="info-item-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                <div class="info-item-text">
                    <span>Markas Komando</span>
                    <strong>Jl. Jend. A. Yani No. 98, Nagri Sakti, Kec. Purwakarta,
                         Kabupaten Purwakarta, Jawa Barat 41114</strong>
                </div>
            </div>
        </div>

        <!-- RIGHT: COMPLETE PROFILE DETAILS -->
        <div>
            <!-- DESKRIPSI UTAMA -->
            <div class="profile-content-section" data-aos="fade-up">
                <h3><i class="fa-solid fa-shield-halved" style="color: var(--pks-red);"></i> Tentang PKS SMKN 2 Purwakarta</h3>
                <p>
                    {{ $profil->isi ?? 'Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta merupakan wadah organisasi kesiswaan yang bertugas menjaga keamanan, ketertiban, dan kedisiplinan di lingkungan sekolah serta mengatur kelancaran lalu lintas di sekitar gerbang sekolah saat jam masuk dan pulang sekolah.' }}
                </p>
                <p>
                    Melalui bimbingan langsung dari pihak sekolah dan jajaran kepolisian lalu lintas, para anggota PKS dilatih dalam Peraturan Baris Berbaris (PBB), mental kepemimpinan, penanganan situasi darurat, etika komunikasi, dan 12 gerakan dasar pengaturan lalu lintas.
                </p>
            </div>

            <!-- VISI & MISI -->
            <div class="profile-content-section" data-aos="fade-up" data-aos-delay="100">
                <h3><i class="fa-solid fa-compass" style="color: var(--pks-gold);"></i> Visi & Misi Organisasi</h3>
                <div class="visi-misi-grid">
                    <div class="visi-card">
                        <h4><i class="fa-solid fa-eye"></i> Visi</h4>
                        <p>{{ $profil->visi ?? 'Terwujudnya kader Patroli Keamanan Sekolah yang berkarakter disiplin, berakhlak mulia, berjiwa pemimpin, serta berkomitmen tinggi dalam mewujudkan lingkungan SMKN 2 Purwakarta yang aman, tertib, dan kondusif.' }}</p>
                    </div>

                    <div class="misi-card">
                        <h4><i class="fa-solid fa-bullseye"></i> Misi</h4>
                        <p>{{ $profil->misi ?? "1. Menanamkan kedisiplinan dan kesadaran hukum berlalu lintas bagi seluruh siswa.\n2. Melaksanakan pengamanan dan penertiban lingkungan sekolah secara konsisten.\n3. Membangun solidaritas, mental kepemimpinan, dan kecakapan baris-berbaris (PBB).\n4. Menjalin kemitraan sinergis dengan pihak kepolisian dan masyarakat." }}</p>
                    </div>
                </div>
            </div>

            <!-- SEJARAH -->
            @if(!empty($profil->sejarah))
                <div class="profile-content-section" data-aos="fade-up" data-aos-delay="200">
                    <h3><i class="fa-solid fa-landmark" style="color: #6366f1;"></i> Sejarah Singkat</h3>
                    <p>{{ $profil->sejarah }}</p>
                </div>
            @endif

            <!-- 12 GERAKAN LALU LINTAS -->
            <div class="profile-content-section" data-aos="fade-up" data-aos-delay="300">
                <h3><i class="fa-solid fa-traffic-light" style="color: var(--pks-gold);"></i> 12 Gerakan Dasar Pengaturan Lalu Lintas PKS</h3>
                <p>Setiap anggota PKS SMKN 2 Purwakarta dilatih dan diuji kemampuannya dalam memperagakan 12 isyarat pengaturan lalu lintas:</p>

                <div class="traffic-move-grid">
                    <div class="traffic-move-item"><span class="traffic-num">1</span> Stop Semua Jurusan</div>
                    <div class="traffic-move-item"><span class="traffic-num">2</span> Stop Arah Depan</div>
                    <div class="traffic-move-item"><span class="traffic-num">3</span> Stop Arah Belakang</div>
                    <div class="traffic-move-item"><span class="traffic-num">4</span> Stop Depan & Belakang</div>
                    <div class="traffic-move-item"><span class="traffic-num">5</span> Stop Kiri</div>
                    <div class="traffic-move-item"><span class="traffic-num">6</span> Stop Kanan</div>
                    <div class="traffic-move-item"><span class="traffic-num">7</span> Jalankan Arah Kanan</div>
                    <div class="traffic-move-item"><span class="traffic-num">8</span> Jalankan Arah Kiri</div>
                    <div class="traffic-move-item"><span class="traffic-num">9</span> Percepat Arah Kanan</div>
                    <div class="traffic-move-item"><span class="traffic-num">10</span> Percepat Arah Kiri</div>
                    <div class="traffic-move-item"><span class="traffic-num">11</span> Perlambat Arah Depan</div>
                    <div class="traffic-move-item"><span class="traffic-num">12</span> Perlambat Arah Belakang</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
