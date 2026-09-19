<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guru>
 */
class GuruFactory extends Factory
{
    protected $model = Guru::class;

    public function definition(): array
    {
        $staf = $this->faker->boolean(30);

        return [
            'nama' => $this->faker->name(),
            'nip' => '-',
            'mapel' => $staf ? null : $this->faker->randomElement([
                'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'PJOK', 'PAI & BP',
            ]),
            'jabatan' => $staf ? $this->faker->randomElement([
                'Kebersihan & Keindahan Sekolah', 'Keamanan & Ketertiban Sekolah', 'Administrasi Sarpras',
            ]) : '-',
            'staf' => $staf,
            'jurusan_id' => Jurusan::inRandomOrder()->value('id'),
            'foto' => null,
        ];
    }

    public function staf(): static
    {
        return $this->state(fn () => ['staf' => true, 'mapel' => null]);
    }

    public function pengajar(): static
    {
        return $this->state(fn () => ['staf' => false, 'jabatan' => '-']);
    }
}