<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Halaman daftar semua artikel (publik).
     */
    public function index()
    {
        $artikel = Artikel::latest()->paginate(9)->through(function ($item) {
            return $this->format($item);
        });

        return view('artikel.index', compact('artikel'));
    }

    /**
     * Halaman detail satu artikel (publik).
     * Route model binding pakai slug kalau kolomnya ada, kalau tidak pakai id.
     */
    public function show(Artikel $artikel)
    {
        $data = $this->format($artikel);

        // Artikel terkait/lainnya untuk ditampilkan di sidebar, opsional
        $artikelLain = Artikel::where('id', '!=', $artikel->id)
            ->latest()
            ->take(4)
            ->get()
            ->map(fn ($item) => $this->format($item));

        return view('artikel.show', [
            'artikel'     => $data,
            'artikelLain' => $artikelLain,
        ]);
    }

    /**
     * Susun data artikel supaya konsisten dipakai di semua view
     * (index, show, maupun beranda).
     */
    protected function format(Artikel $item): array
    {
        return [
            'id'      => $item->id,
            'foto'    => $item->gambar ? 'storage/images/artikel/'.$item->gambar : null,
            'judul'   => $item->judul,
            'isi'     => $item->isi ?? null,
            'tanggal' => optional($item->created_at)->translatedFormat('d F Y'),
            'excerpt' => Str::limit($item->ringkasan, 120),
        ];
    }
}