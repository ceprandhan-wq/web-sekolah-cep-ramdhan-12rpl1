<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelRequest;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function store(ArtikelRequest $request)
    {
        $data = $request->safe()->except('gambar');

        if ($request->hasFile('gambar')) {
            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/artikel', $filename, 'public');
            $data['gambar'] = $filename;
        }

        Artikel::create($data);

        return back()->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(ArtikelRequest $request, Artikel $artikel)
    {
        $artikel->fill($request->safe()->except('gambar'));

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete('images/artikel/'.$artikel->gambar);
            }

            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/artikel', $filename, 'public');
            $artikel->gambar = $filename;
        }

        $artikel->save();

        return back()->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete('images/artikel/'.$artikel->gambar);
        }

        $artikel->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}