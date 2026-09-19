<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use Illuminate\Database\Seeder;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Rohis',
                'jadwal' => 'kamis, 15.00 – 17.00',
                'lokasi' => 'Mushola Sekolah',
                'foto' => 'ekskul/foto kegiatan rohis.jpg',
                'logo' => 'ekskul/rohis.jpg',
                'deskripsi' => 'Ekstrakurikuler Rohani Islam yang membina keimanan dan ketakwaan siswa melalui kajian keislaman, tadarus, peringatan hari besar Islam, serta pembinaan akhlak dan kepribadian muslim.',
                'kegiatan_rutin' => ['Kajian keislaman rutin', 'Tadarus Al-Quran bersama', 'Peringatan hari besar Islam'],
                'nama_pembina' => 'Asep Muhlis Sulaeman',
            ],
            [
                'nama' => 'Cinemak',
                'jadwal' => 'Senin, 15.00 – 17.00',
                'lokasi' => 'Ruang Multimedia',
                'foto' => 'ekskul/foto kegiatan cinemak.jpg',
                'logo' => 'ekskul/cinemak.jpg',
                'deskripsi' => 'Ekstrakurikuler perfilman yang mengasah kreativitas siswa dalam produksi video, penulisan naskah, sinematografi, dan editing, serta melatih kerja sama tim dalam proses pembuatan film.',
                'kegiatan_rutin' => ['Latihan produksi & pengambilan gambar', 'Penulisan naskah dan storyboard', 'Pemutaran karya siswa'],
                'nama_pembina' => 'Rahmat Setiawan',
            ],
            [
                'nama' => 'Voli Bal',
                'jadwal' => 'Selasa-senin (Putra), Rabu (Putri), 15.00 – 17.00',
                'lokasi' => 'Lapangan Voli Sekolah',
                'foto' => 'ekskul/foto kegiatan voli.jpg',
                'logo' => 'ekskul/voli.jpg',
                'deskripsi' => 'Ekstrakurikuler olahraga bola voli yang melatih teknik dasar passing, servis, smash, dan blok, serta membangun kekompakan tim untuk mengikuti pertandingan antarsekolah.',
                'kegiatan_rutin' => ['Latihan teknik dasar passing & smash', 'Latih tanding antar kelas', 'Persiapan turnamen antarsekolah'],
                'nama_pembina' => 'Dedi Sukardi',
            ],
            [
                'nama' => 'PMR',
                'jadwal' => 'Selasa, 15.00 – 17.00',
                'lokasi' => 'Ruang UKS',
                'foto' => 'ekskul/foto kegiatan pmr.jpg',
                'logo' => 'ekskul/pmr.jpg',
                'deskripsi' => 'Palang Merah Remaja yang membekali siswa dengan keterampilan pertolongan pertama, kesiapsiagaan bencana, kepemimpinan, serta menumbuhkan jiwa sosial dan kepedulian kesehatan.',
                'kegiatan_rutin' => ['Pelatihan pertolongan pertama', 'Simulasi kesiapsiagaan bencana', 'Kegiatan bakti sosial'],
                'nama_pembina' => 'Mega Nurunnisa',
            ],
            [
                'nama' => 'Karawitan',
                'jadwal' => 'Rabu, 15.00 – 17.00',
                'lokasi' => 'Sanggar Seni Sekolah',
                'foto' => 'ekskul/foto kegiatan karawitan.jpg',
                'logo' => 'ekskul/karawitan.jpg',
                'deskripsi' => 'Ekstrakurikuler seni musik tradisional gamelan yang melestarikan budaya daerah melalui latihan menabuh alat musik karawitan dan pementasan pada acara sekolah maupun budaya.',
                'kegiatan_rutin' => ['Latihan menabuh gamelan', 'Pementasan seni budaya sekolah', 'Kolaborasi acara adat setempat'],
                'nama_pembina' => 'Moch. Yoga Agung N.',
            ],
            [
                'nama' => 'Futsal',
                'jadwal' => 'rabu-kamis (Putra), Kamis (Putri), 15.00 – 17.00',
                'lokasi' => 'Lapangan Futsal Sekolah',
                'foto' => 'ekskul/foto kegiatan futsal.jpg',
                'logo' => 'ekskul/futsal.jpg',
                'deskripsi' => 'Ekstrakurikuler olahraga futsal yang mengasah teknik dasar mengumpan, menggiring, dan menyerang, membangun sportivitas, serta mempersiapkan tim untuk kompetisi antarsekolah.',
                'kegiatan_rutin' => ['Latihan mengumpan & menggiring bola', 'Latih tanding antar kelas', 'Kompetisi futsal antarsekolah'],
                'nama_pembina' => 'Ramdan Bastaman',
            ],
            [
                'nama' => 'Pramuka',
                'jadwal' => "Jum'at, 12.45 – 13.00",
                'lokasi' => 'Lapangan Sekolah',
                'foto' => 'ekskul/foto kegiatan pramuka.jpg',
                'logo' => 'ekskul/pramuka.jpg',
                'deskripsi' => 'Gerakan Pramuka yang membentuk karakter disiplin, kemandirian, kepemimpinan, dan cinta alam melalui kegiatan kepramukaan, baris-berbaris, tali-temali, dan kegiatan alam terbuka.',
                'kegiatan_rutin' => ['Latihan baris-berbaris & tali-temali', 'Kegiatan alam terbuka', 'Persiapan perkemahan/jambore'],
                'dokumentasi' => [
                    'ekskul/dokumentasi/pramuka-1.jpg',
                    'ekskul/dokumentasi/pramuka-2.jpg',
                    'ekskul/dokumentasi/pramuka-3.jpg',
                ],
                'nama_pembina' => ' Najib ',
            ],
            [
                'nama' => 'Paskibra',
                'jadwal' => 'Sabtu, 06.45 – 11.45',
                'lokasi' => 'Lapangan Upacara Sekolah',
                'foto' => 'ekskul/foto kegiatan paskibra.jpg',
                'logo' => 'ekskul/paskibra.jpg',
                'deskripsi' => 'Pasukan Pengibar Bendera yang melatih kedisiplinan, baris-berbaris, dan tata upacara bendera untuk mempersiapkan siswa bertugas sebagai pengibar bendera pada upacara resmi sekolah.',
                'kegiatan_rutin' => ['Latihan baris-berbaris', 'Latihan tata upacara bendera', 'Persiapan petugas upacara'],
                'nama_pembina' => 'Ende Iskandar',
            ],
            [
                // NB: sebelumnya "Marchingband" (satu kata) -> diubah jadi dua
                // kata biar tampilannya rapi & cocok dengan judul di halaman detail.
                'nama' => 'Marching Band',
                'jadwal' => 'Sabtu, 08.00 – 11.00',
                'lokasi' => 'Lapangan Sekolah',
                'foto' => 'ekskul/foto kegiatan marchingband.jpg',
                'logo' => 'ekskul/marchingband.jpg',
                'deskripsi' => 'Marching Band melatih siswa bermain alat musik tiup dan perkusi secara berkelompok sekaligus formasi baris-berbaris yang atraktif. Kegiatan ini terbuka untuk seluruh siswa yang ingin mengembangkan bakat musik dan kekompakan tim dalam sebuah pertunjukan.',
                'kegiatan_rutin' => ['Latihan alat musik dan formasi', 'Tampil pada acara sekolah dan kota', 'Kompetisi marching band antar sekolah'],
                'dokumentasi' => [
                    'ekskul/dokumentasi/marchingband-1.jpg',
                    'ekskul/dokumentasi/marchingband-2.jpg',
                    'ekskul/foto kegiatan marchingband.jpg',
                ],
                'nama_pembina' => 'Nurah Alwaini',
            ],
            [
                'nama' => 'Jepang',
                'jadwal' => 'Senin, 15.00 – 17.00',
                'lokasi' => 'Ruang Kelas',
                'foto' => 'ekskul/jepang.jpg',
                'logo' => 'ekskul/jepang.jpg',
                'deskripsi' => 'Ekstrakurikuler bahasa dan budaya Jepang yang mengenalkan siswa pada percakapan dasar bahasa Jepang, huruf hiragana/katakana, serta budaya seperti kaligrafi dan tradisi Jepang.',
                'kegiatan_rutin' => ['Belajar percakapan dasar bahasa Jepang', 'Latihan menulis hiragana & katakana', 'Pengenalan budaya Jepang'],
                'nama_pembina' => 'Saripul Basar',
            ],
        ];

        foreach ($data as $item) {
            // Cari guru berdasarkan nama, dua arah: cocok kalau nama di seeder
            // lebih panjang dari nama di database (mis. "Asep Muhlis Sulaeman"
            // vs "Asep Muhlis"), maupun sebaliknya (mis. " Najib " vs "Najib Hidayat").
            $namaPembina = trim($item['nama_pembina']);

            $pembina = Guru::where('nama', 'like', '%' . $namaPembina . '%')
                ->orWhereRaw("? LIKE CONCAT('%', nama, '%')", [$namaPembina])
                ->first();

            Ekstrakurikuler::updateOrCreate(
                ['nama' => $item['nama']],
                [
                    'jadwal'         => $item['jadwal'],
                    'lokasi'         => $item['lokasi'],
                    'foto'           => $item['foto'],
                    'logo'           => $item['logo'],
                    'status'         => 'aktif',
                    'deskripsi'      => $item['deskripsi'],
                    'kegiatan_rutin' => $item['kegiatan_rutin'],
                    'dokumentasi'    => $item['dokumentasi'] ?? [], // isi lewat panel admin setelah foto kegiatan diunggah
                    'id_pembina'     => $pembina?->id,
                ]
            );
        }
    }
}