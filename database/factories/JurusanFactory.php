<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jurusan>
 */
class JurusanFactory extends Factory
{
    protected $model = Jurusan::class;

    public function definition(): array
    {
        // Dipasangkan per kode<->nama supaya konsisten (tidak acak sendiri-sendiri)
        $jurusanList = [
            'aphp' => 'Agroindustri Pengolahan Hasil Pertanian',
            'pms'  => 'Bisnis Daring dan Pemasaran',
            'pplg' => 'Rekayasa Perangkat Lunak',
            'tkr'  => 'Teknik Kendaraan Ringan',
        ];

        $kode = $this->faker->randomElement(array_keys($jurusanList));

        return [
            'kode'                => $kode,
            'nama_jurusan'        => $jurusanList[$kode],
            'kepala_jurusan'      => $this->faker->name(),
            'deskripsi'           => $this->faker->paragraph(),
            'foto_kepala_jurusan' => 'guru-produktif/' . $this->faker->uuid() . '.jpg',
            'logo_jurusan'        => 'logo-' . $kode . '.jpeg',
            'foto'                => $kode . '-1.jpg',
        ];
    }
}