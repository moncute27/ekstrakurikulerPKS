<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'isi',
        'gambar',
        'penulis',
        'tanggal',
        'is_published',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_published' => 'boolean',
    ];

    public const KATEGORI = ['Kegiatan', 'Pengumuman', 'Prestasi'];

    protected static function booted(): void
    {
        static::saving(function (Berita $berita) {
            if (blank($berita->slug)) {
                $berita->slug = static::buatSlug($berita->judul, $berita->id);
            }

            if (blank($berita->ringkasan)) {
                $berita->ringkasan = Str::limit(strip_tags((string) $berita->isi), 160);
            }
        });
    }

    public static function buatSlug(string $judul, ?int $abaikanId = null): string
    {
        $dasar = Str::slug($judul) ?: 'berita';
        $slug = $dasar;
        $i = 2;

        while (static::where('slug', $slug)->when($abaikanId, fn ($q) => $q->where('id', '!=', $abaikanId))->exists()) {
            $slug = $dasar.'-'.$i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
