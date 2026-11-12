<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <!-- Agar responsive di HP -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anggota - Ekstrakurikuler PKS</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="/frontend/anggota.css">
</head>


<body>

    <div class="container">


        <!-- =====================================
             HEADER
        ====================================== -->

        <header class="header">



            <!-- Logo PKS -->
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

                    <a href="anggota" class="active">
                        Anggota
                    </a>

                    <a href="agenda">
                        Agenda
                    </a>
                    <a href="{{ url('/user') }}">User</a>


                </nav>

                <!-- Foto header -->
                <img
                    src="img/POTO PKS3.jpeg"
                    alt="Kegiatan PKS"
                    class="header-image"
                >

        </header>



        <!-- =====================================
             BAGIAN ANGGOTA
        ====================================== -->

        <main class="member-section">


            <!-- Judul -->

            <h1>
                DAFTAR ANGGOTA PKS
            </h1>


            <!-- Garis bawah judul -->

            <div class="title-line"></div>



            <!-- =================================
                 TABEL
            ================================== -->

            <div class="table-wrapper">

                <table>

                    <!-- HEADER TABEL -->

                    <thead>

                        <tr>

                            <th>Nama</th>

                            <th>Kelas</th>

                            <th>Jk</th>

                            <th>Angkatan</th>

                            <th>Status</th>

                        </tr>

                    </thead>


                    <!-- ISI TABEL -->

                    <tbody>

                        <tr>

                            <td>Tri Rahayu</td>

                            <td>XI BD 1</td>

                            <td>P</td>

                            <td>2025</td>

                            <td>Aktip</td>

                        </tr>


                        <tr>

                            <td>Dewi Surya</td>

                            <td>XI BD 1</td>

                            <td>P</td>

                            <td>2025</td>

                            <td>Aktip</td>

                        </tr>


                        <tr>

                            <td>Syifa Aulia</td>

                            <td>XI BD 1</td>

                            <td>P</td>

                            <td>2025</td>

                            <td>Aktip</td>

                        </tr>


                        <tr>

                            <td>Senda Triandari</td>

                            <td>XI BD 1</td>

                            <td>P</td>

                            <td>2025</td>

                            <td>Aktip</td>

                        </tr>


                        <tr>

                            <td>Nida Mutia</td>

                            <td>XI BD 1</td>

                            <td>P</td>

                            <td>2025</td>

                            <td>Aktip</td>

                        </tr>

                    </tbody>

                </table>

            </div>


        </main>

    </div>


</body>

</html>
