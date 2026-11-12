<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Natasya', 'kelas' => 'XII BD 1', 'angkatan' => '2024', 'jabatan' => 'Ketua'],
            ['nama' => 'Aini Almaulida', 'kelas' => 'XII BD 1', 'angkatan' => '2024', 'jabatan' => 'Wakil Ketua'],
            ['nama' => 'Esa Maesyaroh', 'kelas' => 'XII BD 2', 'angkatan' => '2024', 'jabatan' => 'Sekretaris'],
            ['nama' => 'Devi Nurwati', 'kelas' => 'XII BD 2', 'angkatan' => '2024', 'jabatan' => 'Bendahara'],
            ['nama' => 'Revita Maulida', 'kelas' => 'XII BD 1', 'angkatan' => '2024', 'jabatan' => 'Humas'],
            ['nama' => 'Tri Rahayu', 'kelas' => 'XI BD 1', 'angkatan' => '2025', 'jabatan' => 'Anggota'],
            ['nama' => 'Dewi Surya', 'kelas' => 'XI BD 1', 'angkatan' => '2025', 'jabatan' => 'Anggota'],
            ['nama' => 'Syifa Aulia', 'kelas' => 'XI BD 1', 'angkatan' => '2025', 'jabatan' => 'Anggota'],
            ['nama' => 'Senda Triandari', 'kelas' => 'XI BD 1', 'angkatan' => '2025', 'jabatan' => 'Anggota'],
            ['nama' => 'Nida Mutia', 'kelas' => 'XI BD 1', 'angkatan' => '2025', 'jabatan' => 'Anggota'],
        ];

        foreach ($data as $i => $item) {
            Anggota::updateOrCreate(
                ['nama' => $item['nama']],
                $item + ['status' => 'Aktif', 'nis' => '2025'.str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT)]
            );
        }
    }
}
