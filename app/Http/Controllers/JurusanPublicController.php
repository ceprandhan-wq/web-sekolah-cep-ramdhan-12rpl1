<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;

class JurusanPublicController extends Controller
{
    /** Halaman Detail Jurusan - Teknik Kendaraan Ringan (TKR) */
    public function tkr()
    {
        $jurusan = Jurusan::where('kode', 'tkr')->firstOrFail();
        return view('jurusan.tkr', compact('jurusan'));
    }

    /** Halaman Detail Jurusan - Bisnis Daring dan Pemasaran (PMS) */
    public function pms()
    {
        $jurusan = Jurusan::where('kode', 'pms')->firstOrFail();
        return view('jurusan.pms', compact('jurusan'));
    }

    /** Halaman Detail Jurusan - Pengembangan Perangkat Lunak dan Gim (PPLG) */
    public function pplg()
    {
        $jurusan = Jurusan::where('kode', 'pplg')->firstOrFail();
        return view('jurusan.pplg', compact('jurusan'));
    }

    /** Halaman Detail Jurusan - Agriteknologi Pengolahan Hasil Pertanian (APHP) */
    public function aphp()
    {
        $jurusan = Jurusan::where('kode', 'aphp')->firstOrFail();
        return view('jurusan.aphp', compact('jurusan'));
    }
}