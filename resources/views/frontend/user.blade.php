<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login User - Ekstrakurikuler PKS</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="frontend/user.css">
</head>


<body>

    <div class="page">

        <!-- =================================
             HEADER
        ================================== -->

        <header class="header">

            <!-- Foto header -->
            <img
                src="img/POTO PKS3.jpeg"
                alt="Kegiatan PKS"
                class="header-image"
            >


            <!-- Logo -->
            <img
                src="img/logo pks.jpeg"
                alt="Logo PKS"
                class="logo"
            >


            <!-- =================================
                 NAVBAR
            ================================== -->

            <nav class="navbar">

                <a href="beranda">
                    Beranda
                </a>

                <a href="profil">
                    Profil
                </a>

                <a href="organisasi">
                    Organisasi
                </a>

                <a href="berita">
                    Berita
                </a>

                <a href="galeri">
                    Galeri
                </a>

                <a href="prestasi">
                    Prestasi
                </a>

                <a href="anggota">
                    Anggota
                </a>

                <a href="agenda">
                    Agenda
                </a>

                <a href="user">
                    user
                </a>

            </nav>

        </header>


        <!-- =================================
             LOGIN
        ================================== -->

        <main class="login-section">


            <!-- ICON USER -->

            <div class="user-icon">

                <svg
                    viewBox="0 0 64 64"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <!-- Kepala -->
                    <circle
                        cx="32"
                        cy="18"
                        r="9"
                    />

                    <!-- Badan -->
                    <path
                        d="M14 53
                           C14 41 21 34 32 34
                           C43 34 50 41 50 53"
                    />

                </svg>

            </div>


            <!-- =================================
                 TEXT
            ================================== -->

            <h1>
                Selamat Datang!
            </h1>

            <p>
                Silahkan masuk untuk melanjutkan
            </p>


            <!-- =================================
                 FORM LOGIN
            ================================== -->

            <form class="login-form">


                <!-- USERNAME -->

                <div class="input-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Username"
                    >

                </div>


                <!-- PASSWORD -->

                <div class="input-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                    >

                </div>


                <!-- TOMBOL -->

                <a href="{{url ('/dashboard')}}">Masuk</a>


            </form>


        </main>

    </div>

</body>

</html>
