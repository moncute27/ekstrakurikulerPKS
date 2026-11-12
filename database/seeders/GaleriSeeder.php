<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Penyerahan Piala Olimpiade Smart Student', 'gambar' => 'img/smk2.jpeg', 'keterangan' => 'Dokumentasi penyerahan piala lomba olimpiade smart student.', 'tanggal' => '2026-05-01'],
            ['judul' => 'HUT Bhayangkara ke-81', 'gambar' => 'img/ppbb.jpeg', 'keterangan' => 'Dokumentasi peringatan HUT Bhayangkara ke-81.', 'tanggal' => '2026-06-20'],
            ['judul' => 'Pawai HUT Bhayangkara', 'gambar' => 'img/plisi.jpg', 'keterangan' => 'Dokumentasi peringatan HUT Bhayangkara ke-81.', 'tanggal' => '2026-06-20'],
            ['judul' => 'Dokumentasi Kegiatan Sekolah', 'gambar' => 'img/smkn222.jpeg', 'keterangan' => 'Dokumentasi penyerahan piala lomba olimpiade smart student.', 'tanggal' => '2026-05-01'],
            ['judul' => 'Demo Ekstrakurikuler', 'gambar' => 'img/plisi2.jpg', 'keterangan' => 'Dokumentasi demo ekstrakurikuler PKS kepada siswa baru.', 'tanggal' => '2026-08-05'],
            ['judul' => 'Serah Terima Jabatan', 'gambar' => 'img/honey.jpeg', 'keterangan' => 'Dokumentasi serah terima jabatan pengurus PKS.', 'tanggal' => '2026-07-10'],
        ];

        foreach ($data as $item) {
            Galeri::updateOrCreate(['gambar' => $item['gambar']], $item);
        }
    }
}
