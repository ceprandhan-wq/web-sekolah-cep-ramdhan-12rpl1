<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function store(FasilitasRequest $request)
    {
        $data = $request->safe()->except('gambar');

        if ($request->hasFile('gambar')) {
            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/pasilitas', $filename, 'public');
            $data['gambar'] = $filename;
        }

        Fasilitas::create($data);

        return back()->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(FasilitasRequest $request, Fasilitas $fasilitas)
    {
        $fasilitas->fill($request->safe()->except('gambar'));

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar) {
                Storage::disk('public')->delete('images/pasilitas/'.$fasilitas->gambar);
            }
            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/pasilitas', $filename, 'public');
            $fasilitas->gambar = $filename;
        }

        $fasilitas->save();

        return back()->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        if ($fasilitas->gambar) {
            Storage::disk('public')->delete('images/pasilitas/'.$fasilitas->gambar);
        }

        $fasilitas->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}