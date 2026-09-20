<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Beranda;
use App\Models\GaleriVideo;
use App\Models\Prestasi;
use App\Models\Profil;
use App\Models\Seragam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BerandaController extends Controller
{
    public function index()
    {
        // ---- Profil Sekolah (nama, moto, sejarah, visi-misi, kontak, foto) ----
        $profil = Profil::first();

        $beranda = Beranda::first();

        // ---- Sambutan Kepala Sekolah ----
        $kepalaSekolah = $beranda && $beranda->kepsek_nama ? (object) [
            'nama'    => $beranda->kepsek_nama,
            'jabatan' => $beranda->kepsek_jabatan,
            'foto'    => $beranda->kepsek_foto,
        ] : null;

        $sambutanKepsek = $beranda->sambutan ?? null;

        // ---- Seragam Sekolah ----
        $seragam = Seragam::orderBy('urutan')->get();

        // ---- Artikel Terbaru (untuk beranda) ----
        $artikelBeranda = Artikel::latest()->take(6)->get()->map(function ($item) {
            return [
                'foto'    => $item->gambar ? 'storage/images/artikel/'.$item->gambar : null,
                'judul'   => $item->judul,
                'tanggal' => optional($item->created_at)->translatedFormat('d F Y'),
                'excerpt' => Str::limit($item->ringkasan, 120),
            ];
        });

        // ---- Galeri Video ----
        $galeriVideo = GaleriVideo::orderBy('urutan')->get();

        // ---- Prestasi ----
        $prestasi = Prestasi::latest()->get();

        // ---- Statistik Sekolah ----
        // jumlah_siswa & jumlah_guru diisi manual lewat admin (lihat method update()).
        $jumlahSiswa = $beranda->jumlah_siswa ?? 0;
        $jumlahGuru  = $beranda->jumlah_guru ?? 0;

        // ⬅️ DIUBAH: 'dashboard' -> 'home.dashboard'
        return view('home.dashboard', compact(
            'profil',
            'kepalaSekolah',
            'sambutanKepsek',
            'seragam',
            'artikelBeranda',
            'galeriVideo',
            'prestasi',
            'jumlahSiswa',
            'jumlahGuru'
        ));
    }

    public function edit()
    {
        $profil      = Profil::first() ?? new Profil();
        $beranda     = Beranda::first() ?? new Beranda();
        $seragam     = Seragam::orderBy('urutan')->get();
        $galeriVideo = GaleriVideo::orderBy('urutan')->get();
        $prestasi    = Prestasi::latest()->get();

        return view('admin.beranda.edit', compact('profil', 'beranda', 'seragam', 'galeriVideo', 'prestasi'));
    }

    /**
     * Update data Profil Sekolah (nama, moto, sejarah, visi-misi, kontak, foto).
     */
    public function updateProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'moto'         => ['nullable', 'string', 'max:255'],
            'npsn'         => ['nullable', 'string', 'max:50'],
            'alamat'       => ['nullable', 'string'],
            'telepon'      => ['nullable', 'string', 'max:30'],
            'email'        => ['nullable', 'email', 'max:255'],
            'website'      => ['nullable', 'string', 'max:255'],
            'sejarah'      => ['nullable', 'string'],
            'visi'         => ['nullable', 'string'],
            'misi'         => ['nullable', 'array'],
            'misi.*'       => ['string'],

            'logo'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'foto_hero'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'foto_sambutan' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $profil = Profil::first();

        $data = collect($validated)
            ->except(['logo', 'foto_hero', 'foto_sambutan'])
            ->toArray();

        foreach (['logo', 'foto_hero', 'foto_sambutan'] as $field) {
            if ($request->hasFile($field)) {
                if ($profil && $profil->{$field}) {
                    Storage::disk('public')->delete('images/'.$profil->{$field});
                }

                $fileName = $request->file($field)->hashName();
                $request->file($field)->storeAs('images', $fileName, 'public');
                $data[$field] = $fileName;
            }
        }

        Profil::updateOrCreate(
            ['id' => $profil->id ?? null],
            $data
        );

        return redirect()->back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    /**
     * Update data Beranda: sambutan kepala sekolah & statistik sekolah.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Sambutan kepala sekolah
            'kepsek_nama'    => ['nullable', 'string', 'max:255'],
            'kepsek_jabatan' => ['nullable', 'string', 'max:255'],
            'sambutan'       => ['nullable', 'string'],

            // Statistik
            'jumlah_siswa' => ['nullable', 'integer', 'min:0'],
            'jumlah_guru'  => ['nullable', 'integer', 'min:0'],

            // File upload
            'kepsek_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $beranda = Beranda::first();

        $data = collect($validated)
            ->except(['kepsek_foto'])
            ->toArray();

        if ($request->hasFile('kepsek_foto')) {
            if ($beranda && $beranda->kepsek_foto) {
                Storage::disk('public')->delete('images/'.$beranda->kepsek_foto);
            }

            $fileName = $request->file('kepsek_foto')->hashName();
            $request->file('kepsek_foto')->storeAs('images', $fileName, 'public');
            $data['kepsek_foto'] = $fileName;
        }

        Beranda::updateOrCreate(
            ['id' => $beranda->id ?? null],
            $data
        );

        return redirect()->back()->with('success', 'Konten beranda berhasil diperbarui.');
    }
}