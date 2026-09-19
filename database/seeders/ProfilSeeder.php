<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profil::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'SMK Negeri 1 Cijati',
                'moto'         => '" Kompeten, Berkarakter, Siap Kerja "',
                'npsn'         => null,
                'alamat'       => 'Jl. Raya Cijati, Kec. Cijati, Kab. Cianjur, Jawa Barat',
                'telepon'      => '0263-1234567',
                'email'        => 'info@smkn1cijati.sch.id',
                'website'      => 'smkn1cijati.sch.id',

                'sejarah' => "SMK Negeri 1 Cijati didirikan sebagai upaya pemerintah daerah untuk memperluas akses pendidikan kejuruan bagi masyarakat sekitar. Sejak awal berdiri, sekolah ini berkomitmen mencetak lulusan yang siap kerja, mandiri, dan berdaya saing.\n\n"
                    ."Seiring berjalannya waktu, sekolah terus berkembang dari sisi fasilitas, jumlah kompetensi keahlian, maupun jaringan kerja sama dengan dunia usaha dan dunia industri, sehingga mampu menghadirkan proses pembelajaran yang relevan dengan kebutuhan zaman.",

                'visi' => 'Terwujudnya lulusan KEREN dan BERSINERGI melalui pembelajaran mendalam, penguatan karakter Pancawaluya, serta kolaborasi aktif dengan dunia kerja dan industri.',

                'misi' => [
                    'Menyelenggarakan pembelajaran mendalam yang berpusat pada peserta didik untuk mengembangkan kompetensi secara optimal.',
                    'Menumbuhkan karakter religius, energik, dan nasionalis dalam kehidupan sehari-hari melalui penguatan nilai-nilai Pancawaluya.',
                    'Mengembangkan lulusan yang kompeten dan berdaya saing sesuai dengan kebutuhan dunia kerja dan perkembangan zaman.',
                    'Menanamkan jiwa kewirausahaan (entrepreneurship) melalui kegiatan pembelajaran dan praktik nyata.',
                    'Menumbuhkan integritas, etos kerja, dan tanggung jawab melalui pembiasaan, keteladanan, dan budaya sekolah yang positif.',
                    'Menguatkan kolaborasi dan kemitraan aktif dengan dunia kerja dan industri untuk meningkatkan relevansi dan kualitas lulusan.',
                ],

                'logo'          => 'logo-smkn1cijati.png',
                'foto_hero'     => 'hero/gerbang.jpeg',
                'foto_sambutan' => 'smkn1cijati.jpg',
            ]
        );
    }
}