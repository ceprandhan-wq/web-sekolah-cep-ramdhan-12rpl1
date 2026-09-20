<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminMagicLoginController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\JurusanPublicController;
use App\Models\Profil;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Agenda;
use App\Models\Beranda;

// ==========================
// Halaman Utama (Publik)
// ==========================
Route::get('/', function () {
    $profil  = Profil::first() ?? new Profil();
    $beranda = Beranda::first();

    $jurusan = Jurusan::all();
    $guru    = Guru::all();
    $ekskul  = Ekstrakurikuler::all();
    $galeri  = Galeri::all();
    $artikel  = Artikel::all();
    $agenda  = Agenda::all();

   

    $sambutanKepsek = $kepalaSekolah->sambutan ?? null;

    return view('home/dashboard', compact(
        'profil', 'beranda', 'jurusan', 'guru', 'ekskul', 'galeri', 'berita', 'agenda',
        'komite', 'notifikasi', 'kepalaSekolah', 'sambutanKepsek'
    ));
});

// ==========================
// Halaman Detail Jurusan (Publik)
// ==========================
Route::get('/jurusan/tkr', [JurusanPublicController::class, 'tkr'])->name('jurusan.tkr');
Route::get('/jurusan/pms', [JurusanPublicController::class, 'pms'])->name('jurusan.pms');
Route::get('/jurusan/pplg', [JurusanPublicController::class, 'pplg'])->name('jurusan.pplg');
Route::get('/jurusan/aphp', [JurusanPublicController::class, 'aphp'])->name('jurusan.aphp');

// ==========================
// Halaman Detail Ekstrakurikuler (Publik)
// ==========================
Route::get('/ekstrakurikuler/rohis', [EkskulController::class, 'rohis'])->name('ekskul.rohis');
Route::get('/ekstrakurikuler/cinemak', [EkskulController::class, 'cinemak'])->name('ekskul.cinemak');
Route::get('/ekstrakurikuler/voli', [EkskulController::class, 'voli'])->name('ekskul.voli');
Route::get('/ekstrakurikuler/pmr', [EkskulController::class, 'pmr'])->name('ekskul.pmr');
Route::get('/ekstrakurikuler/karawitan', [EkskulController::class, 'karawitan'])->name('ekskul.karawitan');
Route::get('/ekstrakurikuler/futsal', [EkskulController::class, 'futsal'])->name('ekskul.futsal');
Route::get('/ekstrakurikuler/pramuka', [EkskulController::class, 'pramuka'])->name('ekskul.pramuka');
Route::get('/ekstrakurikuler/paskibra', [EkskulController::class, 'paskibra'])->name('ekskul.paskibra');
Route::get('/ekstrakurikuler/marchingband', [EkskulController::class, 'marchingband'])->name('ekskul.marchingband');
Route::get('/ekstrakurikuler/jepang', [EkskulController::class, 'jepang'])->name('ekskul.jepang');

// ==========================
// Login — diarahkan ke Magic Link (LoginController & login.blade.php sudah tidak dipakai)
// ==========================
Route::get('/login', function () {
    return redirect()->route('admin.magic-login.request');
})->name('login');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

// ==========================
// Login Admin lewat Email (Magic Link)
// ==========================
Route::get('/admin/login-link', [AdminMagicLoginController::class, 'showRequestForm'])
    ->name('admin.magic-login.request');

Route::post('/admin/login-link', [AdminMagicLoginController::class, 'sendLink'])
    ->name('admin.magic-login.send');

Route::get('/admin/login-link/{user}', [AdminMagicLoginController::class, 'login'])
    ->middleware('signed')
    ->name('admin.magic-login');

// ==========================
// Dashboard Admin
// ==========================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'level:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

});