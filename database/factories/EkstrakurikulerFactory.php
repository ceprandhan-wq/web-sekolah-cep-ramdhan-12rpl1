<?php

namespace Database\Factories;

use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ekstrakurikuler>
 */
class EkstrakurikulerFactory extends Factory
{
    protected $model = Ekstrakurikuler::class;

    public function definition(): array
    {
        return [
            'id_pembina'     => Guru::factory(),
            'nama'           => fake()->randomElement([
                'Pramuka', 'PMR', 'Basket', 'Futsal', 'Paskibra', 'English Club',
            ]),
            'deskripsi'      => fake()->paragraph(),
            'kegiatan_rutin' => [fake()->sentence(), fake()->sentence(), fake()->sentence()],
            'jadwal'         => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu']),
            'lokasi'         => fake()->randomElement(['Lapangan Sekolah', 'Aula Sekolah', 'Ruang Kelas']),
            'foto'           => 'ekskul/default.jpg',
            'dokumentasi'    => [],
            'status'         => 'aktif',
        ];
    }
}