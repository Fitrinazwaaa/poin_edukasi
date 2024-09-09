<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Pastikan Auth facade digunakan

class User_Akses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Pastikan pengguna sudah login
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Kembalikan respons JSON jika akses tidak diizinkan
        return response()->json(['Anda tidak diperbolehkan mengakses halaman ini']);
    }
}
