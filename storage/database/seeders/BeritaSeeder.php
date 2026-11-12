<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Penyerahan Piala Olimpiade Smart Student',
                'kategori' => 'Prestasi',
                'ringkasan' => 'PKS menerima penghargaan dalam kegiatan olimpiade smart student sebagai bentuk apresiasi atas prestasi yang telah diraih.',
                'isi' => "PKS SMKN 2 Purwakarta menerima penghargaan dalam kegiatan Olimpiade Smart Student sebagai bentuk apresiasi atas prestasi yang telah diraih oleh para anggota.\n\nPenyerahan piala dilakukan langsung di lingkungan sekolah dan disaksikan oleh pembina serta seluruh anggota ekstrakurikuler. Penghargaan ini menjadi motivasi bagi anggota untuk terus berlatih dan mengharumkan nama sekolah.",
                'gambar' => 'img/smk2.jpeg',
                'tanggal' => '2026-05-01',
            ],
            [
                'judul' => 'Peringatan HUT Bhayangkara ke-81',
                'kategori' => 'Kegiatan',
                'ringkasan' => 'PKS turut berpartisipasi dalam kegiatan peringatan HUT Bhayangkara ke-81.',
                'isi' => "Anggota PKS SMKN 2 Purwakarta turut berpartisipasi dalam kegiatan peringatan HUT Bhayangkara ke-81 bersama jajaran kepolisian setempat.\n\nKegiatan ini diisi dengan pawai, demonstrasi baris-berbaris, serta pengaturan lalu lintas di sekitar lokasi acara. Partisipasi ini menjadi pengalaman berharga bagi anggota untuk menerapkan materi yang dipelajari selama latihan.",
                'gambar' => 'img/ppbb.jpeg',
                'tanggal' => '2026-06-20',
            ],
            [
                'judul' => 'Serah Terima Jabatan Pengurus PKS',
                'kategori' => 'Pengumuman',
                'ringkasan' => 'Kegiatan serah terima jabatan sebagai bagian dari pergantian dan pelantikan kepengurusan PKS.',
                'isi' => "Kegiatan serah terima jabatan dilaksanakan sebagai bagian dari pergantian dan pelantikan kepengurusan ekstrakurikuler PKS periode baru.\n\nPengurus yang baru dilantik resmi menjalankan program kerja untuk satu tahun ke depan, meliputi latihan rutin, pembinaan anggota baru, serta persiapan mengikuti berbagai perlombaan.",
                'gambar' => 'img/honey.jpeg',
                'tanggal' => '2026-07-10',
            ],
        ];

        foreach ($data as $item) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($item['judul'])],
                $item + ['penulis' => 'Admin PKS', 'is_published' => true]
            );
        }
    }
}
