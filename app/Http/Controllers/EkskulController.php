<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Profil;

class EkskulController extends Controller
{
    // Pemetaan slug method/route -> nama persis di kolom `nama` tabel ekstrakurikuler.
    // Sesuaikan value-nya kalau nama di database kamu berbeda.
    protected array $petaEkskul = [
        'rohis'        => 'Rohis',
        'cinemak'      => 'Cinemak',
        'voli'         => 'Voli Bal',
        'pmr'          => 'PMR',
        'karawitan'    => 'Karawitan',
        'futsal'       => 'Futsal',
        'pramuka'      => 'Pramuka',
        'paskibra'     => 'Paskibra',
        'marchingband' => 'Marching Band',
        'jepang'       => 'Jepang',
    ];

    protected function tampilkan(string $slug)
    {
        $nama = $this->petaEkskul[$slug] ?? null;

        $ekskul = Ekstrakurikuler::with('pembina')
            ->when($nama, fn ($q) => $q->where('nama', $nama))
            ->first();

        return view('ekskul.'.$slug, [
            'profil' => Profil::first(),
            'ekskul' => $ekskul,
        ]);
    }

    public function rohis()        { return $this->tampilkan('rohis'); }
    public function cinemak()      { return $this->tampilkan('cinemak'); }
    public function voli()         { return $this->tampilkan('voli'); }
    public function pmr()          { return $this->tampilkan('pmr'); }
    public function karawitan()    { return $this->tampilkan('karawitan'); }
    public function futsal()       { return $this->tampilkan('futsal'); }
    public function pramuka()      { return $this->tampilkan('pramuka'); }
    public function paskibra()     { return $this->tampilkan('paskibra'); }
    public function marchingband() { return $this->tampilkan('marchingband'); }
    public function jepang()       { return $this->tampilkan('jepang'); }
}