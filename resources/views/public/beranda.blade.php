@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

    <section class="hero">
        <img class="hero__bg" src="{{ asset($profil->foto_header ?: 'img/poto pkss.jpg') }}" alt="Kegiatan Ekstrakurikuler PKS">

        <div class="container hero__content">
            <span class="badge">★ Patroli Keamanan Sekolah</span>

            <h1>
                {{ strtoupper($profil->nama_ekskul ?: 'Ekstrakurikuler PKS') }}<br>
                <span>{{ strtoupper($profil->nama_sekolah ?: 'SMKN 2 Purwakarta') }}</span>
            </h1>

            <p>{{ $profil->visi ?: 'Membentuk siswa yang disiplin, bertanggung jawab, dan berkarakter melalui kegiatan Patroli Keamanan Sekolah.' }}</p>

            <div class="hero__actions">
                <a href="{{ route('profil') }}" class="btn btn--primary">Kenali Kami</a>
                <a href="{{ route('berita.index') }}" class="btn btn--ghost">Berita Terbaru</a>
            </div>
        </div>
    </section>

    {{-- ================= STATISTIK ================= --}}
    <section class="section section--tight section--alt">
        <div class="container">
            <div class="stats">
                <div class="stat">
                    <div class="stat__icon">👥</div>
                    <div class="stat__value">{{ $jumlahAnggota }}</div>
                    <div class="stat__label">Anggota Aktif</div>
                </div>
                <div class="stat">
                    <div class="stat__icon">🏆</div>
                    <div class="stat__value">{{ $jumlahPrestasi }}</div>
                    <div class="stat__label">Prestasi Diraih</div>
                </div>
                <div class="stat">
                    <div class="stat__icon">📅</div>
                    <div class="stat__value">{{ $jumlahAgenda }}</div>
                    <div class="stat__label">Agenda Kegiatan</div>
                </div>
                <div class="stat">
                    <div class="stat__icon">🖼️</div>
                    <div class="stat__value">{{ $jumlahGaleri }}</div>
                    <div class="stat__label">Dokumentasi</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= BERITA TERBARU ================= --}}
    <section class="section">
        <div class="container">

            <div class="section-head">
                <div class="section-head__eyebrow">Informasi</div>
                <h2>Berita Terbaru</h2>
                <p>Kabar terkini seputar kegiatan dan pencapaian ekstrakurikuler PKS.</p>
            </div>

            @if($beritaTerbaru->isEmpty())
                <div class="empty">
                    <div class="empty__icon">📰</div>
                    <p>Belum ada berita yang dipublikasikan.</p>
                </div>
            @else
                <div class="grid grid--3">
                    @foreach($beritaTerbaru as $item)
                        @include('partials.kartu-berita', ['item' => $item])
                    @endforeach
                </div>

                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('berita.index') }}" class="btn btn--outline">Lihat Semua Berita</a>
                </div>
            @endif

        </div>
    </section>

    {{-- ================= AGENDA ================= --}}
    @if($agendaTerdekat->isNotEmpty())
        <section class="section section--alt">
            <div class="container">

                <div class="section-head">
                    <div class="section-head__eyebrow">Jadwal</div>
                    <h2>Agenda Terdekat</h2>
                    <p>Kegiatan yang akan segera dilaksanakan oleh anggota PKS.</p>
                </div>

                <div class="grid" style="gap:1rem;">
                    @foreach($agendaTerdekat as $item)
                        @include('partials.kartu-agenda', ['item' => $item])
                    @endforeach
                </div>

                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('agenda') }}" class="btn btn--outline">Lihat Semua Agenda</a>
                </div>

            </div>
        </section>
    @endif

    {{-- ================= GALERI ================= --}}
    @if($galeriSorot->isNotEmpty())
        <section class="section">
            <div class="container">

                <div class="section-head">
                    <div class="section-head__eyebrow">Dokumentasi</div>
                    <h2>Galeri Kegiatan</h2>
                    <p>Momen-momen yang terekam dari berbagai kegiatan PKS.</p>
                </div>

                <div class="gallery">
                    @foreach($galeriSorot as $foto)
                        <figure>
                            <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}" loading="lazy">
                            <figcaption>{{ $foto->judul }}</figcaption>
                        </figure>
                    @endforeach
                </div>

                <div style="text-align:center;margin-top:2rem;">
                    <a href="{{ route('galeri') }}" class="btn btn--outline">Lihat Galeri Lengkap</a>
                </div>

            </div>
        </section>
    @endif

@endsection
