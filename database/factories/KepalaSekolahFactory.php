<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepalaSekolah>
 */
class KepalaSekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'     => $this->faker->name('male') . ', S.Pd., M.Pd.',
            'jabatan'  => 'Kepala Sekolah',
            'foto'     => null, // isi manual kalau perlu, mis. 'a_rahmat_dimyati.jpeg'
            'sambutan' => implode("\n\n", $this->faker->paragraphs(4)),
        ];
    }
}