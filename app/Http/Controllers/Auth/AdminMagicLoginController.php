<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminMagicLoginMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AdminMagicLoginController extends Controller
{
    /**
     * Tampilkan form untuk meminta tautan login lewat email.
     */
    public function showRequestForm()
    {
        return view('auth.magic-login-request');
    }

    /**
     * Buat tautan login (signed URL) lalu kirim ke email admin.
     */
  public function sendLink(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $request->email)
        ->where('level', 'admin')
        ->first();

    $status = 'Jika email terdaftar sebagai admin, tautan login telah dikirim ke email tersebut.';

    if ($user) {
        $url = URL::temporarySignedRoute(
            'admin.magic-login',
            now()->addMinutes(15),
            ['user' => $user->id]
        );

        Mail::to($user->email)->send(new AdminMagicLoginMail($user, $url));

        if (app()->environment('local')) {
            return back()->with('status', $status)->with('debug_url', $url);
        }
    }

    return back()->with('status', $status);
}

    /**
     * Verifikasi signed URL, lalu login-kan admin.
     */
    public function login(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Tautan login tidak valid atau sudah kedaluwarsa. Silakan minta tautan baru.');
        }

        if ($user->level !== 'admin') {
            abort(403, 'Akun ini bukan admin.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('status', 'Berhasil login sebagai ' . $user->name);
    }
}