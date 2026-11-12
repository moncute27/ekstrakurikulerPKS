@php
    $menu = [
        ['route' => 'admin.dashboard', 'aktif' => 'admin.dashboard', 'ikon' => '⌂', 'label' => 'Dashboard'],
    ];

    $menuKonten = [
        ['route' => 'admin.profil.edit', 'aktif' => 'admin.profil.*', 'ikon' => '🏫', 'label' => 'Profil Ekskul'],
        ['route' => 'admin.pengurus.index', 'aktif' => 'admin.pengurus.*', 'ikon' => '🎖️', 'label' => 'Struktur Organisasi'],
        ['route' => 'admin.berita.index', 'aktif' => 'admin.berita.*', 'ikon' => '📰', 'label' => 'Berita'],
        ['route' => 'admin.galeri.index', 'aktif' => 'admin.galeri.*', 'ikon' => '🖼️', 'label' => 'Galeri'],
        ['route' => 'admin.prestasi.index', 'aktif' => 'admin.prestasi.*', 'ikon' => '🏆', 'label' => 'Prestasi'],
        ['route' => 'admin.anggota.index', 'aktif' => 'admin.anggota.*', 'ikon' => '👥', 'label' => 'Anggota'],
        ['route' => 'admin.agenda.index', 'aktif' => 'admin.agenda.*', 'ikon' => '📅', 'label' => 'Agenda'],
    ];
@endphp

<aside class="sidebar" id="sidebar">

    <div class="sidebar__brand">
        <img src="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}" alt="Logo PKS">
        <div>
            <strong>Admin PKS</strong>
            <span>{{ $profil->nama_sekolah ?: 'SMKN 2 Purwakarta' }}</span>
        </div>
    </div>

    <nav class="sidebar__nav">

        @foreach($menu as $item)
            <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['aktif']) ? 'is-active' : '' }}">
                <span class="ic">{{ $item['ikon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach

        <div class="sidebar__label">Kelola Konten</div>

        @foreach($menuKonten as $item)
            <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['aktif']) ? 'is-active' : '' }}">
                <span class="ic">{{ $item['ikon'] }}</span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach

        @if(auth()->user()->isAdmin())
            <div class="sidebar__label">Pengaturan</div>

            <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.*') ? 'is-active' : '' }}">
                <span class="ic">🔑</span>
                <span>Manajemen User</span>
            </a>
        @endif

    </nav>

    <div class="sidebar__foot">
        <form method="POST" action="{{ route('logout') }}" data-confirm="Yakin ingin keluar dari panel admin?">
            @csrf
            <button type="submit" class="logout-btn">
                <span>⇥</span>
                <span>Logout</span>
            </button>
        </form>
    </div>

</aside>
