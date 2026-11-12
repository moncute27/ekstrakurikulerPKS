<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        Profil::updateOrCreate(['id' => 1], [
            'nama_ekskul' => 'Ekstrakurikuler PKS',
            'nama_sekolah' => 'SMKN 2 Purwakarta',
            'deskripsi_singkat' => 'Patroli Keamanan Sekolah (PKS) merupakan organisasi ekstrakurikuler di sekolah yang bertujuan membina karakter, kepemimpinan, dan kedisiplinan siswa.',
            'sejarah' => 'Ekstrakurikuler Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta dibentuk sebagai wadah pembinaan siswa dalam bidang ketertiban, keamanan, dan kedisiplinan lingkungan sekolah. Anggota PKS dibekali materi baris-berbaris, pengaturan lalu lintas sekolah, serta kepemimpinan melalui latihan rutin dan kegiatan kolaborasi bersama kepolisian.',
            'visi' => 'Membentuk siswa yang disiplin, bertanggung jawab, dan berkarakter melalui kegiatan Patroli Keamanan Sekolah.',
            'misi' => "Menanamkan sikap disiplin dan tanggung jawab kepada seluruh anggota.\nMembantu menciptakan ketertiban dan keamanan di lingkungan sekolah.\nMengembangkan jiwa kepemimpinan dan kerja sama tim.\nMengikuti dan meraih prestasi dalam berbagai perlombaan PBB.\nMenjalin kerja sama yang baik dengan pihak sekolah dan kepolisian.",
            'alamat' => 'Jl. Jend. A. Yani No. 98, Nagri Sakti, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114',
            'email' => 'pks@smkn2purwakarta.sch.id',
            'telepon' => '(0264) 200163',
            'instagram' => '@pks.smkn2purwakarta',
            'logo' => 'img/logo pks.jpeg',
            'foto_header' => 'img/POTO PKS3.jpeg',
        ]);
    }
}
