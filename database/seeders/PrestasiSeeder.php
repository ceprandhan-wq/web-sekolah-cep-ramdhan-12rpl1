<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul'  => 'Ilham Sulaeman Dikukuhkan sebagai Pasukan Pengibar Bendera Pusaka Kabupaten Cianjur',
                'gambar' => 'ilham-sulaeman-paskibra-kabupaten.jpeg',
            ],
            [
                'judul'  => 'Siti Nurhalimah & Celsa Wisdasari Raih Juara 3 O2SN (Atletik & Bulutangkis Putri)',
                'gambar' => 'juara-banbinton.jpeg',
            ],
            [
                'judul'  => 'Regu PMR SMK Negeri 1 Cijati Raih Juara di Kegiatan Perkemahan',
                'gambar' => 'pmr-juara1-kabupaten-cianjur .jpg',
            ],
        ];

        foreach ($data as $row) {
            Prestasi::updateOrCreate(['judul' => $row['judul']], $row);
        }
    }
}