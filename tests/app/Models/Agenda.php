<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'waktu', 'lokasi'];

    protected $casts = ['tanggal' => 'date'];

    public function scopeMendatang($query)
    {
        return $query->whereDate('tanggal', '>=', now()->toDateString());
    }

    public function getSudahLewatAttribute(): bool
    {
        return $this->tanggal?->isPast() ?? false;
    }
}
