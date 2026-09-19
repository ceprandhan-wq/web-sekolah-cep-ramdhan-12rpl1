<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = ['judul', 'keterangan', 'tanggal', 'bulan'];

    // WAJIB: agar $agenda->tanggal->format('d') dan ->translatedFormat('M')
    // di dashboard.blade.php bisa dipakai (butuh instance Carbon, bukan string)
    protected $casts = [
        'tanggal' => 'date',
    ];
}