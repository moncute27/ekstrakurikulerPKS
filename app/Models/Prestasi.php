<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = ['judul', 'tingkat', 'tahun', 'penyelenggara', 'keterangan', 'foto'];

    public const TINGKAT = ['Sekolah', 'Kabupaten', 'Provinsi', 'Nasional'];

    public function scopeTingkat($query, ?string $tingkat)
    {
        return $query->when($tingkat && $tingkat !== 'Semua', fn ($q) => $q->where('tingkat', $tingkat));
    }
}
