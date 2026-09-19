<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $table = 'statistik';

    protected $fillable = [
        'jumlah_siswa',
        'jumlah_guru',
        'jumlah_alumni',
        'jumlah_prestasi',
    ];
}