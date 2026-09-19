<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Upacara HUT RI ke-81', 'keterangan' => 'Lapangan utama sekolah', 'tanggal' => '2026-08-14'],
            ['judul' => 'Rapat Orang Tua Siswa', 'keterangan' => 'Aula sekolah', 'tanggal' => '2026-08-22'],
            ['judul' => 'Ujian Tengah Semester', 'keterangan' => 'Seluruh kelas', 'tanggal' => '2026-08-30'],
        ];

        foreach ($data as $row) {
            Agenda::create([
                'judul'      => $row['judul'],
                'keterangan' => $row['keterangan'],
                'tanggal'    => $row['tanggal'],
                'bulan'      => \Carbon\Carbon::parse($row['tanggal'])->translatedFormat('F'),
            ]);
        }
    }
}