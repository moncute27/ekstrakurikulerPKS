<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Peringatan HUT Bhayangkara ke-81',
                'deskripsi' => 'Kegiatan dalam rangka memperingati HUT Bhayangkara ke-81 bersama jajaran kepolisian.',
                'tanggal' => now()->addDays(14)->toDateString(),
                'waktu' => '07:00',
                'lokasi' => 'Alun-alun Purwakarta',
            ],
            [
                'judul' => 'Serah Terima Jabatan',
                'deskripsi' => 'Kegiatan serah terima jabatan pengurus ekstrakurikuler PKS periode baru.',
                'tanggal' => now()->addDays(30)->toDateString(),
                'waktu' => '13:00',
                'lokasi' => 'Aula SMKN 2 Purwakarta',
            ],
            [
                'judul' => 'Demo Ekstrakurikuler PKS',
                'deskripsi' => 'Kegiatan pengenalan ekstrakurikuler PKS kepada siswa baru.',
                'tanggal' => now()->addDays(45)->toDateString(),
                'waktu' => '08:00',
                'lokasi' => 'Lapangan Upacara',
            ],
            [
                'judul' => 'Latihan Rutin Mingguan',
                'deskripsi' => 'Latihan baris-berbaris dan materi keamanan sekolah setiap hari Jumat.',
                'tanggal' => now()->subDays(7)->toDateString(),
                'waktu' => '15:00',
                'lokasi' => 'Lapangan Upacara',
            ],
        ];

        foreach ($data as $item) {
            Agenda::updateOrCreate(['judul' => $item['judul']], $item);
        }
    }
}
