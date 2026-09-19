<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'jurusan_id',
        'nama',
        'nip',
        'mapel',
        'jabatan',
        'staf',
        'foto',
    ];

    protected $casts = [
        'staf' => 'boolean',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}