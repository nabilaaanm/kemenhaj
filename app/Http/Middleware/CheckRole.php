<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Session::has('user')) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil role dari session
        $userRole = Session::get('user.role');

        // Cek apakah role user ada dalam daftar roles yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
