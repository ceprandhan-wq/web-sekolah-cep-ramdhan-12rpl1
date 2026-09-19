<?php

namespace Database\Factories;

use App\Models\Statistik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistik>
 */
class StatistikFactory extends Factory
{
    protected $model = Statistik::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'jumlah_siswa' => $this->faker->numberBetween(300, 900),
            'jumlah_guru'  => $this->faker->numberBetween(20, 80),
        ];
    }
}