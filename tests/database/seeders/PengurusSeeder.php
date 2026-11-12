<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Lilis Aisyah Yuniarti, S.Pd.', 'jabatan' => 'Pembina', 'foto' => 'img/pembina.jpeg', 'urutan' => 1],
            ['nama' => 'Lutfiah Aprilina', 'jabatan' => 'Pelatih', 'foto' => 'img/pelatih.jpeg', 'urutan' => 2],
            ['nama' => 'Natasya', 'jabatan' => 'Ketua', 'foto' => null, 'urutan' => 3],
            ['nama' => 'Aini Almaulida', 'jabatan' => 'Wakil Ketua', 'foto' => null, 'urutan' => 4],
            ['nama' => 'Esa Maesyaroh', 'jabatan' => 'Sekretaris', 'foto' => null, 'urutan' => 5],
            ['nama' => 'Devi Nurwati', 'jabatan' => 'Bendahara', 'foto' => null, 'urutan' => 6],
            ['nama' => 'Revita Maulida', 'jabatan' => 'Humas', 'foto' => null, 'urutan' => 7],
        ];

        foreach ($data as $item) {
            Pengurus::updateOrCreate(
                ['nama' => $item['nama']],
                $item + ['periode' => '2025/2026']
            );
        }
    }
}
