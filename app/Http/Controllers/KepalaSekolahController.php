<?php

namespace App\Http\Controllers;

use App\Models\KepalaSekolah;

class KepalaSekolahController extends Controller
{
    /**
     * Ambil data Kepala Sekolah (nama, jabatan, foto, sambutan) untuk
     * ditampilkan di halaman publik (Beranda & Pegawai).
     *
     * Dipanggil sebagai helper dari route utama '/' via:
     *   $kepalaSekolah = (new KepalaSekolahController)->data();
     *
     * Bukan halaman tersendiri — karena datanya tunggal (satu baris)
     * dan tampil menyatu di dalam halaman Beranda, bukan di URL terpisah.
     */
    public function data(): ?KepalaSekolah
    {
        return KepalaSekolah::first();
    }
}