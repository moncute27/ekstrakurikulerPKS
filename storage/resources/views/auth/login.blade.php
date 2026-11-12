<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ $profil->nama_ekskul ?: 'Ekstrakurikuler PKS' }}</title>

    <link rel="icon" href="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>
<body>

<div class="auth-page">
    <div>

        <div class="auth-card">

            <img src="{{ asset($profil->logo ?: 'img/logo pks.jpeg') }}" alt="Logo PKS" class="auth-card__logo">

            <h1>Masuk Panel Admin</h1>
            <p class="auth-card__sub">{{ $profil->nama_ekskul ?: 'Ekstrakurikuler PKS' }} — {{ $profil->nama_sekolah ?: 'SMKN 2 Purwakarta' }}</p>

            @if(session('sukses'))
                <div class="alert alert--success">{{ session('sukses') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@pks.test" required autofocus>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <label class="field-inline">
                    <input type="checkbox" name="remember" value="1">
                    <span>Ingat saya di perangkat ini</span>
                </label>

                <button type="submit" class="btn btn--primary btn-block">Masuk</button>
            </form>

            <div class="auth-hint">
                <strong>Akun demo (hasil seeder):</strong><br>
                Admin — admin@pks.test / admin12345<br>
                Pengurus — pengurus@pks.test / pengurus12345<br>
                <em>Segera ganti password ini di halaman Manajemen User.</em>
            </div>

        </div>

        <a href="{{ route('beranda') }}" class="auth-back">← Kembali ke beranda</a>

    </div>
</div>

</body>
</html>
