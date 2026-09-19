<?php

namespace Database\Factories;

use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul'      => fake()->sentence(4),
            'keterangan' => fake()->paragraph(),
            'tanggal'    => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'bulan'      => fake()->monthName(),
        ];
    }
}