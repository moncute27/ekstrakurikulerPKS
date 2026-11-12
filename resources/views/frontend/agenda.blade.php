<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agenda - Ekstrakurikuler PKS</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="/frontend/agenda.css">
</head>

<body>

    <main class="page">

        <!-- ================= HEADER ================= -->

        <header class="header">

            <!-- Foto Header -->
            <img
                src="img/POTO PKS3.jpeg"
                alt="Kegiatan PKS"
                class="header-image"
            >

            <!-- Logo PKS -->
            <img
                src="img/logo pks.jpeg"
                alt="Logo PKS"
                class="logo"
            >

            <!-- Navbar -->
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

                <a href="agenda" class="active">
                    Agenda
                </a>

                <a href="user">
                    user
                </a>

            </nav>

        </header>


        <!-- ================= AGENDA ================= -->

        <section class="agenda">

            <!-- Judul -->
            <h1>AGENDA KEGIATAN</h1>

            <!-- Garis bawah -->
            <div class="title-line"></div>


            <!-- ================= DAFTAR AGENDA ================= -->

            <div class="agenda-list">


                <!-- Agenda 1 -->
                <div class="agenda-card">

                    <div class="agenda-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div class="agenda-content">

                        <h2>
                            Peringatan HUT Bhayangkara ke-81
                        </h2>

                        <p>
                            Kegiatan dalam rangka memperingati
                            HUT Bhayangkara ke-81
                        </p>

                    </div>

                </div>


                <!-- Agenda 2 -->
                <div class="agenda-card">

                    <div class="agenda-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div class="agenda-content">

                        <h2>
                            Serah Terima Jabatan
                        </h2>

                        <p>
                            Kegiatan serah terima jabatan
                            pengurus ekstrakurikuler PKS
                        </p>

                    </div>

                </div>


                <!-- Agenda 3 -->
                <div class="agenda-card">

                    <div class="agenda-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div class="agenda-content">

                        <h2>
                            Demo Ekstrakurikuler PKS
                        </h2>

                        <p>
                            Kegiatan pengenalan ekstrakurikuler
                            PKS kepada siswa
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>
