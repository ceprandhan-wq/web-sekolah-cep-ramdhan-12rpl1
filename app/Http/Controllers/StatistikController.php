<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Update data statistik sekolah (data tunggal).
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah_siswa'    => 'required|integer|min:0',
            'jumlah_guru'     => 'required|integer|min:0',
            'jumlah_alumni'   => 'nullable|integer|min:0',    // ⬅️ DIUBAH: required -> nullable
            'jumlah_prestasi' => 'nullable|integer|min:0',    // ⬅️ DIUBAH: required -> nullable
        ]);

        $statistik = Statistik::first() ?? new Statistik();
        $statistik->fill($validated);
        $statistik->save();

        return back()->with('success', 'Statistik sekolah berhasil diperbarui.');
    }
}