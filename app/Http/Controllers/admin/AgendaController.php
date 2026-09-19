<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function store(AgendaRequest $request)
    {
        $data = $request->validated();
        $data['bulan'] = \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('F');

        Agenda::create($data);

        return back()->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function update(AgendaRequest $request, Agenda $agenda)
    {
        $data = $request->validated();
        $data['bulan'] = \Carbon\Carbon::parse($data['tanggal'])->translatedFormat('F');

        $agenda->update($data);

        return back()->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus.');
    }
}