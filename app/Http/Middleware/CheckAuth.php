<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna sudah diautentikasi
        if (!Auth::check()) {
            // Mengarahkan ke halaman login jika pengguna belum masuk
            return redirect('login');
        }

        // Melanjutkan ke request berikutnya jika pengguna sudah diautentikasi
        return $next($request);
    }
}
