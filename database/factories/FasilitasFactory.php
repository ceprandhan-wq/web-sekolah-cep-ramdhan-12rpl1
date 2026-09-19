<?php

namespace Database\Factories;

use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fasilitas>
 */
class FasilitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_fasilitas' => fake()->randomElement([
                'Perpustakaan',
                'Laboratorium Komputer',
                'Lapangan Basket',
                'Ruang UKS',
                'Kantin Sekolah',
                'Masjid Sekolah',
                'Ruang Musik',
                'Aula Sekolah'
            ]),
            'deskripsi' => fake()->sentence(),
            'gambar' => 'default.png',
        ];
    }
 
}
