@extends('frontend.layout')

@section('title', 'Galeri Foto')

@section('header_banner')
<div class="page-header-banner" style="background: linear-gradient(135deg, #0b1e36 0%, #1a3a5c 50%, #0b1e36 100%);">
    <div class="page-header-content">
        <span class="page-header-badge" data-aos="fade-down" data-aos-delay="100">
            <i class="fas fa-images me-2"></i>Galeri
        </span>
        <h1 class="page-header-title" data-aos="fade-up" data-aos-delay="200">
            Galeri <span style="color:#f59e0b;">Foto PKS</span>
        </h1>
        <p class="page-header-sub" data-aos="fade-up" data-aos-delay="300">
            Dokumentasi kegiatan, latihan, dan momen berharga PKS SMKN 2 Purwakarta
        </p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="400">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-warning">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Galeri</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main-wrapper">

    {{-- ==================== FILTER ==================== --}}
    <section class="py-4">
        <div class="container">
            <div class="filter-pills-container justify-content-center" data-aos="fade-up">
                <a href="{{ route('galeri') }}"
                   class="filter-pill {{ !$kategoriAktif ? 'active' : '' }}">
                    <i class="fas fa-border-all me-1"></i>Semua Foto
                </a>
                @foreach($kategoriList as $kat)
                <a href="{{ route('galeri', ['kategori' => $kat]) }}"
                   class="filter-pill {{ $kategoriAktif == $kat ? 'active' : '' }}">
                    @php
                        $icon = match($kat) {
                            'Kegiatan' => 'fa-calendar-star',
                            'Latihan' => 'fa-dumbbell',
                            'Lomba' => 'fa-trophy',
                            'Upacara' => 'fa-flag',
                            default => 'fa-camera',
                        };
                    @endphp
                    <i class="fas {{ $icon }} me-1"></i>{{ $kat }}
                </a>
                @endforeach
            </div>

            {{-- Photo Count --}}
            <p class="text-center text-muted small mt-3" data-aos="fade-up">
                Menampilkan <strong>{{ $galeri->count() }}</strong> dari <strong>{{ $galeri->total() }}</strong> foto
                @if($kategoriAktif) dalam kategori <span class="badge bg-warning text-dark">{{ $kategoriAktif }}</span> @endif
            </p>
        </div>
    </section>

    {{-- ==================== PHOTO GRID ==================== --}}
    <section class="pb-5">
        <div class="container">
            @if($galeri->count() > 0)

            <div class="galeri-grid" id="galeriGrid">
                @foreach($galeri as $index => $item)
                <div class="galeri-item" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 80 }}"
                     onclick="openLightbox({{ $index }})">
                    <div class="galeri-img-wrap">
                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" alt="{{ $item->judul }}" class="galeri-img" loading="lazy">
                        @else
                            <div class="galeri-img-placeholder">
                                <i class="fas fa-image fa-3x text-white-50"></i>
                            </div>
                        @endif
                        <div class="galeri-overlay">
                            <div class="galeri-overlay-content">
                                <i class="fas fa-expand-alt fa-2x text-white mb-2"></i>
                                <h6 class="text-white mb-1">{{ $item->judul }}</h6>
                                @if($item->kategori)
                                <span class="galeri-kat-badge">{{ $item->kategori }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="pagination-box mt-5" data-aos="fade-up">
                {{ $galeri->appends(['kategori' => $kategoriAktif])->links() }}
            </div>

            @else
            <div class="empty-state text-center py-5" data-aos="zoom-in">
                <div class="empty-icon-wrap mb-4">
                    <i class="fas fa-images fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted">Belum Ada Foto</h4>
                <p class="text-muted">
                    @if($kategoriAktif)
                        Belum ada foto untuk kategori ini. Coba kategori lain.
                    @else
                        Foto akan segera ditambahkan. Pantau terus!
                    @endif
                </p>
                @if($kategoriAktif)
                <a href="{{ route('galeri') }}" class="btn btn-pks-navy mt-2">
                    <i class="fas fa-arrow-left me-2"></i>Lihat Semua Foto
                </a>
                @endif
            </div>
            @endif
        </div>
    </section>

</div>

{{-- ==================== LIGHTBOX ==================== --}}
<div id="lightbox" class="lightbox-overlay" onclick="closeLightbox(event)">
    <div class="lightbox-box" onclick="event.stopPropagation()">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-prev" onclick="changeLightbox(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-next" onclick="changeLightbox(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-content">
            <img id="lightboxImg" src="" alt="" class="lightbox-img">
            <div class="lightbox-caption">
                <h5 id="lightboxTitle" class="text-white mb-1"></h5>
                <span id="lightboxKat" class="galeri-kat-badge"></span>
                <div class="lightbox-counter mt-2">
                    <span id="lightboxCounter" class="text-white-50 small"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== GALERI GRID — Masonry-like ===== */
.galeri-grid {
    columns: 4;
    column-gap: 1rem;
}
@media (max-width: 1200px) { .galeri-grid { columns: 3; } }
@media (max-width: 768px) { .galeri-grid { columns: 2; } }
@media (max-width: 480px) { .galeri-grid { columns: 1; } }

.galeri-item {
    break-inside: avoid;
    margin-bottom: 1rem;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    display: block;
    position: relative;
}

.galeri-img-wrap { position: relative; overflow: hidden; }
.galeri-img {
    width: 100%;
    display: block;
    transition: transform 0.4s ease;
}
.galeri-item:hover .galeri-img { transform: scale(1.06); }

.galeri-img-placeholder {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, var(--pks-navy), #1a3a5c);
    display: flex;
    align-items: center;
    justify-content: center;
}

.galeri-overlay {
    position: absolute;
    inset: 0;
    background: rgba(11,30,54,0.75);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.galeri-item:hover .galeri-overlay { opacity: 1; }
.galeri-overlay-content { text-align: center; padding: 1rem; }
.galeri-kat-badge {
    display: inline-block;
    background: var(--pks-gold);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}

/* ===== LIGHTBOX ===== */
.lightbox-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.95);
    z-index: 10000;
    align-items: center;
    justify-content: center;
}
.lightbox-overlay.active { display: flex; }
.lightbox-box {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.lightbox-img {
    max-width: 100%;
    max-height: 75vh;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    object-fit: contain;
}
.lightbox-caption { text-align: center; padding: 1rem 0 0; }
.lightbox-close {
    position: fixed;
    top: 1.5rem; right: 1.5rem;
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    width: 44px; height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.2s;
    z-index: 10001;
}
.lightbox-close:hover { background: var(--pks-red); }
.lightbox-prev, .lightbox-next {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.12);
    border: none;
    color: #fff;
    width: 50px; height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background 0.2s;
    z-index: 10001;
}
.lightbox-prev { left: 1.5rem; }
.lightbox-next { right: 1.5rem; }
.lightbox-prev:hover, .lightbox-next:hover { background: var(--pks-gold); }

/* ===== UTIL ===== */
.btn-pks-navy { background: var(--pks-navy); color: #fff; border: none; }
.btn-pks-navy:hover { background: #1a3a5c; color: #fff; }
.empty-icon-wrap {
    width: 100px; height: 100px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}
</style>

<script>
const galeriItems = @json($galeri->items());
let currentLightbox = 0;

function openLightbox(index) {
    currentLightbox = index;
    updateLightbox();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function updateLightbox() {
    const item = galeriItems[currentLightbox];
    if (!item) return;
    const img = document.getElementById('lightboxImg');
    img.src = item.foto ? '/web-rpl/public/' + item.foto : '';
    img.alt = item.judul || '';
    document.getElementById('lightboxTitle').textContent = item.judul || '';
    const katEl = document.getElementById('lightboxKat');
    katEl.textContent = item.kategori || '';
    katEl.style.display = item.kategori ? 'inline-block' : 'none';
    document.getElementById('lightboxCounter').textContent =
        `${currentLightbox + 1} / ${galeriItems.length}`;
}

function changeLightbox(dir) {
    currentLightbox = (currentLightbox + dir + galeriItems.length) % galeriItems.length;
    updateLightbox();
}

function closeLightbox(event) {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') changeLightbox(-1);
    if (e.key === 'ArrowRight') changeLightbox(1);
});
</script>
@endsection
