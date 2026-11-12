<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin PKS</title>

    <link rel="icon" href="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>

<div class="admin">

    @include('partials.admin-sidebar')

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main">

        <header class="topbar">

            <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Buka menu">☰</button>

            <div>
                <h2>@yield('title', 'Dashboard')</h2>
                <div class="topbar__sub">@yield('subtitle', 'Panel administrasi Ekstrakurikuler PKS')</div>
            </div>

            <div class="topbar__right">
                <a href="{{ route('beranda') }}" class="link-site" target="_blank">Lihat Situs ↗</a>

                <div class="topbar__user">
                    @if(auth()->user()->foto)
                        <img src="{{ asset(auth()->user()->foto) }}" alt="" class="av">
                    @else
                        <span class="av">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    @endif
                    <span>
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>{{ auth()->user()->role }}</small>
                    </span>
                </div>
            </div>

        </header>

        <main class="content">

            @include('partials.flash')

            @yield('content')

        </main>

    </div>
</div>

<script>
    (function () {
        const toggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function tutup() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-open');
        }

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('is-open');
                overlay.classList.toggle('is-open');
            });
        }

        if (overlay) overlay.addEventListener('click', tutup);

        // Konfirmasi sebelum menghapus data.
        document.querySelectorAll('form[data-confirm]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (!window.confirm(form.dataset.confirm)) e.preventDefault();
            });
        });

        // Pratinjau gambar sebelum diunggah.
        document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
            input.addEventListener('change', function () {
                const target = document.querySelector(input.dataset.preview);
                if (!target || !input.files[0]) return;
                target.src = URL.createObjectURL(input.files[0]);
                target.style.display = 'block';
            });
        });
    })();
</script>

@stack('scripts')

</body>
</html>
