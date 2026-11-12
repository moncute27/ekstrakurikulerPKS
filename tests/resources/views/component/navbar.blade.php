<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header class="navbar">
            <link rel="stylesheet" href="{{ asset('navbar.css') }}">
            <a href="{{ url('/beranda') }}" class="logo">
                <img src="{{ asset('img/logo pks.jpeg') }}" alt="Logo PKS">
            </a>

            <nav class="nav-menu" id="navMenu">
                <a href="{{ url('/beranda') }}" class="active">Beranda</a>
                <a href="{{ url('/profil') }}">Profil</a>
                <a href="{{ url('/organisasi') }}">Organisasi</a>
                <a href="{{ url('/berita') }}">Berita</a>
                <a href="{{ url('/galeri') }}">Galeri</a>
                <a href="{{ url('/prestasi') }}">Prestasi</a>
                <a href="{{ url('/anggota') }}">Anggota</a>
                <a href="{{ url('/agenda') }}">Agenda</a>
                <a href="{{ url('/user') }}">User</a>
            </nav>

            <button class="menu-toggle" id="menuToggle" type="button">
                ☰
            </button>

        </header>
</body>
</html>
