<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $daftarArtikel = [
            ['judul' => 'Konsentrasi Keahlian APHP — Agribisnis Pengolahan Hasil Pertanian', 'ringkasan' => 'Mengenal program keahlian Agribisnis Pengolahan Hasil Pertanian (APHP): belajar mengolah hasil pertanian jadi produk bernilai jual hingga prospek karier alumninya.', 'gambar' => 'brosur-aphp.jpeg', 'tanggal' => '2026-08-30'],
            ['judul' => 'Rekap Ekskul Mingguan — Satu Nada Satu Jiwa', 'ringkasan' => 'Rekap kegiatan ekstrakurikuler mingguan SMK Negeri 1 Cijati di RPS TKR, mengangkat semangat "Satu Nada Satu Jiwa".', 'gambar' => 'rekap-ekskul-mingguan.jpeg', 'tanggal' => '2026-08-29'],
            ['judul' => 'Kelengkapan Kelas — Kelas Nyaman, Belajar Menyenangkan', 'ringkasan' => 'Panduan kelengkapan kelas SMK Negeri 1 Cijati agar proses belajar mengajar berjalan efektif, tertib, dan menyenangkan.', 'gambar' => 'kelengkapan-kelas.jpeg', 'tanggal' => '2026-08-28'],
            ['judul' => 'Penutupan MPLS Pancawaluya', 'ringkasan' => 'Rangkaian Masa Pengenalan Lingkungan Sekolah (MPLS) Pancawaluya resmi ditutup pada Selasa, 22 Juli 2026.', 'gambar' => 'penutupan-mpls-pancawaluya.jpeg', 'tanggal' => '2026-08-27'],
            ['judul' => 'Program Keahlian & Ekstrakurikuler SMK Negeri 1 Cijati', 'ringkasan' => 'Sekilas program keahlian dan peluang karier lulusan, serta daftar ekstrakurikuler yang bisa diikuti siswa SMK Negeri 1 Cijati.', 'gambar' => 'program-keahlian-ekstrakurikuler.jpeg', 'tanggal' => '2026-08-26'],
            ['judul' => 'Konsentrasi Keahlian Pemasaran — Bisnis Digital & Bisnis Ritel', 'ringkasan' => 'Mengenal program keahlian Bisnis Digital dan Bisnis Ritel (Pemasaran): jualan online, strategi promosi media sosial, hingga jejak karier alumni.', 'gambar' => 'brosur-pemasaran-bd.jpeg', 'tanggal' => '2026-08-25'],
            ['judul' => 'SEHATI — Selasa Sehat Siswa-Siswi SMKN 1 Cijati', 'ringkasan' => 'Program Senam Pagi rutin setiap hari Selasa untuk menjaga kebugaran dan kesehatan siswa-siswi SMK Negeri 1 Cijati.', 'gambar' => 'senam-pagi-sehati.jpeg', 'tanggal' => '2026-08-24'],
            ['judul' => 'MPLS Pancawaluya — Hari ke-5', 'ringkasan' => 'Siswa baru mengikuti kegiatan gotong royong membersihkan lingkungan dan selokan sekitar sekolah pada hari kelima MPLS Pancawaluya.', 'gambar' => 'mpls-pancawaluya-day5.jpeg', 'tanggal' => '2026-08-23'],
            ['judul' => 'Upacara Memperingati HUT Ke-81 Republik Indonesia', 'ringkasan' => 'Upacara memperingati HUT ke-81 Republik Indonesia digelar khidmat dengan Kepala Sekolah bertindak sebagai pembina upacara.', 'gambar' => 'upacara-hut-81-ri.jpeg', 'tanggal' => '2026-08-22'],
            ['judul' => 'Pengukuhan Pasukan Pengibar Bendera Kecamatan Cijati', 'ringkasan' => '14 perwakilan SMK Negeri 1 Cijati resmi dikukuhkan sebagai Pasukan Pengibar Bendera (Paskibra) tingkat Kecamatan Cijati.', 'gambar' => 'pengukuhan-paskibra-kecamatan.jpeg', 'tanggal' => '2026-08-21'],
            ['judul' => 'Konsentrasi Keahlian TKR — Teknik Kendaraan Ringan', 'ringkasan' => 'Mengenal program keahlian Teknik Kendaraan Ringan (TKR): materi pembelajaran, praktik perbengkelan, hingga jejak karier para alumninya.', 'gambar' => 'brosur-tkr.jpeg', 'tanggal' => '2026-08-20'],
            ['judul' => 'Dirgahayu Republik Indonesia ke-81', 'ringkasan' => 'Segenap keluarga besar SMK Negeri 1 Cijati menyampaikan ucapan Dirgahayu Republik Indonesia ke-81, 17 Agustus 2026.', 'gambar' => 'dirgahayu-ri-81.jpeg', 'tanggal' => '2026-08-19'],
            ['judul' => 'Ilham Sulaeman, Paskibra Pusaka Kabupaten Cianjur', 'ringkasan' => 'Selamat dan sukses kepada Ilham Sulaeman, siswa SMK Negeri 1 Cijati, atas pengukuhannya sebagai Pasukan Pengibar Bendera Pusaka tingkat Kabupaten Cianjur.', 'gambar' => 'ilham-sulaeman-paskibra-kabupaten.jpeg', 'tanggal' => '2026-08-18'],
            ['judul' => 'MPLS Pancawaluya — Hari ke-2', 'ringkasan' => 'Rangkaian Masa Pengenalan Lingkungan Sekolah (MPLS) Pancawaluya hari kedua diisi dengan pemeriksaan kesehatan bagi seluruh siswa baru.', 'gambar' => 'mpls-pancawaluya-day2.jpeg', 'tanggal' => '2026-08-17'],
            ['judul' => 'Upacara Peringatan Hari Pramuka ke-65', 'ringkasan' => 'Upacara memperingati Hari Pramuka ke-65 pada 14 Agustus 2026 diikuti seluruh siswa sebagai wujud semangat kepramukaan.', 'gambar' => 'upacara-hari-pramuka.jpeg', 'tanggal' => '2026-08-16'],
            ['judul' => 'Konsentrasi Keahlian PPLG — Rekayasa Perangkat Lunak', 'ringkasan' => 'Mengenal program keahlian Pengembangan Perangkat Lunak dan Gim (PPLG): belajar coding, desain UI/UX, hingga prospek karier alumni di bidang IT.', 'gambar' => 'brosur-pplg.jpeg', 'tanggal' => '2026-08-15'],
            ['judul' => 'Program Keahlian SMK Negeri 1 Cijati', 'ringkasan' => 'Sekilas tentang program-program keahlian yang tersedia di SMK Negeri 1 Cijati sebagai bekal siswa menuju dunia kerja dan industri.', 'gambar' => 'program-keahlian-smkn1cijati.jpeg', 'tanggal' => '2026-08-14'],
            ['judul' => 'Seragam Harian Siswa-Siswi SMKN 1 Cijati', 'ringkasan' => 'Ketentuan seragam harian siswa-siswi untuk hari Senin sampai Jumat, mulai dari seragam formal, pramuka, hingga pakaian olahraga.', 'gambar' => 'foto-seragam.jpeg', 'tanggal' => '2026-08-13'],
            ['judul' => 'Panter Vol 2 — Pendidikan Akhlak dan Karakter', 'ringkasan' => 'Program Panter Volume 2 kembali digelar bekerja sama dengan TNI AD untuk membentuk disiplin dan mental siswa.', 'gambar' => 'panter-vol-2_22.jpg', 'tanggal' => '2026-08-11'],
            ['judul' => 'Panter Vol 2 — Sambutan Pembina Kegiatan', 'ringkasan' => 'Rangkaian kegiatan Panter Vol 2 turut dihadiri jajaran pembina dan pelatih dari TNI AD sebagai bentuk sinergi dengan aparat setempat.', 'gambar' => 'panter-vol2.jpg', 'tanggal' => '2026-08-09'],
            ['judul' => 'Upacara Bendera di Lingkungan RPS TKR', 'ringkasan' => 'Kegiatan upacara bendera rutin diikuti siswa-siswi sebagai bentuk penanaman rasa nasionalisme dan kedisiplinan.', 'gambar' => 'poto-upacara.jpg', 'tanggal' => '2026-08-07'],
            ['judul' => 'Pesantren Ekologi 2026', 'ringkasan' => 'Bersih hati, bersih badan, bersih lingkungan — sekolah menggelar Pesantren Ekologi untuk menumbuhkan kepedulian siswa terhadap lingkungan.', 'gambar' => 'psantren-ekologi-2026.jpg', 'tanggal' => '2026-08-05'],
            ['judul' => 'Relasi: Rabu Literasi', 'ringkasan' => 'Program Rabu Literasi menjadi agenda rutin untuk menumbuhkan minat baca siswa dan guru di sekolah yang telah terakreditasi A.', 'gambar' => 'relasi.jpg', 'tanggal' => '2026-08-03'],
            ['judul' => 'Himbauan Pakai Masker — Waspada Sebaran Abu Vulkanik Anak Krakatau', 'ringkasan' => 'Sehubungan dengan erupsi Gunung Anak Krakatau dan potensi sebaran abu vulkanik, seluruh warga SMK Negeri 1 Cijati diimbau menggunakan masker, melindungi makanan dan minuman, serta membatasi aktivitas di luar ruangan.', 'gambar' => 'himbauan-pakai-masker.jpeg', 'tanggal' => '2026-09-07'],
            ['judul' => 'COMING SOON! JATIZI FEST 2026 — SEASON 2 "HARMONI"', 'ringkasan' => 'Hari Unjuk Kabisa, Olahraga & Kreasi Seni — satu panggung, beragam talenta. "Bersatu dalam karya, bersaudara dalam laga." Stay tuned, November 2026!', 'gambar' => 'jatiji.jpeg', 'tanggal' => '2026-11-15'],
        ];

        foreach ($daftarArtikel as $b) {
            Artikel::updateOrCreate(
                ['judul' => $b['judul']],
                [
                    'ringkasan'  => $b['ringkasan'],
                    'gambar'     => $b['gambar'],
                    'created_at' => $b['tanggal'],
                    'updated_at' => $b['tanggal'],
                ]
            );
        }
    }
}