@extends('layouts.public')

@section('title', 'Berita')

@section('content')

    @include('partials.page-hero', [
        'judul' => 'Berita Terbaru',
        'sub' => 'Kabar kegiatan, pengumuman, dan pencapaian Ekstrakurikuler PKS.',
    ])

    <section class="section">
        <div class="container">

            <form class="search-form" method="GET" action="{{ route('berita.index') }}">
                <input type="text" name="cari" value="{{ $cari }}" placeholder="Cari judul berita...">
                <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
                <button type="submit" class="btn btn--outline">Cari</button>
            </form>

            <div class="filter-bar">
                <a href="{{ route('berita.index', ['cari' => $cari]) }}"
                   class="{{ $kategoriAktif === 'Semua' ? 'is-active' : '' }}">Semua</a>

                @foreach(\App\Models\Berita::KATEGORI as $kategori)
                    <a href="{{ route('berita.index', ['kategori' => $kategori, 'cari' => $cari]) }}"
                       class="{{ $kategoriAktif === $kategori ? 'is-active' : '' }}">{{ $kategori }}</a>
                @endforeach
            </div>

            @if($berita->isEmpty())
                <div class="empty">
                    <div class="empty__icon">📰</div>
                    <p>Tidak ada berita yang cocok dengan pencarian Anda.</p>
                </div>
            @else
                <div class="grid grid--3">
                    @foreach($berita as $item)
                        @include('partials.kartu-berita', ['item' => $item])
                    @endforeach
                </div>

                <div class="pagination-wrap">{{ $berita->links() }}</div>
            @endif

        </div>
    </section>

@endsection
