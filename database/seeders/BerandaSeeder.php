<?php

namespace Database\Seeders;

use App\Models\Beranda;
use Illuminate\Database\Seeder;

class BerandaSeeder extends Seeder
{
    public function run(): void
    {
        Beranda::updateOrCreate(
            ['id' => 1],
            [
                'judul'     => 'SMK Negeri 1 Cijati',
                'moto'      => '" Kompeten, Berkarakter, Siap Kerja "',
                'deskripsi' => 'SMK Negeri 1 Cijati adalah sekolah menengah kejuruan yang berkomitmen menyediakan pendidikan berkualitas tinggi dalam bidang teknik dan kejuruan. Dengan fasilitas yang terus berkembang dan tenaga pengajar yang berpengalaman, kami bertujuan mempersiapkan siswa-siswi menjadi lulusan yang kompeten dan siap menghadapi tantangan dunia industri.',
                'gambar'    => 'smkn1cijati.jpg',
                'foto'      => 'smkn1cijati.jpg',
                'logo'      => 'logo-smkn1cijati.png',
                'sejarah'   => 'SMK Negeri 1 Cijati didirikan sebagai upaya pemerintah daerah untuk memperluas akses pendidikan kejuruan bagi masyarakat sekitar. Sejak awal berdiri, sekolah ini berkomitmen mencetak lulusan yang siap kerja, mandiri, dan berdaya saing. Seiring berjalannya waktu, sekolah terus berkembang dari sisi fasilitas, jumlah kompetensi keahlian, maupun jaringan kerja sama dengan dunia usaha dan dunia industri, sehingga mampu menghadirkan proses pembelajaran yang relevan dengan kebutuhan zaman.',
                'visi'      => 'Menjadi lembaga pendidikan kejuruan yang unggul, kompetitif, dan berkarakter, serta mampu menghasilkan lulusan yang siap kerja, mandiri, dan berdaya saing tinggi di era global.',
                'misi'      => [
                    'Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan dunia usaha dan dunia industri.',
                    'Mengembangkan kompetensi peserta didik melalui pembelajaran berbasis praktik dan teknologi terkini.',
                    'Membentuk karakter peserta didik yang disiplin, jujur, dan bertanggung jawab.',
                    'Menjalin kerja sama dengan dunia usaha, dunia industri, dan masyarakat sekitar.',
                ],
                'alamat'    => 'Jl. Raya Cijati, Kec. Cijati, Kab. Cianjur, Jawa Barat',
                'telepon'   => '0263-1234567',
                'email'     => 'info@smkn1cijati.sch.id',
                'website'   => 'smkn1cijati.sch.id',

                // ---- Sambutan Kepala Sekolah ----
                'kepsek_nama'    => 'A Rahmat Dimyati, S.Pd., M.Pd.',
                'kepsek_jabatan' => 'Kepala Sekolah',
                'kepsek_foto'    => 'beranda/a_rahmat_dimyati.jpeg',
                'sambutan'       => "Assalamualaikum Warahmatullahi Wabarakatuh.\n\n"
                    ."Puji syukur kami panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya, sehingga SMK Negeri 1 Cijati dapat terus berkembang dan berkontribusi dalam mencerdaskan kehidupan bangsa melalui pendidikan kejuruan yang berkualitas.\n\n"
                    ."Selamat datang di laman resmi SMK Negeri 1 Cijati. Sebagai lembaga pendidikan menengah kejuruan, kami berkomitmen untuk membentuk generasi muda yang tidak hanya unggul secara akademik, tetapi juga memiliki keterampilan, karakter, dan kesiapan menghadapi dunia kerja maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.\n\n"
                    ."Kami terus berupaya meningkatkan kualitas pembelajaran, sarana dan prasarana, serta menjalin kerja sama dengan dunia usaha dan dunia industri agar lulusan kami benar-benar kompeten, berkarakter, dan siap bersaing di era global.\n\n"
                    ."Atas nama seluruh keluarga besar SMK Negeri 1 Cijati, saya mengucapkan terima kasih atas dukungan dan kepercayaan yang diberikan. Semoga sekolah ini dapat terus menjadi tempat menimba ilmu yang bermanfaat bagi siswa-siswi kami dan masyarakat luas.\n\n"
                    ."Wassalamualaikum Warahmatullahi Wabarakatuh.",

                // ---- Statistik Sekolah ----
                'jumlah_siswa' => 721,
                'jumlah_guru'  => 51,
            ]
        );
    }
}