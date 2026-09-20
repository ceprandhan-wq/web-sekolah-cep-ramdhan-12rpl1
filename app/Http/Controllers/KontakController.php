<?php

namespace App\Http\Controllers;

use App\Models\Kontak;

class KontakController extends Controller
{
    /**
     * Ambil data kontak (satu baris) untuk halaman Kontak di beranda.
     *
     * Dipanggil dari route '/' via:
     *   $kontak = (new KontakController)->data();
     */
    public function data(): ?Kontak
    {
        return Kontak::first();
    }
}