<?php
// app/Http/Controllers/SeragamController.php
namespace App\Http\Controllers;

use App\Models\Seragam;
use Illuminate\Http\Request;

class SeragamController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan'    => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = $file->hashName();
            $file->move(public_path('images/beranda'), $fileName);
            $validated['foto'] = $fileName; // ⬅️ HANYA nama file, tanpa 'images/beranda/'
        }

        Seragam::create($validated);

        return back()->with('success', 'Seragam berhasil ditambahkan.');
    }

    public function update(Request $request, Seragam $seragam)
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan'    => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('foto')) {
            if ($seragam->foto && file_exists(public_path('images/beranda/'.$seragam->foto))) {
                unlink(public_path('images/beranda/'.$seragam->foto));
            }

            $file = $request->file('foto');
            $fileName = $file->hashName();
            $file->move(public_path('images/beranda'), $fileName);
            $validated['foto'] = $fileName; // ⬅️ HANYA nama file
        }

        $seragam->update($validated);

        return back()->with('success', 'Seragam berhasil diperbarui.');
    }

    public function destroy(Seragam $seragam)
    {
        if ($seragam->foto && file_exists(public_path('images/beranda/'.$seragam->foto))) {
            unlink(public_path('images/beranda/'.$seragam->foto));
        }
        $seragam->delete();

        return back()->with('success', 'Seragam berhasil dihapus.');
    }
}