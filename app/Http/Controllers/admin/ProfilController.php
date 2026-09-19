<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function update(ProfilRequest $request)
    {
        $validated = $request->validated();

        $profil = Profil::first() ?? new Profil();

        $profil->nama_sekolah = $validated['nama_sekolah'];
        $profil->moto         = $validated['moto'] ?? null;
        $profil->npsn         = $validated['npsn'] ?? null;
        $profil->telepon      = $validated['telepon'] ?? null;
        $profil->alamat       = $validated['alamat'] ?? null;
        $profil->email        = $validated['email'] ?? null;
        $profil->website      = $validated['website'] ?? null;
        $profil->sejarah      = $validated['sejarah'] ?? null;
        $profil->visi         = $validated['visi'] ?? null;
        $profil->misi         = array_filter(array_map('trim', explode("\n", $validated['misi'] ?? '')));
        $profil->deskripsi    = $validated['deskripsi'] ?? null;

        $fields = [
            'logo'          => ['dir' => 'images',      'prefix' => ''],
            'foto_hero'     => ['dir' => 'images/hero',  'prefix' => 'hero/'],
            'foto_sambutan' => ['dir' => 'images',      'prefix' => ''],
        ];

        foreach ($fields as $field => $cfg) {
            if ($request->hasFile($field)) {
                if ($profil->{$field}) {
                    Storage::disk('public')->delete('images/'.$profil->{$field});
                }

                $filename = $request->file($field)->hashName();
                $request->file($field)->storeAs($cfg['dir'], $filename, 'public');
                $profil->{$field} = $cfg['prefix'].$filename;
            }
        }

        $profil->save();

        return back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}