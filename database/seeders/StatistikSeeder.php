<?php

namespace Database\Seeders;

use App\Models\Statistik;
use Illuminate\Database\Seeder;

class StatistikSeeder extends Seeder
{
    /**
     * Statistik sekolah bersifat data tunggal (satu baris saja),
     * sesuai dengan angka yang sebelumnya di-hardcode di halaman
     * publik (dashboard.blade.php): 721 siswa & 51 guru.
     */
    public function run(): void
    {
        Statistik::updateOrCreate(
            ['id' => 1],
            [
                'jumlah_siswa' => 721,
                'jumlah_guru'  => 51,
            ]
        );

        $this->command->info('✅ Data Statistik Sekolah dipastikan ada (dibuat/diupdate).');
    }
}