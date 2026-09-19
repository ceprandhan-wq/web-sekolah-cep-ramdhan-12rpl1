<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Field 'gambar' diisi NAMA FILE SAJA (tanpa folder), disimpan fisik
     * di public/images/pasilitas/ (bukan storage/app/public) — konsisten
     * dengan pola foto jurusan (public/images/jurusan).
     *
     * Blade akan merender lewat: asset('images/pasilitas/'.$f->gambar)
     *
     * Pastikan file berikut sudah ada di public/images/pasilitas/
     * dengan nama PERSIS SAMA (termasuk huruf besar/kecil):
     *   leb-aphp.JPG, leb-bdp.JPG, leb-rpl.JPG, musola_2_3.JPG
     */
    public function run(): void
    {
        $data = [
            [
                'nama_fasilitas' => 'Laboratorium RPL',
                'deskripsi'      => 'Ruang praktik siswa jurusan Rekayasa Perangkat Lunak dan Gim (PPLG/RPL), dilengkapi unit komputer untuk kegiatan pemrograman dan pengembangan perangkat lunak.',
                'gambar'         => 'leb-rpl.JPG',
            ],
            [
                'nama_fasilitas' => 'Laboratorium APHP',
                'deskripsi'      => 'Workshop Agroindustri Pengolahan Hasil Pertanian (APHP), tempat siswa mempraktikkan pengolahan dan pengemasan produk pangan menggunakan mesin produksi.',
                'gambar'         => 'leb-aphp.JPG',
            ],
            [
                'nama_fasilitas' => 'Laboratorium BDP',
                'deskripsi'      => 'Ruang praktik Bisnis Daring dan Pemasaran (BDP), tempat siswa mengelola booth penjualan dan berlatih pemasaran produk secara langsung.',
                'gambar'         => 'leb-bdp.JPG',
            ],
            [
                'nama_fasilitas' => 'Mushola',
                'deskripsi'      => 'Tempat ibadah bagi warga sekolah.',
                'gambar'         => 'musola_2_3.JPG',
            ],
            [
                'nama_fasilitas' => 'Laboratorium tkr/rps',
                'deskripsi'      => 'ruang rps sebagai tempat bagi siswa untuk mengaplikasikan teori pelajaran ke dalam bentuk praktik langsung dengan fasilitas yang menyerupai standar dunia industri.',
                'gambar'         => 'rps.jpeg',
            ],
             [
                'nama_fasilitas' => 'bimbingan konseling/bk',
                'deskripsi'      => 'Ruang Bimbingan Konseling (BK) di sekolah bertujuan sebagai tempat yang aman dan rahasia bagi siswa untuk berkonsultasi serta mendapatkan dukungan dalam mengatasi masalah pribadi, sosial, akademik, maupun karier.',
                'gambar'         => 'ruang-bk.jpeg',
            ],
        ];

        foreach ($data as $item) {
            Fasilitas::updateOrCreate(
                ['nama_fasilitas' => $item['nama_fasilitas']],
                $item
            );
        }
    }
}