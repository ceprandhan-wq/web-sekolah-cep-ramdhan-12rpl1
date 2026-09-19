<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrestasiRequest;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function store(PrestasiRequest $request)
    {
        $data = $request->safe()->except('gambar');

        if ($request->hasFile('gambar')) {
            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/prestasi', $filename, 'public');
            $data['gambar'] = $filename;
        }

        Prestasi::create($data);

        return back()->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $prestasi->fill($request->safe()->except('gambar'));

        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar) {
                Storage::disk('public')->delete('images/prestasi/'.$prestasi->gambar);
            }
            $filename = $request->file('gambar')->hashName();
            $request->file('gambar')->storeAs('images/prestasi', $filename, 'public');
            $prestasi->gambar = $filename;
        }

        $prestasi->save();

        return back()->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->gambar) {
            Storage::disk('public')->delete('images/prestasi/'.$prestasi->gambar);
        }

        $prestasi->delete();
        return back()->with('success', 'Prestasi berhasil dihapus.');
    }
}