<?php

namespace Database\Seeders;

use App\Models\KepalaSekolah;
use Illuminate\Database\Seeder;

class KepalaSekolahSeeder extends Seeder
{
    /**
     * Sambutan Kepala Sekolah bersifat data tunggal (satu baris saja).
     *
     * Teks default di bawah ini sebelumnya di-hardcode sebagai fallback
     * di dashboard.blade.php (blok @else pada section Sambutan Kepala
     * Sekolah). Sekarang dipindah ke sini supaya sumber kebenarannya
     * ada di database dan bisa diedit lewat panel admin (tab "Sambutan
     * Kepala Sekolah"), bukan lagi ditulis manual di file blade.
     */
    public function run(): void
    {
        $sambutanDefault = implode("\n\n", [
            'Assalamualaikum Warahmatullahi Wabarakatuh.',
            'Puji syukur kami panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya, sehingga SMK Negeri 1 Cijati dapat terus berkembang dan berkontribusi dalam mencerdaskan kehidupan bangsa melalui pendidikan kejuruan yang berkualitas.',
            'Selamat datang di laman resmi SMK Negeri 1 Cijati. Sebagai lembaga pendidikan menengah kejuruan, kami berkomitmen untuk membentuk generasi muda yang tidak hanya unggul secara akademik, tetapi juga memiliki keterampilan, karakter, dan kesiapan menghadapi dunia kerja maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.',
            'Kami terus berupaya meningkatkan kualitas pembelajaran, sarana dan prasarana, serta menjalin kerja sama dengan dunia usaha dan dunia industri agar lulusan kami benar-benar kompeten, berkarakter, dan siap bersaing di era global.',
            'Atas nama seluruh keluarga besar SMK Negeri 1 Cijati, saya mengucapkan terima kasih atas dukungan dan kepercayaan yang diberikan. Semoga sekolah ini dapat terus menjadi tempat menimba ilmu yang bermanfaat bagi siswa-siswi kami dan masyarakat luas.',
            'Wassalamualaikum Warahmatullahi Wabarakatuh.',
        ]);

        KepalaSekolah::updateOrCreate(
            ['id' => 1],
            [
                'nama'     => 'A Rahmat Dimyati, S.Pd., M.Pd.',
                'jabatan'  => 'Kepala Sekolah',
                'foto'     => 'beranda/a_rahmat_dimyati.jpeg',
                'sambutan' => $sambutanDefault,
            ]
        );

        $this->command->info('✅ Data Kepala Sekolah dipastikan ada (dibuat/diupdate).');
    }
}