@extends('frontend.layout')

@section('title', 'Berita & Informasi')

@section('header_banner')
<div class="page-header-banner" style="background: linear-gradient(135deg, #0b1e36 0%, #1a3a5c 50%, #0b1e36 100%);">
    <div class="page-header-content">
        <span class="page-header-badge" data-aos="fade-down" data-aos-delay="100">
            <i class="fas fa-newspaper me-2"></i>Berita
        </span>
        <h1 class="page-header-title" data-aos="fade-up" data-aos-delay="200">
            Berita & <span style="color:#f59e0b;">Informasi</span>
        </h1>
        <p class="page-header-sub" data-aos="fade-up" data-aos-delay="300">
            Update terbaru seputar kegiatan, prestasi, dan informasi PKS SMKN 2 Purwakarta
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-warning">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Berita</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main-wrapper">

    {{-- ==================== FILTER & SEARCH BAR ==================== --}}
    <section class="py-4">
        <div class="container">
            <div class="row align-items-center g-3" data-aos="fade-up">
                {{-- Category Filter Pills --}}
                <div class="col-lg-8">
                    <div class="filter-pills-container">
                        <a href="{{ route('berita') }}"
                           class="filter-pill {{ !$kategoriAktif ? 'active' : '' }}">
                            <i class="fas fa-border-all me-1"></i>Semua
                        </a>
                        @foreach($kategoriList as $kat)
                        <a href="{{ route('berita', ['kategori' => $kat, 'q' => $q]) }}"
                           class="filter-pill {{ $kategoriAktif == $kat ? 'active' : '' }}">
                            @php
                                $icon = match($kat) {
                                    'Kegiatan' => 'fa-calendar-star',
                                    'Latihan' => 'fa-dumbbell',
                                    'Prestasi' => 'fa-trophy',
                                    'Pengumuman' => 'fa-bullhorn',
                                    default => 'fa-tag',
                                };
                            @endphp
                            <i class="fas {{ $icon }} me-1"></i>{{ $kat }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Search Form --}}
                <div class="col-lg-4">
                    <form action="{{ route('berita') }}" method="GET" class="search-form-wrap">
                        @if($kategoriAktif)
                            <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="q" value="{{ $q }}"
                                   class="form-control berita-search-input"
                                   placeholder="Cari berita...">
                            <button class="btn btn-pks-gold" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Active Filter Info --}}
            @if($kategoriAktif || $q)
            <div class="active-filter-info mt-3" data-aos="fade-up">
                <i class="fas fa-filter me-2 text-warning"></i>
                Menampilkan hasil
                @if($kategoriAktif) untuk kategori <span class="badge bg-warning text-dark">{{ $kategoriAktif }}</span> @endif
                @if($q) dengan kata kunci <span class="badge bg-navy text-white">"{{ $q }}"</span> @endif
                <a href="{{ route('berita') }}" class="btn btn-sm btn-outline-secondary ms-2">
                    <i class="fas fa-times me-1"></i>Reset
                </a>
            </div>
            @endif
        </div>
    </section>

    {{-- ==================== NEWS GRID ==================== --}}
    <section class="pb-5">
        <div class="container">
            @if($berita->count() > 0)

            {{-- Featured / First Article (if no filter) --}}
            @if(!$kategoriAktif && !$q && $berita->currentPage() == 1 && $berita->count() > 0)
            @php $featured = $berita->first(); @endphp
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12">
                    <div class="berita-featured-card">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="berita-featured-img-wrap">
                                    @if($featured->foto)
                                        <img src="{{ asset($featured->foto) }}" alt="{{ $featured->judul }}" class="berita-featured-img">
                                    @else
                                        <div class="berita-img-placeholder">
                                            <i class="fas fa-newspaper fa-4x text-white-50"></i>
                                        </div>
                                    @endif
                                    <div class="berita-featured-label">
                                        <i class="fas fa-fire me-1"></i>Terbaru
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="berita-featured-body">
                                    @if($featured->kategori)
                                    <span class="berita-kat-badge">
                                        <i class="fas fa-tag me-1"></i>{{ $featured->kategori }}
                                    </span>
                                    @endif
                                    <h2 class="berita-featured-title">{{ $featured->judul }}</h2>
                                    <p class="berita-featured-excerpt">
                                        {{ Str::limit(strip_tags($featured->isi), 200) }}
                                    </p>
                                    <div class="berita-meta">
                                        <span><i class="fas fa-user-circle me-1 text-warning"></i>Tim PKS</span>
                                        @if($featured->tanggal)
                                        <span class="ms-3"><i class="fas fa-calendar me-1 text-warning"></i>
                                            {{ \Carbon\Carbon::parse($featured->tanggal)->translatedFormat('d F Y') }}
                                        </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-pks-gold mt-3" onclick="openBeritaModal({{ $featured->id }})">
                                        <i class="fas fa-book-open me-2"></i>Baca Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- News Grid --}}
            <div class="row g-4">
                @foreach($berita as $index => $item)
                    @if(!$kategoriAktif && !$q && $berita->currentPage() == 1 && $loop->first)
                        @continue
                    @endif
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="berita-card h-100">
                            <div class="berita-card-img-wrap">
                                @if($item->foto)
                                    <img src="{{ asset($item->foto) }}" alt="{{ $item->judul }}" class="berita-card-img">
                                @else
                                    <div class="berita-img-placeholder">
                                        <i class="fas fa-newspaper fa-3x text-white-50"></i>
                                    </div>
                                @endif
                                @if($item->kategori)
                                <span class="berita-card-kat">{{ $item->kategori }}</span>
                                @endif
                            </div>
                            <div class="berita-card-body">
                                <div class="berita-meta mb-2">
                                    @if($item->tanggal)
                                    <span><i class="fas fa-calendar-alt me-1 text-warning"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                    @endif
                                </div>
                                <h5 class="berita-card-title">{{ $item->judul }}</h5>
                                <p class="berita-card-excerpt">{{ Str::limit(strip_tags($item->isi), 120) }}</p>
                                <button class="btn btn-read-more" onclick="openBeritaModal({{ $item->id }})">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-box mt-5" data-aos="fade-up">
                {{ $berita->appends(['kategori' => $kategoriAktif, 'q' => $q])->links() }}
            </div>

            @else
            {{-- Empty State --}}
            <div class="empty-state text-center py-5" data-aos="zoom-in">
                <div class="empty-state-icon mb-4">
                    <i class="fas fa-newspaper fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted">Belum Ada Berita</h4>
                <p class="text-muted">
                    @if($kategoriAktif || $q)
                        Tidak ditemukan berita yang sesuai filter. Coba ubah kriteria pencarian.
                    @else
                        Berita akan segera ditambahkan. Pantau terus!
                    @endif
                </p>
                @if($kategoriAktif || $q)
                <a href="{{ route('berita') }}" class="btn btn-pks-navy mt-2">
                    <i class="fas fa-arrow-left me-2"></i>Lihat Semua Berita
                </a>
                @endif
            </div>
            @endif
        </div>
    </section>

</div>

{{-- ==================== BERITA MODAL ==================== --}}
<div id="beritaModal" class="berita-modal-overlay" onclick="closeBeritaModal(event)">
    <div class="berita-modal-box" onclick="event.stopPropagation()">
        <button class="berita-modal-close" onclick="document.getElementById('beritaModal').classList.remove('active')">
            <i class="fas fa-times"></i>
        </button>
        <div id="beritaModalContent" class="berita-modal-content">
            <div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i></div>
        </div>
    </div>
</div>

<style>
/* ===== SEARCH INPUT ===== */
.berita-search-input {
    border-right: none;
    border-color: #d1d5db;
    padding-left: 1rem;
}
.berita-search-input:focus { border-color: var(--pks-gold); box-shadow: none; }
.btn-pks-gold { background: var(--pks-gold); color: #fff; border: none; }
.btn-pks-gold:hover { background: #d97706; color: #fff; }
.btn-pks-navy { background: var(--pks-navy); color: #fff; border: none; }
.btn-pks-navy:hover { background: #1a3a5c; color: #fff; }
.bg-navy { background: var(--pks-navy); }
.active-filter-info { font-size: 0.9rem; color: #6b7280; }

/* ===== FEATURED CARD ===== */
.berita-featured-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(11,30,54,0.15);
    background: #fff;
    border: 2px solid #f3f4f6;
    transition: box-shadow 0.3s;
}
.berita-featured-card:hover { box-shadow: 0 16px 48px rgba(11,30,54,0.2); }
.berita-featured-img-wrap {
    height: 100%;
    min-height: 300px;
    position: relative;
    overflow: hidden;
}
.berita-featured-img {
    width: 100%;
    height: 100%;
    min-height: 300px;
    object-fit: cover;
    transition: transform 0.4s;
}
.berita-featured-card:hover .berita-featured-img { transform: scale(1.03); }
.berita-featured-label {
    position: absolute;
    top: 1rem; left: 1rem;
    background: var(--pks-gold);
    color: #fff;
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 700;
}
.berita-img-placeholder {
    width: 100%;
    min-height: 300px;
    background: linear-gradient(135deg, var(--pks-navy), #1a3a5c);
    display: flex;
    align-items: center;
    justify-content: center;
}
.berita-featured-body {
    padding: 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
}
.berita-kat-badge {
    display: inline-block;
    background: #e0e7ff;
    color: #3730a3;
    padding: 3px 12px;
    border-radius: 30px;
    font-size: 0.78rem;
    font-weight: 600;
}
.berita-featured-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--pks-navy);
    line-height: 1.4;
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
}
.berita-featured-excerpt {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.7;
}
.berita-meta { font-size: 0.82rem; color: #9ca3af; }

/* ===== BERITA CARD ===== */
.berita-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(11,30,54,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}
.berita-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(11,30,54,0.15); }
.berita-card-img-wrap { position: relative; overflow: hidden; height: 200px; }
.berita-card-img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.4s; }
.berita-card:hover .berita-card-img { transform: scale(1.05); }
.berita-card-kat {
    position: absolute;
    bottom: 0.75rem; left: 0.75rem;
    background: rgba(11,30,54,0.85);
    color: var(--pks-gold);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 4px;
}
.berita-card-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
.berita-card-title {
    color: var(--pks-navy);
    font-weight: 700;
    font-size: 1rem;
    line-height: 1.4;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.berita-card-excerpt { color: #6b7280; font-size: 0.875rem; flex: 1; }
.btn-read-more {
    background: none;
    color: var(--pks-gold);
    border: none;
    padding: 0;
    font-weight: 600;
    font-size: 0.85rem;
    transition: color 0.2s;
}
.btn-read-more:hover { color: var(--pks-navy); }

/* ===== EMPTY STATE ===== */
.empty-state { padding: 3rem; }
.empty-state-icon {
    width: 100px; height: 100px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

/* ===== BERITA MODAL ===== */
.berita-modal-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(11,30,54,0.85);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}
.berita-modal-overlay.active { display: flex; }
.berita-modal-box {
    background: #fff;
    border-radius: 20px;
    max-width: 700px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 24px 60px rgba(0,0,0,0.3);
}
.berita-modal-close {
    position: sticky;
    top: 1rem;
    float: right;
    margin: 1rem 1rem 0 0;
    background: #f3f4f6;
    border: none;
    width: 36px; height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #374151;
    z-index: 10;
}
.berita-modal-close:hover { background: var(--pks-navy); color: #fff; }
.berita-modal-content { padding: 1.5rem 2rem 2rem; clear: both; }
.berita-modal-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 1.5rem;
}
.berita-modal-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--pks-navy);
    margin-bottom: 0.75rem;
    line-height: 1.4;
}
.berita-modal-body { color: #374151; line-height: 1.8; font-size: 0.95rem; }
</style>

<script>
// Store berita data for modal
const beritaData = @json($berita->items());

function openBeritaModal(id) {
    const item = beritaData.find(b => b.id == id);
    if (!item) return;

    let html = '';
    if (item.foto) {
        html += `<img src="/web-rpl/public/${item.foto}" alt="${item.judul}" class="berita-modal-img">`;
    }
    if (item.kategori) {
        html += `<span class="berita-kat-badge mb-2 d-inline-block">${item.kategori}</span>`;
    }
    html += `<h3 class="berita-modal-title">${item.judul}</h3>`;
    if (item.tanggal) {
        html += `<p class="berita-meta mb-3"><i class="fas fa-calendar-alt me-1 text-warning"></i>${item.tanggal}</p>`;
    }
    html += `<div class="berita-modal-body">${item.isi || ''}</div>`;

    document.getElementById('beritaModalContent').innerHTML = html;
    document.getElementById('beritaModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeBeritaModal(event) {
    document.getElementById('beritaModal').classList.remove('active');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeBeritaModal();
});
</script>
@endsection
