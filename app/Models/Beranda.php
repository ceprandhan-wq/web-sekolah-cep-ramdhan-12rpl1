<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    protected $fillable = [
        'judul', 'moto', 'deskripsi', 'gambar', 'foto', 'logo',
        'sejarah', 'visi', 'misi',
        'alamat', 'telepon', 'email', 'website',
        'kepsek_nama', 'kepsek_jabatan', 'kepsek_foto', 'sambutan',
        'jumlah_siswa', 'jumlah_guru',
    ];

    protected $casts = [
        'misi' => 'array',
    ];
}