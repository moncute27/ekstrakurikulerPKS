<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — {{ $profil->nama_ekskul ?? 'Ekstrakurikuler PKS' }}</title>

    <link rel="icon" href="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    @stack('styles')
</head>
<body>

<header class="site-header">
    <div class="container site-header__inner">

        <a href="{{ route('beranda') }}" class="brand">
            <img src="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}" alt="Logo PKS">
            <span class="brand__text">
                <strong>{{ $profil->nama_ekskul ?: 'Ekstrakurikuler PKS' }}</strong>
                <span>{{ $profil->nama_sekolah ?: 'SMKN 2 Purwakarta' }}</span>
            </span>
        </a>

        <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu">☰</button>

        <nav class="main-nav" id="mainNav">
            <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'is-active' : '' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'is-active' : '' }}">Profil</a>
            <a href="{{ route('organisasi') }}" class="{{ request()->routeIs('organisasi') ? 'is-active' : '' }}">Organisasi</a>
            <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'is-active' : '' }}">Berita</a>
            <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'is-active' : '' }}">Galeri</a>
            <a href="{{ route('prestasi') }}" class="{{ request()->routeIs('prestasi') ? 'is-active' : '' }}">Prestasi</a>
            <a href="{{ route('anggota') }}" class="{{ request()->routeIs('anggota') ? 'is-active' : '' }}">Anggota</a>
            <a href="{{ route('agenda') }}" class="{{ request()->routeIs('agenda') ? 'is-active' : '' }}">Agenda</a>

            @auth
                <a href="{{ route('admin.dashboard') }}" class="nav-login">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-login">Login</a>
            @endauth
        </nav>

    </div>
</header>

@yield('content')

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <div>
                <h4>{{ $profil->nama_ekskul ?: 'Ekstrakurikuler PKS' }}</h4>
                <p>{{ $profil->deskripsi_singkat ?: 'Patroli Keamanan Sekolah (PKS) membina karakter, kepemimpinan, dan kedisiplinan siswa.' }}</p>
            </div>

            <div>
                <h4>Navigasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ route('organisasi') }}">Struktur Organisasi</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                    <li><a href="{{ route('agenda') }}">Agenda</a></li>
                </ul>
            </div>

            <div>
                <h4>Kontak</h4>
                <ul class="footer-links">
                    @if($profil->alamat)<li>📍 {{ $profil->alamat }}</li>@endif
                    @if($profil->telepon)<li>📞 {{ $profil->telepon }}</li>@endif
                    @if($profil->email)<li>✉️ {{ $profil->email }}</li>@endif
                    @if($profil->instagram)<li>📷 {{ $profil->instagram }}</li>@endif
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} {{ $profil->nama_ekskul ?: 'Ekstrakurikuler PKS' }} — {{ $profil->nama_sekolah ?: 'SMKN 2 Purwakarta' }}. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>

<script>
    (function () {
        const toggle = document.getElementById('navToggle');
        const nav = document.getElementById('mainNav');

        if (toggle && nav) {
            toggle.addEventListener('click', () => nav.classList.toggle('is-open'));
            nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => nav.classList.remove('is-open')));
        }
    })();
</script>

@stack('scripts')

</body>
</html>
