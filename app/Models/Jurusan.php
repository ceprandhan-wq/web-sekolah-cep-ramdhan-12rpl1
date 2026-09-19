<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $fillable = [
        'kode',
        'nama_jurusan',
        'kepala_jurusan',
        'foto_kepala_jurusan',
        'logo_jurusan',
        'foto',
        'deskripsi',
    ];

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
}