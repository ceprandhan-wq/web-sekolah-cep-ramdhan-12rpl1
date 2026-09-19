<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profils';

    protected $fillable = [
        'nama_sekolah',
        'moto',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'website',
        'sejarah',
        'visi',
        'misi',
        'logo',
        'foto_hero',
        'foto_sambutan',
    ];

    protected $casts = [
        'misi' => 'array',
    ];
}