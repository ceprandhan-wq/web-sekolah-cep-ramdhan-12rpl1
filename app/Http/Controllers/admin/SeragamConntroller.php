<?php

namespace App\Http\Controllers; // atau App\Http\Controllers\Admin — sesuaikan namespace file aslinya

use App\Http\Controllers\Controller;
use App\Models\Seragam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/beranda', $filename, 'public');
            $validated['foto'] = $filename;
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
            if ($seragam->foto) {
                Storage::disk('public')->delete('images/beranda/'.$seragam->foto);
            }

            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/beranda', $filename, 'public');
            $validated['foto'] = $filename;
        }

        $seragam->update($validated);

        return back()->with('success', 'Seragam berhasil diperbarui.');
    }

    public function destroy(Seragam $seragam)
    {
        if ($seragam->foto) {
            Storage::disk('public')->delete('images/beranda/'.$seragam->foto);
        }

        $seragam->delete();
        return back()->with('success', 'Seragam berhasil dihapus.');
    }
}