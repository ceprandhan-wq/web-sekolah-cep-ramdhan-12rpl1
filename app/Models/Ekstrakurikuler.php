<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'id_pembina',
        'nama',
        'deskripsi',
        'kegiatan_rutin',
        'jadwal',
        'lokasi',
        'foto',
        'logo',
        'dokumentasi',
        'status',
    ];

    protected $casts = [
        'kegiatan_rutin' => 'array',
        'dokumentasi'    => 'array',
    ];

    public function pembina()
    {
        return $this->belongsTo(Guru::class, 'id_pembina');
    }
}