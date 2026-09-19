<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode'                => 'aphp',
                'nama_jurusan'        => 'Agriteknologi Pengolahan Hasil Pertanian',
                'kepala_jurusan'      => 'Budiana Hermawan, S.TP.',
                'foto_kepala_jurusan' => 'budiana_hermawan.jpg',
                'logo_jurusan'        => 'logo-aphp.jpeg',
                'foto'                => 'aphp-1.jpg',
                'deskripsi'           => 'Kompetensi Keahlian Agriteknologi Pengolahan Hasil Pertanian (APHP) membekali siswa dengan keterampilan mengolah bahan hasil pertanian, perkebunan, dan perikanan menjadi produk pangan olahan yang bernilai jual, aman dikonsumsi, dan berdaya saing di pasar. Siswa dibekali kompetensi mulai dari penanganan bahan baku, proses produksi (fermentasi, pengeringan, pengalengan, hingga diversifikasi produk), pengendalian mutu, pengemasan, hingga strategi pemasaran produk olahan pangan melalui praktik langsung di Workshop APHP. Lulusan disiapkan untuk berkarier di industri pengolahan pangan, menjadi wirausahawan agroindustri, maupun melanjutkan pendidikan ke jenjang perguruan tinggi pada program studi teknologi pangan dan agroindustri.',
            ],
            [
                'kode'                => 'pms',
                'nama_jurusan'        => 'Bisnis Daring dan Pemasaran',
                'kepala_jurusan'      => 'Nanang Suryana, S.E., M.M.',
                'foto_kepala_jurusan' => 'nanang_suryana.jpg',
                'logo_jurusan'        => 'logo-pemasaran.jpeg',
                'foto'                => 'pms-1.jpg',
                'deskripsi'           => 'Kompetensi Keahlian Bisnis Daring dan Pemasaran (BDP) membekali siswa dengan keterampilan memasarkan produk dan jasa secara konvensional maupun digital, mengelola transaksi bisnis, serta memahami strategi promosi dan layanan pelanggan yang efektif. Siswa dibekali kompetensi mulai dari riset pasar, digital marketing (media sosial, marketplace, e-commerce), administrasi transaksi, pengelolaan toko daring maupun luring, hingga strategi negosiasi dan pelayanan prima. Lulusan disiapkan untuk berkarier sebagai tenaga pemasaran, admin toko online, digital marketer, wirausahawan mandiri, maupun melanjutkan pendidikan ke jenjang perguruan tinggi pada program studi bisnis dan manajemen pemasaran.',
            ],
            [
                'kode'                => 'pplg',
                'nama_jurusan'        => 'Pengembangan Perangkat Lunak dan Gim',
                'kepala_jurusan'      => 'Rahmat Setiawan, S.T.',
                'foto_kepala_jurusan' => 'rahmat_setiawan.jpg',
                'logo_jurusan'        => 'logo-pplg.jpeg',
                'foto'                => 'pplg-1.jpg',
                'deskripsi'           => 'Kompetensi Keahlian Pengembangan Perangkat Lunak dan Gim (PPLG) membekali siswa dengan keterampilan merancang, membangun, dan mengembangkan aplikasi, website, serta gim digital sesuai kebutuhan industri kreatif dan teknologi informasi. Siswa dibekali kompetensi mulai dari dasar pemrograman, basis data, pengembangan aplikasi berbasis web dan mobile, desain UI/UX, hingga pengembangan gim 2D/3D melalui pendekatan project-based learning dan kolaborasi dengan mitra industri teknologi. Lulusan disiapkan untuk berkarier sebagai programmer, web/mobile developer, game developer, maupun melanjutkan pendidikan ke jenjang perguruan tinggi pada program studi ilmu komputer dan rekayasa perangkat lunak.',
            ],
            [
                'kode'                => 'tkr',
                'nama_jurusan'        => 'Teknik Kendaraan Ringan',
                'kepala_jurusan'      => 'Romi Darmayadi, S.Pd., S.T.',
                'foto_kepala_jurusan' => 'romi_darmayadi.jpg',
                'logo_jurusan'        => 'logo-tkr.jpeg',
                'foto'                => 'rps.jpeg',
                'deskripsi'           => 'Kompetensi Keahlian Teknik Kendaraan Ringan (TKR) membekali siswa dengan keterampilan perawatan, perbaikan, dan pemeliharaan kendaraan bermotor roda empat, mulai dari sistem mesin, kelistrikan, hingga sasis dan pemindah tenaga. Siswa dibekali kompetensi mulai dari servis berkala, diagnosis kerusakan mesin, perbaikan sistem kelistrikan otomotif, overhaul komponen mesin, hingga perawatan kendaraan berbasis teknologi injeksi modern melalui praktik langsung di bengkel TKR. Lulusan disiapkan untuk berkarier sebagai teknisi bengkel resmi maupun umum, wirausahawan di bidang jasa otomotif, maupun melanjutkan pendidikan ke jenjang perguruan tinggi pada program studi teknik otomotif.',
            ],
        ];

        foreach ($data as $item) {
            Jurusan::updateOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}