<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KontakRequest;
use App\Models\Kontak;

class KontakController extends Controller
{
    public function update(KontakRequest $request)
    {
        $kontak = Kontak::first() ?? new Kontak();
        $kontak->fill($request->validated());
        $kontak->save();

        return redirect()
            ->route('admin.dashboard', ['tab' => 'kontak'])
            ->with('success', 'Data kontak berhasil diperbarui.');
    }
}