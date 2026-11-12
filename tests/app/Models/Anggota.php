<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = ['nis', 'nama', 'kelas', 'angkatan', 'jabatan', 'status', 'foto'];

    public const STATUS = ['Aktif', 'Tidak Aktif', 'Alumni'];

    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
}
