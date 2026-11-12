@extends('frontend.layout')

@section('title', 'Struktur Organisasi')

@section('header_banner')
<div class="page-header-banner" style="background: linear-gradient(135deg, #0b1e36 0%, #1a3a5c 50%, #0b1e36 100%);">
    <div class="page-header-content">
        <span class="page-header-badge" data-aos="fade-down" data-aos-delay="100">
            <i class="fas fa-sitemap me-2"></i>Struktur Organisasi
        </span>
        <h1 class="page-header-title" data-aos="fade-up" data-aos-delay="200">
            Kepengurusan PKS<br><span style="color:#f59e0b;">SMKN 2 Purwakarta</span>
        </h1>
        <p class="page-header-sub" data-aos="fade-up" data-aos-delay="300">
            Mengenal lebih dekat para pengurus yang berdedikasi dalam menjalankan roda organisasi PKS
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-warning">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Organisasi</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main-wrapper">

    {{-- ==================== PEMBINA & PELATIH ==================== --}}
    <section class="py-5 mb-3">
        <div class="container">
            <div class="section-title-wrap text-center mb-5" data-aos="fade-up">
                <span class="section-tag"><i class="fas fa-medal me-1"></i>Pembimbing</span>
                <h2 class="section-title">Pembina & Pelatih</h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-muted mt-2">Sosok yang membimbing dan melatih seluruh anggota PKS</p>
            </div>

            <div class="row justify-content-center g-4">
                {{-- Pembina --}}
                @if($pembina)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="org-card advisor-card h-100">
                        <div class="org-card-badge">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <div class="org-avatar-wrap">
                            @if($pembina->foto)
                                <img src="{{ asset($pembina->foto) }}" alt="{{ $pembina->nama }}" class="org-avatar">
                            @else
                                <div class="org-avatar-placeholder bg-warning">
                                    <i class="fas fa-user-tie fa-2x text-dark"></i>
                                </div>
                            @endif
                            <div class="org-avatar-ring advisor-ring"></div>
                        </div>
                        <div class="org-card-body text-center">
                            <span class="org-jabatan-badge advisor-badge">
                                <i class="fas fa-star me-1"></i>{{ $pembina->jabatan }}
                            </span>
                            <h4 class="org-name mt-2">{{ $pembina->nama }}</h4>
                            @if($pembina->nip)
                                <p class="org-nip"><i class="fas fa-id-badge me-1 text-warning"></i>NIP: {{ $pembina->nip }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pelatih --}}
                @if($pelatih)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="org-card trainer-card h-100">
                        <div class="org-card-badge" style="background:var(--pks-red);">
                            <i class="fas fa-whistle"></i>
                        </div>
                        <div class="org-avatar-wrap">
                            @if($pelatih->foto)
                                <img src="{{ asset($pelatih->foto) }}" alt="{{ $pelatih->nama }}" class="org-avatar">
                            @else
                                <div class="org-avatar-placeholder bg-danger">
                                    <i class="fas fa-user-graduate fa-2x text-white"></i>
                                </div>
                            @endif
                            <div class="org-avatar-ring trainer-ring"></div>
                        </div>
                        <div class="org-card-body text-center">
                            <span class="org-jabatan-badge trainer-badge">
                                <i class="fas fa-chalkboard-teacher me-1"></i>{{ $pelatih->jabatan }}
                            </span>
                            <h4 class="org-name mt-2">{{ $pelatih->nama }}</h4>
                            @if($pelatih->nip)
                                <p class="org-nip"><i class="fas fa-id-badge me-1 text-danger"></i>NIP: {{ $pelatih->nip }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Connector Line --}}
    <div class="org-connector" data-aos="fade-down">
        <div class="org-connector-line"></div>
        <div class="org-connector-diamond"><i class="fas fa-chevron-down"></i></div>
    </div>

    {{-- ==================== KETUA UMUM ==================== --}}
    @if($ketua)
    <section class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="org-card ketua-card">
                        <div class="org-card-ribbon">
                            <span>Ketua Umum</span>
                        </div>
                        <div class="org-avatar-wrap">
                            @if($ketua->foto)
                                <img src="{{ asset($ketua->foto) }}" alt="{{ $ketua->nama }}" class="org-avatar org-avatar-lg">
                            @else
                                <div class="org-avatar-placeholder org-avatar-placeholder-lg" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
                                    <i class="fas fa-crown fa-3x text-dark"></i>
                                </div>
                            @endif
                            <div class="org-avatar-ring ketua-ring"></div>
                        </div>
                        <div class="org-card-body text-center">
                            <span class="org-jabatan-badge ketua-badge">
                                <i class="fas fa-crown me-1"></i>{{ $ketua->jabatan }}
                            </span>
                            <h3 class="org-name org-name-lg mt-2">{{ $ketua->nama }}</h3>
                            @if($ketua->kelas)
                                <p class="org-kelas"><i class="fas fa-graduation-cap me-1 text-warning"></i>{{ $ketua->kelas }}</p>
                            @endif
                            @if($ketua->nis)
                                <p class="org-nip"><i class="fas fa-id-card me-1 text-warning"></i>NIS: {{ $ketua->nis }}</p>
                            @endif
                        </div>
                        <div class="ketua-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Connector Line --}}
    <div class="org-connector" data-aos="fade-down">
        <div class="org-connector-line"></div>
        <div class="org-connector-diamond"><i class="fas fa-chevron-down"></i></div>
    </div>
    @endif

    {{-- ==================== PENGURUS / BPH ==================== --}}
    @if($pengurus && $pengurus->count() > 0)
    <section class="py-5">
        <div class="container">
            <div class="section-title-wrap text-center mb-5" data-aos="fade-up">
                <span class="section-tag"><i class="fas fa-users me-1"></i>Kepengurusan</span>
                <h2 class="section-title">Badan Pengurus Harian</h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-muted mt-2">Tim pengurus yang menjalankan program kerja PKS</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($pengurus as $index => $p)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                    <div class="org-card pengurus-card h-100">
                        <div class="org-avatar-wrap">
                            @if($p->foto)
                                <img src="{{ asset($p->foto) }}" alt="{{ $p->nama }}" class="org-avatar">
                            @else
                                <div class="org-avatar-placeholder">
                                    <i class="fas fa-user fa-2x text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="org-card-body text-center">
                            <span class="org-jabatan-badge pengurus-badge">
                                {{ $p->jabatan }}
                            </span>
                            <h5 class="org-name mt-2">{{ $p->nama }}</h5>
                            @if($p->kelas)
                                <p class="org-kelas"><i class="fas fa-book me-1 text-muted"></i>{{ $p->kelas }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ==================== STATISTIK ==================== --}}
    <section class="py-5 bg-pks-dark rounded-4 mx-3 mx-md-0 mb-5" data-aos="fade-up">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                        <div class="stat-icon-lg mb-3">
                            <i class="fas fa-users-gear fa-2x text-warning"></i>
                        </div>
                        <h3 class="text-white fw-bold fs-1 mb-0">{{ ($pengurus ? $pengurus->count() : 0) + ($ketua ? 1 : 0) }}</h3>
                        <p class="text-white-50 mb-0">Total Pengurus Aktif</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                        <div class="stat-icon-lg mb-3">
                            <i class="fas fa-calendar-check fa-2x text-warning"></i>
                        </div>
                        <h3 class="text-white fw-bold fs-1 mb-0">{{ date('Y') - 2010 }}</h3>
                        <p class="text-white-50 mb-0">Tahun Berdiri</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stat-icon-lg mb-3">
                            <i class="fas fa-trophy fa-2x text-warning"></i>
                        </div>
                        <h3 class="text-white fw-bold fs-1 mb-0">50+</h3>
                        <p class="text-white-50 mb-0">Prestasi Diraih</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
/* ===== ORG CARD BASE ===== */
.org-card {
    background: #fff;
    border-radius: 18px;
    padding: 2rem 1.5rem 1.5rem;
    box-shadow: 0 4px 20px rgba(11,30,54,0.1);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.org-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 36px rgba(11,30,54,0.2);
}
.org-card-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--pks-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 0.9rem;
}

/* ===== AVATAR ===== */
.org-avatar-wrap {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 1rem;
}
.org-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--pks-gold);
    position: relative;
    z-index: 2;
}
.org-avatar-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--pks-navy);
    border: 4px solid var(--pks-gold);
    position: relative;
    z-index: 2;
}
.org-avatar-ring {
    position: absolute;
    top: -6px; left: -6px;
    width: 112px;
    height: 112px;
    border-radius: 50%;
    border: 2px dashed;
    animation: spin 20s linear infinite;
    z-index: 1;
}
.advisor-ring { border-color: var(--pks-gold); }
.trainer-ring { border-color: var(--pks-red); }
.ketua-ring { border-color: var(--pks-gold); animation-direction: reverse; }

.org-avatar-lg { width: 120px; height: 120px; }
.org-avatar-placeholder-lg { width: 120px; height: 120px; }
.org-avatar-wrap:has(.org-avatar-lg) {
    width: 120px;
    height: 120px;
}

/* ===== JABATAN BADGE ===== */
.org-jabatan-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 0.78rem;
    font-weight: 600;
}
.advisor-badge { background: #fef3c7; color: #92400e; }
.trainer-badge { background: #fee2e2; color: #991b1b; }
.ketua-badge { background: linear-gradient(135deg, #d97706, #f59e0b); color: #fff; }
.pengurus-badge { background: #e0e7ff; color: #3730a3; }

/* ===== CARD VARIANTS ===== */
.advisor-card { border-top: 4px solid var(--pks-gold); }
.trainer-card { border-top: 4px solid var(--pks-red); }
.ketua-card {
    border: 3px solid var(--pks-gold);
    background: linear-gradient(to bottom, #fffbeb, #fff);
}
.pengurus-card { border-top: 3px solid var(--pks-navy); }

/* ===== KETUA RIBBON ===== */
.org-card-ribbon {
    position: absolute;
    top: 0; left: 0; right: 0;
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #fff;
    text-align: center;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 5px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.ketua-glow {
    position: absolute;
    bottom: -30px; left: 50%;
    transform: translateX(-50%);
    width: 80px; height: 60px;
    background: rgba(245,158,11,0.2);
    border-radius: 50%;
    filter: blur(20px);
    pointer-events: none;
}

/* ===== TEXT ===== */
.org-name { color: var(--pks-navy); font-weight: 700; margin-bottom: 4px; }
.org-name-lg { font-size: 1.3rem; }
.org-nip, .org-kelas { color: #6b7280; font-size: 0.82rem; margin-bottom: 2px; }

/* ===== CONNECTOR ===== */
.org-connector {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
    margin: 0;
}
.org-connector-line {
    width: 2px;
    height: 40px;
    background: linear-gradient(to bottom, var(--pks-gold), var(--pks-navy));
}
.org-connector-diamond {
    width: 32px; height: 32px;
    background: var(--pks-navy);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--pks-gold);
    font-size: 0.75rem;
}

/* ===== STATS ===== */
.bg-pks-dark { background: var(--pks-navy); }
.stat-icon-lg {
    width: 70px; height: 70px;
    background: rgba(245,158,11,0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
@endsection
