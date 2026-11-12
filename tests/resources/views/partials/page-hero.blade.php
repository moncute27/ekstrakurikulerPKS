<section class="page-hero">
    <img class="page-hero__bg" src="{{ asset($profil->foto_header ?: 'img/POTO PKS3.jpeg') }}" alt="">

    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a> / <span>{{ $judul }}</span>
        </div>

        <h1>{{ $judul }}</h1>

        @isset($sub)
            <p>{{ $sub }}</p>
        @endisset
    </div>
</section>
