<?php

namespace Database\Factories;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArtikelFactory extends Factory
{
    protected $model = Artikel::class;

    public function definition(): array
    {
        return [
            'judul'     => $this->faker->sentence(6),
            'ringkasan' => $this->faker->paragraph(3),
            'gambar'    => null,
        ];
    }
}