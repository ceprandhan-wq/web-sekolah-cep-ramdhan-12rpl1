<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('jurusan')->get();
        $jurusans = Jurusan::all();

        return view('dashboard', compact('guru', 'jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'mapel' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:100',
            'staf' => 'nullable|boolean',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        $validated['staf'] = $request->boolean('staf');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/guru-guru'), $filename);
            $validated['foto'] = $filename;
        }

        Guru::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'mapel' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:100',
            'staf' => 'nullable|boolean',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        $validated['staf'] = $request->boolean('staf');

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('images/guru-guru/'.$guru->foto))) {
                unlink(public_path('images/guru-guru/'.$guru->foto));
            }
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/guru-guru'), $filename);
            $validated['foto'] = $filename;
        }

        $guru->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto && file_exists(public_path('images/guru-guru/'.$guru->foto))) {
            unlink(public_path('images/guru-guru/'.$guru->foto));
        }
        $guru->delete();

        return redirect()->route('dashboard')->with('success', 'Data guru berhasil dihapus.');
    }
}