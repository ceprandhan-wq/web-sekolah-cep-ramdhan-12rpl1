<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Halaman admin utama — "Kelola Semua Data".
     * Ini yang akan tampil setelah login berhasil.
     *
     * Catatan: updateProfil() sudah TIDAK ada di sini lagi — pindah ke
     * App\Http\Controllers\Admin\ProfilController@update, supaya satu
     * controller = satu tanggung jawab, sama seperti Jurusan, Guru, dst.
     */
    public function index()
    {
        $profil = class_exists(\App\Models\Profil::class)
            ? \App\Models\Profil::first()
            : null;

        $beranda = class_exists(\App\Models\Beranda::class)
            ? \App\Models\Beranda::first()
            : null;

        $jurusan = class_exists(\App\Models\Jurusan::class)
            ? \App\Models\Jurusan::all()
            : collect();

        $guru = class_exists(\App\Models\Guru::class)
            ? \App\Models\Guru::with('jurusan')->get()
            : collect();

        $ekskul = class_exists(\App\Models\Ekstrakurikuler::class)
            ? \App\Models\Ekstrakurikuler::all()
            : collect();

        $galeriVideo = class_exists(\App\Models\GaleriVideo::class)
            ? \App\Models\GaleriVideo::all()
            : collect();

        $artikel = class_exists(\App\Models\Artikel::class)
            ? \App\Models\Artikel::all()
            : collect();

        $agenda = class_exists(\App\Models\Agenda::class)
            ? \App\Models\Agenda::all()
            : collect();

        $fasilitas = class_exists(\App\Models\Fasilitas::class)
            ? \App\Models\Fasilitas::all()
            : collect();

        $prestasi = class_exists(\App\Models\Prestasi::class)
            ? \App\Models\Prestasi::all()
            : collect();

        // BARU: data seragam sekolah — dipakai di tab "Seragam" panel admin.
        $seragam = class_exists(\App\Models\Seragam::class)
            ? \App\Models\Seragam::orderBy('urutan')->get()
            : collect();

        // Dipakai untuk dropdown "Jurusan" di form Tambah/Edit Guru.
        $jurusanList = $jurusan;

               return view('admin.admin', compact(
            'profil', 'beranda', 'jurusan', 'guru', 'ekskul', 'galeriVideo',
            'artikel', 'agenda', 'fasilitas', 'prestasi', 'jurusanList', 'seragam'
        ));
    }
}