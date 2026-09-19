<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BerandaRequest;
use App\Models\Beranda;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function update(BerandaRequest $request)
    {
        $validated = $request->validated();

        $beranda = Beranda::first() ?? new Beranda();

        $data = collect($validated)->except(['foto', 'kepsek_foto'])->toArray();

        if ($request->hasFile('foto')) {
            if ($beranda->foto) {
                Storage::disk('public')->delete('images/'.$beranda->foto);
            }
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images', $filename, 'public');
            $data['foto'] = $filename;
        }

        if ($request->hasFile('kepsek_foto')) {
            if ($beranda->kepsek_foto) {
                Storage::disk('public')->delete('images/'.$beranda->kepsek_foto);
            }
            $filename = $request->file('kepsek_foto')->hashName();
            $request->file('kepsek_foto')->storeAs('images', $filename, 'public');
            $data['kepsek_foto'] = $filename;
        }

        $beranda->fill($data);
        $beranda->save();

        return back()->with('success', 'Beranda berhasil diperbarui.');
    }
}