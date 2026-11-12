@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

    <section class="page-hero">
        <img class="page-hero__bg" src="{{ asset($berita->gambar ?: ($profil->foto_header ?: 'img/POTO PKS3.jpeg')) }}" alt="">

        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('beranda') }}">Beranda</a> /
                <a href="{{ route('berita.index') }}">Berita</a> /
                <span>{{ \Illuminate\Support\Str::limit($berita->judul, 40) }}</span>
            </div>

            <h1>{{ $berita->judul }}</h1>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width:840px;">

            <article class="article">

                @if($berita->gambar)
                    <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="article__cover">
                @endif

                <div class="article__meta">
                    <span class="chip chip--navy">{{ $berita->kategori }}</span>
                    <span>📅 {{ $berita->tanggal?->translatedFormat('d F Y') }}</span>
                    <span>✍️ {{ $berita->penulis }}</span>
                </div>

                <div class="article__body">
                    @foreach(preg_split('/\r\n|\r|\n/', (string) $berita->isi) as $paragraf)
                        @if(trim($paragraf) !== '')
                            <p>{{ $paragraf }}</p>
                        @endif
                    @endforeach
                </div>

            </article>

            <div style="margin-top:1.6rem;">
                <a href="{{ route('berita.index') }}" class="btn btn--outline">← Kembali ke Daftar Berita</a>
            </div>

            @if($lainnya->isNotEmpty())
                <div class="section-head section-head--left" style="margin-top:3rem;">
                    <h2 style="font-size:1.25rem;">Berita Lainnya</h2>
                </div>

                <div class="grid grid--3">
                    @foreach($lainnya as $item)
                        @include('partials.kartu-berita', ['item' => $item])
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
