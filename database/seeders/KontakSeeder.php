<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        // Data tunggal: hanya dibuat kalau tabel masih kosong
        Kontak::firstOrCreate([], [
            'alamat'          => 'Jl. Raya Cijati, Kec. Cijati, Kab. Cianjur, Jawa Barat',
            'telepon'         => null,
            'whatsapp'        => '6285641826589',
            'email'           => 'admin@smkn1cijati.id',
            'website'         => 'smkn1cijati.sch.id',
            'jam_operasional' => 'Senin - Jumat, 07.00 - 15.00 WIB',
            'maps_embed'      => null,
            'facebook'        => 'https://www.facebook.com/smkn1cijatiofficial-106581810689075',
            'instagram'       => 'https://www.instagram.com/smkn1cijatiofficial/',
            'youtube'         => 'https://www.youtube.com/@smkn1cijatiofficial',
        ]);
    }
}