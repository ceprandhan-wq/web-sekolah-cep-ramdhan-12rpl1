<?php

namespace Database\Factories;

use App\Models\Beranda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Beranda>
 */
class BerandaFactory extends Factory
{
    protected $model = Beranda::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul'     => 'SMK Negeri 1 Cijati',
            'moto'      => '" Kompeten, Berkarakter, Siap Kerja "',
            'deskripsi' => $this->faker->paragraphs(3, true),
            'gambar'    => 'smkn1cijati.jpg',
            'foto'      => 'smkn1cijati.jpg',
            'logo'      => 'logo-smkn1cijati.png',
            'sejarah'   => $this->faker->paragraphs(2, true),
            'visi'      => $this->faker->sentence(20),
            'misi'      => [
                'Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan dunia usaha dan dunia industri.',
                'Mengembangkan kompetensi peserta didik melalui pembelajaran berbasis praktik dan teknologi terkini.',
                'Membentuk karakter peserta didik yang disiplin, jujur, dan bertanggung jawab.',
                'Menjalin kerja sama dengan dunia usaha, dunia industri, dan masyarakat sekitar.',
            ],
            'alamat'    => $this->faker->address(),
            'telepon'   => $this->faker->phoneNumber(),
            'email'     => 'info@smkn1cijati.sch.id',
            'website'   => 'smkn1cijati.sch.id',
        ];
    }
}