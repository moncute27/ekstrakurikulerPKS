<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Juara 1 PBB Terbaik', 'tingkat' => 'Kabupaten', 'tahun' => 2025, 'penyelenggara' => 'Kabupaten Purwakarta', 'keterangan' => 'Juara 1 kategori Peraturan Baris Berbaris terbaik tingkat kabupaten.'],
            ['judul' => 'Juara 3 Danton Terbaik', 'tingkat' => 'Kabupaten', 'tahun' => 2025, 'penyelenggara' => 'Kabupaten Purwakarta', 'keterangan' => 'Juara 3 kategori komandan peleton terbaik tingkat kabupaten.'],
            ['judul' => 'Juara Madya 3 se-Jawa Barat', 'tingkat' => 'Provinsi', 'tahun' => 2025, 'penyelenggara' => 'Provinsi Jawa Barat', 'keterangan' => 'Meraih Juara Madya 3 pada perlombaan tingkat Provinsi Jawa Barat.'],
            ['judul' => 'Juara 2 Senam Terbaik Kab. Purwakarta', 'tingkat' => 'Kabupaten', 'tahun' => 2024, 'penyelenggara' => 'Kabupaten Purwakarta', 'keterangan' => 'Juara 2 kategori senam terbaik tingkat Kabupaten Purwakarta.'],
        ];

        foreach ($data as $item) {
            Prestasi::updateOrCreate(['judul' => $item['judul']], $item);
        }
    }
}
