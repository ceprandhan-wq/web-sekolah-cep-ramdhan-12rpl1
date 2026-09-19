<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    protected function payload(GuruRequest $request): array
    {
        $validated = $request->validated();

        return [
            'nama'       => $validated['nama'],
            'nip'        => $validated['nip'] ?? '-',
            'staf'       => $request->boolean('staf'),
            'mapel'      => $validated['mapel'] ?? null,
            'jabatan'    => $validated['jabatan'] ?? null,
            'jurusan_id' => $validated['jurusan_id'] ?? null,
        ];
    }

    public function store(GuruRequest $request)
    {
        $data = $this->payload($request);

        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/guru-guru', $filename, 'public');
            $data['foto'] = $filename;
        }

        Guru::create($data);

        return back()->with('success', 'Guru/Staff berhasil ditambahkan.');
    }

    public function update(GuruRequest $request, Guru $guru)
    {
        $guru->fill($this->payload($request));

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete('images/guru-guru/'.$guru->foto);
            }
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/guru-guru', $filename, 'public');
            $guru->foto = $filename;
        }

        $guru->save();

        return back()->with('success', 'Guru/Staff berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete('images/guru-guru/'.$guru->foto);
        }

        $guru->delete();
        return back()->with('success', 'Guru/Staff berhasil dihapus.');
    }
}