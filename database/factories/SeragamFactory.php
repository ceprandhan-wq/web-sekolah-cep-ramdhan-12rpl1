<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seragam>
 */
class SeragamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'      => ucfirst($this->faker->unique()->dayOfWeek()),
            'deskripsi' => $this->faker->sentence(15),
            'foto'      => null, // isi manual kalau perlu, mis. 'seragam-contoh.jpeg'
            'urutan'    => $this->faker->numberBetween(1, 10),
        ];
    }
}