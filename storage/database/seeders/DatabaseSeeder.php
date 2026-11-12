<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengurus;
use App\Models\Prestasi;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfilSeeder::class,
            PengurusSeeder::class,
            BeritaSeeder::class,
            GaleriSeeder::class,
            PrestasiSeeder::class,
            AnggotaSeeder::class,
            AgendaSeeder::class,
        ]);
    }
}
