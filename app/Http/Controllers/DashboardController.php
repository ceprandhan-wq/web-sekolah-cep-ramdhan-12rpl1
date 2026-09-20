<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Notifikasi;
use App\Models\KepalaSekolah;
use App\Models\Artikel;
use App\Models\Agenda;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;     // pastikan model & tabel ini ada
use App\Models\GaleriVideo;  // pastikan model & tabel ini ada (ganti dari Galeri)
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $profil         = Profil::first();
        $kepalaSekolah  = KepalaSekolah::first();
        $sambutanKepsek = $kepalaSekolah->sambutan ?? null;

        $artikel = Artikel::latest()->take(4)->get(); // blade ->take(3) sendiri di halaman beranda
        $agenda  = Agenda::orderBy('tanggal')->take(5)->get();
        $jurusan = Jurusan::all();
        $guru    = Guru::with('jurusan')->get(); // ⬅️ DIUBAH: eager load relasi jurusan

        // ⬅️ BARU: variabel ini ada di compact() tetapi sebelumnya tidak pernah dibuat (error Undefined variable)
        $berita     = $artikel;
        $notifikasi = null;

        // Catatan: dashboard.blade.php TIDAK memakai variabel ini untuk daftar ekskul
        // (blade pakai array hardcode $daftarEkskul). Tetap dikirim untuk jaga-jaga
        // kalau dipakai di view/partial lain (mis. ekskul.tkr, ekskul.pramuka, dst).
        $ekskul = Ekstrakurikuler::with('pembina')->get();

        // WAJIB ditambahkan — dipakai blade untuk section "Prestasi"
        $prestasi = Prestasi::latest()->take(3)->get();

        // WAJIB ditambahkan (dan nama variabelnya harus $galeriVideo, bukan $galeri)
        // — dipakai blade untuk section "Galeri Video"
        $galeriVideo = GaleriVideo::latest()->take(6)->get();

        // ⬅️ DIUBAH: 'dashboard' -> 'home.dashboard'
        return view('home.dashboard', compact(
            'profil',
            'notifikasi',
            'kepalaSekolah',
            'sambutanKepsek',
            'berita',
            'agenda',
            'jurusan',
            'guru',
            'ekskul',
            'prestasi',
            'galeriVideo'
        ));
    }

    public function updateProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'nullable|string|max:255',
            'npsn'         => 'nullable|string|max:50',
            'alamat'       => 'nullable|string|max:255',
            'telepon'      => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:255',
            'website'      => 'nullable|string|max:255',
            'visi'         => 'nullable|string',
            'misi'         => 'nullable|string',
        ]);

        $profil = Profil::first();

        if (!$profil) {
            $profil = new Profil();
        }

        $profil->fill($validated);
        $profil->save();

        return response()->json([
            'message' => 'Profil sekolah berhasil diperbarui.',
            'data'    => $profil,
        ]);
    }
}