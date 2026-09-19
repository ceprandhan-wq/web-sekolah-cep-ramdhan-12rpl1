<?php

namespace Database\Seeders;

use App\Models\Seragam;
use Illuminate\Database\Seeder;

class SeragamSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Senin & Selasa',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Senin dan Selasa, yaitu seragam putih-abu lengkap dengan atribut OSIS, dasi, dan sepatu hitam.',
                'foto' => 'seragam-senin-selasa.jpeg', // ⬅️ tanpa 'images/beranda/'
                'urutan' => 1,
            ],
            [
                'nama' => 'Olahraga',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati saat kegiatan PJOK, yaitu seragam olahraga berwarna biru lengkap dengan kaos, celana training, dan sepatu olahraga.',
                'foto' => 'seragam-olahraga.jpeg',
                'urutan' => 2,
            ],
            [
                'nama' => 'Korep',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari tertentu, yaitu seragam korep berwarna biru muda lengkap dengan lencana valuet dan sepatu hitam.',
                'foto' => 'seragam-rabu.jpeg',
                'urutan' => 3,
            ],
            [
                'nama' => 'Kamis',
                'deskripsi' => 'Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Kamis, yaitu seragam batik khas sekolah lengkap dengan rok/celana abu tua dan sepatu hitam.',
                'foto' => 'seragam-kamis.jpeg',
                'urutan' => 4,
            ],
            [
                'nama' => "Jum'at",
                'deskripsi' => "Seragam resmi yang digunakan siswa-siswi SMK Negeri 1 Cijati pada hari Jum'at, yaitu seragam Pramuka lengkap dengan kacu merah putih dan sepatu hitam.",
                'foto' => 'seragam-jumat.jpeg',
                'urutan' => 5,
            ],
        ];

        foreach ($data as $row) {
            Seragam::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}