<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'penguruses';

    protected $fillable = ['nama', 'jabatan', 'periode', 'foto', 'urutan'];

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }
}
