<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    public function store(JurusanRequest $request)
    {
        $data = $request->validated();

        foreach (['foto_kepala_jurusan', 'logo_jurusan', 'foto'] as $field) {
            if ($request->hasFile($field)) {
                $filename = $request->file($field)->hashName();
                $request->file($field)->storeAs('images/jurusan', $filename, 'public');
                $data[$field] = $filename;
            }
        }

        Jurusan::create($data);

        return back()->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $data = $request->validated();

        foreach (['foto_kepala_jurusan', 'logo_jurusan', 'foto'] as $field) {
            if ($request->hasFile($field)) {
                if ($jurusan->{$field}) {
                    Storage::disk('public')->delete('images/jurusan/'.$jurusan->{$field});
                }
                $filename = $request->file($field)->hashName();
                $request->file($field)->storeAs('images/jurusan', $filename, 'public');
                $data[$field] = $filename;
            }
        }

        $jurusan->fill($data);
        $jurusan->save();

        return back()->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        foreach (['foto_kepala_jurusan', 'logo_jurusan', 'foto'] as $field) {
            if ($jurusan->{$field}) {
                Storage::disk('public')->delete('images/jurusan/'.$jurusan->{$field});
            }
        }

        $jurusan->delete();
        return back()->with('success', 'Jurusan berhasil dihapus.');
    }
}