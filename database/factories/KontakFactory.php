<?php

namespace Database\Factories;

use App\Models\Kontak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kontak>
 */
class KontakFactory extends Factory
{
    protected $model = Kontak::class;

    public function definition(): array
    {
        return [
            'alamat'          => 'Jl. Raya Cijati, Kec. Cijati, Kab. Cianjur, Jawa Barat',
            'telepon'         => '0263-' . fake()->numerify('######'),
            'whatsapp'        => '62' . fake()->numerify('8##########'),
            'email'           => 'info@smkn1cijati.sch.id',
            'website'         => 'smkn1cijati.sch.id',
            'jam_operasional' => 'Senin - Jumat, 07.00 - 15.00 WIB',
            'maps_embed'      => null,
            'facebook'        => 'https://www.facebook.com/smkn1cijatiofficial-106581810689075',
            'instagram'       => 'https://www.instagram.com/smkn1cijatiofficial/',
            'youtube'         => 'https://www.youtube.com/@smkn1cijatiofficial',
        ];
    }
}