<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profils';

    protected $fillable = [
        'nama_ekskul',
        'nama_sekolah',
        'deskripsi_singkat',
        'sejarah',
        'visi',
        'misi',
        'alamat',
        'email',
        'telepon',
        'instagram',
        'logo',
        'foto_header',
    ];

    /**
     * Profil bersifat singleton: selalu ada satu baris.
     */
    public static function get(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'nama_ekskul' => 'Ekstrakurikuler PKS',
            'nama_sekolah' => 'SMKN 2 Purwakarta',
        ]);
    }

    /**
     * Misi disimpan sebagai teks, satu poin per baris.
     */
    public function misiList(): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $this->misi))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
