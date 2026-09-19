<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaSekolahRequest;
use App\Models\KepalaSekolah;
use Illuminate\Support\Facades\Storage;

class KepalaSekolahController extends Controller
{
    public function update(KepalaSekolahRequest $request)
    {
        $validated = $request->validated();

        $kepsek = KepalaSekolah::first() ?? new KepalaSekolah();

        $kepsek->nama     = $validated['kepsek_nama'];
        $kepsek->jabatan  = $validated['kepsek_jabatan'];
        $kepsek->sambutan = $validated['sambutan'];

        if ($request->hasFile('kepsek_foto')) {
            if ($kepsek->foto) {
                Storage::disk('public')->delete('images/'.$kepsek->foto);
            }

            $file = $request->file('kepsek_foto');
            $filename = 'kepsek-'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('images/beranda', $filename, 'public');

            $kepsek->foto = 'beranda/'.$filename;
        }

        $kepsek->save();

        return redirect()
            ->route('admin.dashboard', ['tab' => 'sambutan'])
            ->with('success', 'Sambutan Kepala Sekolah berhasil diperbarui.');
    }
}