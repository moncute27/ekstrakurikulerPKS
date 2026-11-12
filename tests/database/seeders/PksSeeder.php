<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Profil;
use App\Models\Organisasi;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Prestasi;
use App\Models\Anggota;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Profil
        DB::table('profil')->truncate();
        Profil::create([
            'judul' => 'EKSTRAKURIKULER PATROLI KEAMANAN SEKOLAH (PKS) SMKN 2 PURWAKARTA',
            'isi' => 'Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta adalah wadah organisasi kesiswaan yang bertugas menjaga keamanan, ketertiban, dan kedisiplinan di lingkungan sekolah serta mengatur kelancaran lalu lintas di sekitar gerbang sekolah. Di bawah binaan kepolisian dan pihak sekolah, PKS mendidik anggota menjadi insan berkarakter disiplin, berintegritas, tanggap, dan berjiwa kepemimpinan.',
            'visi' => 'Terwujudnya kader Patroli Keamanan Sekolah yang berkarakter disiplin, berakhlak mulia, berjiwa pemimpin, serta berkomitmen tinggi dalam mewujudkan lingkungan SMKN 2 Purwakarta yang aman, tertib, dan kondusif.',
            'misi' => "1. Menanamkan kedisiplinan dan kesadaran hukum berlalu lintas bagi seluruh siswa SMKN 2 Purwakarta.\n2. Melaksanakan pengamanan, penertiban, dan pengaturan lalu lintas lingkungan sekolah secara konsisten.\n3. Membangun solidaritas, mental kepemimpinan tangguh, dan kecakapan Peraturan Baris Berbaris (PBB).\n4. Menjalin kemitraan sinergis dengan Satlantas Polres Purwakarta dan seluruh warga sekolah.",
            'sejarah' => 'Ekstrakurikuler Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta dibentuk sebagai wujud sinergi antara pihak sekolah dan Satlantas Kepolisian Resor Purwakarta. Berawal dari kepedulian terhadap ketertiban dan keselamatan siswa di jalan raya sekitar sekolah, PKS bertransformasi menjadi salah satu ekstrakurikuler unggulan berprestasi yang aktif dalam berbagai kejuaraan PBB, senam lalu lintas, dan pengabdian kedisiplinan sekolah.',
            'logo' => 'img/logo pks.jpeg',
        ]);

        // 2. Organisasi
        DB::table('organisasi')->truncate();
        $organisasiData = [
            [
                'nama_pengurus' => 'Lilis Aisyah Yuniarti, S.Pd.',
                'jabatan' => 'Pembina',
                'foto_pengurus' => 'img/pembina.jpeg',
            ],
            [
                'nama_pengurus' => 'Lutfiah Aprilina',
                'jabatan' => 'Pelatih',
                'foto_pengurus' => 'img/pelatih.jpeg',
            ],
            [
                'nama_pengurus' => 'Natasya',
                'jabatan' => 'Ketua Umum',
                'foto_pengurus' => 'img/poto pkss.jpg',
            ],
            [
                'nama_pengurus' => 'Aini Almaulida',
                'jabatan' => 'Wakil Ketua',
                'foto_pengurus' => '',
            ],
            [
                'nama_pengurus' => 'Esa Maesaroh',
                'jabatan' => 'Sekretaris',
                'foto_pengurus' => '',
            ],
            [
                'nama_pengurus' => 'Devi Nurwati',
                'jabatan' => 'Bendahara',
                'foto_pengurus' => '',
            ],
            [
                'nama_pengurus' => 'Revita Maulida',
                'jabatan' => 'Humas & Publikasi',
                'foto_pengurus' => '',
            ],
        ];
        foreach ($organisasiData as $org) {
            Organisasi::create($org);
        }

        // 3. Berita
        DB::table('berita')->truncate();
        $beritaData = [
            [
                'judul_berita' => 'Penyerahan Piala Olimpiade Smart Student',
                'isi_berita' => 'Kontingen Patroli Keamanan Sekolah (PKS) SMKN 2 Purwakarta berhasil meraih penghargaan bergengsi dalam ajang Olimpiade Smart Student tingkat Jawa Barat. Prestasi ini merupakan buah dari latihan disiplin intensif dan kekompakan tim yang solid dalam menghadapi berbagai tantangan kompetisi.',
                'tanggal' => '2026-05-01',
                'penulis' => 'Admin PKS',
                'kategori' => 'Prestasi',
                'foto_berita' => 'img/smk2.jpeg',
            ],
            [
                'judul_berita' => 'Peringatan HUT Bhayangkara Ke-81 Bersama Polres Purwakarta',
                'isi_berita' => 'Anggota PKS SMKN 2 Purwakarta turut berpartisipasi aktif dalam upacara kehormatan dan parade peringatan Hari Ulang Tahun Bhayangkara ke-81. Kegiatan ini menjadi momentum memperkuat sinergi antara kepolisian dan generasi muda pelopor ketertiban.',
                'tanggal' => '2026-06-20',
                'penulis' => 'Admin PKS',
                'kategori' => 'Kegiatan',
                'foto_berita' => 'img/ppbb.jpeg',
            ],
            [
                'judul_berita' => 'Serah Terima Jabatan Pengurus PKS Masa Bakti 2026/2027',
                'isi_berita' => 'Pelaksanaan Serah Terima Jabatan (Sertijab) kepengurusan PKS SMKN 2 Purwakarta berlangsung dengan khidmat di lapangan sekolah. Tongkat kepemimpinan resmi diserahkan kepada kepengurusan baru dengan komitmen melanjutkan tradisi prestasi dan disiplin.',
                'tanggal' => '2026-07-10',
                'penulis' => 'Admin PKS',
                'kategori' => 'Kegiatan',
                'foto_berita' => 'img/honey.jpeg',
            ],
            [
                'judul_berita' => 'Pendidikan dan Latihan Dasar (Diksar) Angkatan Baru PKS',
                'isi_berita' => 'Sebanyak 35 calon anggota baru PKS SMKN 2 Purwakarta mengikuti Pendidikan dan Latihan Dasar (Diksar). Materi yang diberikan meliputi 12 gerakan pengaturan lalu lintas, kedisiplinan PBB dasar, mental kepemimpinan, dan etika patroli keamanan.',
                'tanggal' => '2026-08-15',
                'penulis' => 'Admin PKS',
                'kategori' => 'Latihan',
                'foto_berita' => 'img/plisi.jpg',
            ],
            [
                'judul_berita' => 'Sosialisasi Tertib Berlalu Lintas dan Safety Riding Pelajar',
                'isi_berita' => 'PKS bekerjasama dengan Satuan Lalu Lintas (Satlantas) Polres Purwakarta menggelar sosialisasi tertib lalu lintas dan kampanye helm standar SNI bagi seluruh siswa SMKN 2 Purwakarta guna meminimalisir angka kecelakaan di kalangan pelajar.',
                'tanggal' => '2026-09-02',
                'penulis' => 'Admin PKS',
                'kategori' => 'Pengumuman',
                'foto_berita' => 'img/plisi2.jpg',
            ],
        ];
        foreach ($beritaData as $b) {
            Berita::create($b);
        }

        // 4. Galeri
        DB::table('galeri')->truncate();
        $galeriData = [
            [
                'judul' => 'Penyerahan Piala Juara Lomba Olimpiade Smart Student',
                'foto' => 'img/smk2.jpeg',
                'kategori' => 'Lomba',
            ],
            [
                'judul' => 'Parade Peringatan HUT Bhayangkara Ke-81',
                'foto' => 'img/ppbb.jpeg',
                'kategori' => 'Upacara',
            ],
            [
                'judul' => 'Pengamanan dan Pelatihan Baris Berbaris Lapangan',
                'foto' => 'img/plisi.jpg',
                'kategori' => 'Pelatihan',
            ],
            [
                'judul' => 'Apresiasi Prestasi PKS di SMKN 2 Purwakarta',
                'foto' => 'img/smkn222.jpeg',
                'kategori' => 'Lomba',
            ],
            [
                'judul' => 'Demonstrasi Atribut dan Formasi PKS Pada MPLS',
                'foto' => 'img/plisi2.jpg',
                'kategori' => 'Kegiatan',
            ],
            [
                'judul' => 'Dokumentasi Khidmat Serah Terima Jabatan',
                'foto' => 'img/honey.jpeg',
                'kategori' => 'Upacara',
            ],
            [
                'judul' => 'Kompak Bersama Seluruh Anggota PKS SMKN 2 Purwakarta',
                'foto' => 'img/POTO PKS3.jpeg',
                'kategori' => 'Kegiatan',
            ],
            [
                'judul' => 'Latihan Rutin 12 Gerakan Pengaturan Lalu Lintas',
                'foto' => 'img/poto pkss.jpg',
                'kategori' => 'Pelatihan',
            ],
        ];
        foreach ($galeriData as $g) {
            Galeri::create($g);
        }

        // 5. Prestasi
        DB::table('prestasi')->truncate();
        $prestasiData = [
            [
                'nama' => 'Juara 1 PBB Terbaik',
                'tingkat_lomba' => 'Kabupaten',
                'juara' => 'Juara 1',
                'tahun' => '2025',
                'deskripsi' => 'Lomba Peraturan Baris Berbaris (PBB) Presisi antar pelajar tingkat Kabupaten Purwakarta.',
                'foto' => 'img/smk2.jpeg',
            ],
            [
                'nama' => 'Juara 3 Komandan Pleton (Danton) Terbaik',
                'tingkat_lomba' => 'Kabupaten',
                'juara' => 'Juara 3',
                'tahun' => '2025',
                'deskripsi' => 'Penilaian ketegasan vokal, postur, dan ketangkasan aba-aba Komandan Pleton tingkat Kabupaten Purwakarta.',
                'foto' => 'img/ppbb.jpeg',
            ],
            [
                'nama' => 'Juara Madya 3 SE-Jawa Barat',
                'tingkat_lomba' => 'Provinsi',
                'juara' => 'Juara Madya 3',
                'tahun' => '2024',
                'deskripsi' => 'Kejuaraan PKS & Formasi Variasi Baris Berbaris tingkat Pelajar se-Provinsi Jawa Barat.',
                'foto' => 'img/honey.jpeg',
            ],
            [
                'nama' => 'Juara 2 Senam Lalu Lintas Terbaik Kab. Purwakarta',
                'tingkat_lomba' => 'Kabupaten',
                'juara' => 'Juara 2',
                'tahun' => '2025',
                'deskripsi' => 'Kompetisi Senam 12 Gerakan Pengaturan Lalu Lintas yang diselenggarakan oleh Satlantas Polres Purwakarta.',
                'foto' => 'img/smkn222.jpeg',
            ],
            [
                'nama' => 'Harapan 1 Formasi dan Kostum PKS Terkreatif',
                'tingkat_lomba' => 'Provinsi',
                'juara' => 'Harapan 1',
                'tahun' => '2024',
                'deskripsi' => 'Ajang kreativitas formasi defile dan kelengkapan atribut PKS se-Jawa Barat.',
                'foto' => 'img/POTO PKS3.jpeg',
            ],
        ];
        foreach ($prestasiData as $p) {
            Prestasi::create($p);
        }

        // 6. Anggota
        DB::table('anggota')->truncate();
        $anggotaData = [
            ['nama' => 'Tri Rahayu', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Dewi Surya', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Syifa Aulia', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Senda Triandari', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Nida Mutia', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Bunga', 'kelas' => 'XI BR 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Defi', 'kelas' => 'XI AK 2', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Tyra', 'kelas' => 'XI BD 2', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Noval', 'kelas' => 'XI AK 1', 'jenis_kelamin' => 'laki laki', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Reina', 'kelas' => 'XII MP', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2024', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Dipi', 'kelas' => 'XII MP', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2024', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Lulu Keyrani', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Mufidatul', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Zikra', 'kelas' => 'XI BD 1', 'jenis_kelamin' => 'laki laki', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
            ['nama' => 'Fitri', 'kelas' => 'XI RPL 2', 'jenis_kelamin' => 'perempuan', 'angkatan' => '2025', 'foto_angkatan' => '', 'status_keanggotan' => 'Aktif'],
        ];
        foreach ($anggotaData as $a) {
            Anggota::create($a);
        }

        // 7. Agenda
        DB::table('agenda')->truncate();
        $agendaData = [
            [
                'nama' => 'Peringatan HUT Bhayangkara Ke-81',
                'tanggal' => '2026-10-15',
                'waktu' => '07:30:00',
                'tempat' => 'Lapangan Utama SMKN 2 Purwakarta',
                'keterangan' => 'Upacara bersama jajaran kepolisian dan demonstrasi ketangkasan PKS.',
            ],
            [
                'nama' => 'Latihan Gabungan PKS se-Purwakarta',
                'tanggal' => '2026-10-28',
                'waktu' => '08:00:00',
                'tempat' => 'Mapolres Purwakarta',
                'keterangan' => 'Latihan bersama pendalaman 12 gerakan pengaturan lalu lintas dan pembinaan fisik.',
            ],
            [
                'nama' => 'Pendidikan & Latihan Dasar (Diksar) Angkatan 2026',
                'tanggal' => '2026-11-12',
                'waktu' => '06:30:00',
                'tempat' => 'Bumi Perkemahan Purwakarta',
                'keterangan' => 'Pelantikan, pengukuhan brevet, dan pembaretan calon anggota resmi PKS SMKN 2 Purwakarta.',
            ],
            [
                'nama' => 'Sosialisasi Tertib Lalu Lintas dan Safety Riding',
                'tanggal' => '2026-12-05',
                'waktu' => '09:00:00',
                'tempat' => 'Aula SMKN 2 Purwakarta',
                'keterangan' => 'Penyuluhan keselamatan berkendara bagi seluruh siswa SMKN 2 Purwakarta.',
            ],
        ];
        foreach ($agendaData as $ag) {
            Agenda::create($ag);
        }

        // 8. User (Admin)
        DB::table('user')->truncate();
        User::create([
            'nama' => 'Admin PKS',
            'username' => 'admin',
            'email' => 'adminpks@smkn2purwakarta.sch.id',
            'role' => 'Administrator',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'nama' => 'Petugas Patroli',
            'username' => 'petugas',
            'email' => 'petugas@smkn2purwakarta.sch.id',
            'role' => 'Operator',
            'password' => Hash::make('admin123'),
        ]);
    }
}
