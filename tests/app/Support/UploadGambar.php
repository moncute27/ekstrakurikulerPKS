<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Helper sederhana untuk menyimpan gambar ke folder public/uploads
 * sehingga tidak perlu menjalankan "php artisan storage:link".
 */
class UploadGambar
{
    /**
     * Simpan file baru, hapus file lama bila ada.
     * Mengembalikan path relatif terhadap folder public, contoh: "uploads/berita/abc.jpg"
     */
    public static function simpan(?UploadedFile $file, string $folder, ?string $fileLama = null): ?string
    {
        if (! $file) {
            return $fileLama;
        }

        $tujuan = public_path('uploads/'.$folder);

        if (! is_dir($tujuan)) {
            mkdir($tujuan, 0755, true);
        }

        $namaFile = Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->move($tujuan, $namaFile);

        static::hapus($fileLama);

        return 'uploads/'.$folder.'/'.$namaFile;
    }

    public static function hapus(?string $path): void
    {
        if (! $path) {
            return;
        }

        // Jangan pernah menghapus gambar bawaan di folder img/
        if (! Str::startsWith($path, 'uploads/')) {
            return;
        }

        $full = public_path($path);

        if (is_file($full)) {
            @unlink($full);
        }
    }
}
