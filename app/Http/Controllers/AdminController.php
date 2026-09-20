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

        // ⬅️ BARU: dipakai tab "Sambutan Kepala Sekolah" di admin.admin
        $kepalaSekolah = class_exists(\App\Models\KepalaSekolah::class)
            ? \App\Models\KepalaSekolah::first()
            : null;

        // ⬅️ BARU: dipakai tab "Statistik Sekolah" di admin.admin
        $statistik = class_exists(\App\Models\Statistik::class)
            ? \App\Models\Statistik::first()
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
            
                    $kontak = class_exists(\App\Models\Kontak::class)
            ? \App\Models\Kontak::first()
            : null;

        // BARU: data seragam sekolah — dipakai di tab "Seragam" panel admin.
        $seragam = class_exists(\App\Models\Seragam::class)
            ? \App\Models\Seragam::orderBy('urutan')->get()
            : collect();

        // Dipakai untuk dropdown "Jurusan" di form Tambah/Edit Guru.
        $jurusanList = $jurusan;

        // ⬅️ DIUBAH: ditambah 'kepalaSekolah' dan 'statistik'
        return view('admin.admin', compact(
            'profil', 'beranda', 'kepalaSekolah', 'statistik', 'jurusan', 'guru', 'ekskul', 'galeriVideo',
            'artikel', 'agenda', 'fasilitas', 'prestasi', 'jurusanList', 'seragam'
        ));
    }
}