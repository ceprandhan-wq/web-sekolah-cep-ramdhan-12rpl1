<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profil>
 */
class ProfilFactory extends Factory
{
    protected $model = Profil::class;

    public function definition(): array
    {
        return [
            'nama_sekolah' => 'SMK Negeri 1 Cijati',
            'moto'         => '" Kompeten, Berkarakter, Siap Kerja "',
            'npsn'         => $this->faker->numerify('#########'),
            'alamat'       => $this->faker->address(),
            'telepon'      => $this->faker->phoneNumber(),
            'email'        => 'info@smkn1cijati.sch.id',
            'website'      => 'smkn1cijati.sch.id',
            'sejarah'      => $this->faker->paragraphs(2, true),
            'visi'         => $this->faker->sentence(20),
            'misi' => [
                'Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan dunia usaha dan dunia industri.',
                'Mengembangkan kompetensi peserta didik melalui pembelajaran berbasis praktik dan teknologi terkini.',
                'Membentuk karakter peserta didik yang disiplin, jujur, dan bertanggung jawab.',
                'Menjalin kerja sama dengan dunia usaha, dunia industri, dan masyarakat sekitar.',
            ],
            'logo'          => 'logo-smkn1cijati.png',
            'foto_hero'     => 'hero/gerbang.jpeg',
            'foto_sambutan' => 'smkn1cijati.jpg',
        ];
    }
}