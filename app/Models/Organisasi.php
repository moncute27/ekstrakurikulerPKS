<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'organisasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_pengurus',
        'jabatan',
        'foto_pengurus',
    ];
}
