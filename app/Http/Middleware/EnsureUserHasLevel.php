<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasLevel
{
    /**
     * Contoh pakai di route: ->middleware('level:admin')
     * Bisa juga terima beberapa level: ->middleware('level:admin,guru')
     */
    public function handle(Request $request, Closure $next, string ...$levels): Response
    {
        if (!$request->user() || !in_array($request->user()->level, $levels)) {
            abort(403, 'Akses ditolak. Kamu tidak punya izin untuk halaman ini.');
        }

        return $next($request);
    }
}