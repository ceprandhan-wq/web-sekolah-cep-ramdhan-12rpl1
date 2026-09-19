<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EkstrakurikulerRequest;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    protected function aturKegiatanRutin(EkstrakurikulerRequest $request): array
    {
        return collect($request->input('kegiatan_rutin', []))
            ->filter(fn ($item) => trim((string) $item) !== '')
            ->values()
            ->all();
    }

    public function store(EkstrakurikulerRequest $request)
    {
        $data = $request->safe()->only(['nama', 'id_pembina', 'deskripsi', 'jadwal', 'lokasi', 'status']);
        $data['status']         = $data['status'] ?? 'aktif';
        $data['kegiatan_rutin'] = $this->aturKegiatanRutin($request);

        if ($request->hasFile('foto')) {
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/ekskul', $filename, 'public');
            $data['foto'] = 'ekskul/'.$filename;
        }

        if ($request->hasFile('logo')) {
            $filename = $request->file('logo')->hashName();
            $request->file('logo')->storeAs('images/ekskul/logo', $filename, 'public');
            $data['logo'] = 'ekskul/logo/'.$filename;
        }

        if ($request->hasFile('dokumentasi')) {
            $dokumentasi = [];
            foreach ($request->file('dokumentasi') as $file) {
                $filename = $file->hashName();
                $file->storeAs('images/ekskul/dokumentasi', $filename, 'public');
                $dokumentasi[] = 'ekskul/dokumentasi/'.$filename;
            }
            $data['dokumentasi'] = $dokumentasi;
        }

        Ekstrakurikuler::create($data);

        return back()->with('success', 'Ekskul berhasil ditambahkan.');
    }

    public function update(EkstrakurikulerRequest $request, Ekstrakurikuler $ekskul)
    {
        $ekskul->fill($request->safe()->only(['nama', 'id_pembina', 'deskripsi', 'jadwal', 'lokasi', 'status']));
        $ekskul->kegiatan_rutin = $this->aturKegiatanRutin($request);

        if ($request->hasFile('foto')) {
            if ($ekskul->foto) {
                Storage::disk('public')->delete('images/'.$ekskul->foto);
            }
            $filename = $request->file('foto')->hashName();
            $request->file('foto')->storeAs('images/ekskul', $filename, 'public');
            $ekskul->foto = 'ekskul/'.$filename;
        }

        if ($request->hasFile('logo')) {
            if ($ekskul->logo) {
                Storage::disk('public')->delete('images/'.$ekskul->logo);
            }
            $filename = $request->file('logo')->hashName();
            $request->file('logo')->storeAs('images/ekskul/logo', $filename, 'public');
            $ekskul->logo = 'ekskul/logo/'.$filename;
        }

        if ($request->hasFile('dokumentasi')) {
            $dokumentasi = $ekskul->dokumentasi ?? [];
            foreach ($request->file('dokumentasi') as $file) {
                $filename = $file->hashName();
                $file->storeAs('images/ekskul/dokumentasi', $filename, 'public');
                $dokumentasi[] = 'ekskul/dokumentasi/'.$filename;
            }
            $ekskul->dokumentasi = $dokumentasi;
        }

        $ekskul->save();

        return back()->with('success', 'Ekskul berhasil diperbarui.');
    }

    public function destroy(Ekstrakurikuler $ekskul)
    {
        if ($ekskul->foto) {
            Storage::disk('public')->delete('images/'.$ekskul->foto);
        }
        if ($ekskul->logo) {
            Storage::disk('public')->delete('images/'.$ekskul->logo);
        }
        foreach ($ekskul->dokumentasi ?? [] as $file) {
            Storage::disk('public')->delete('images/'.$file);
        }

        $ekskul->delete();
        return back()->with('success', 'Ekskul berhasil dihapus.');
    }
}