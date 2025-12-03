<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MahasiswaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('mahasiswa.masuk')
                ->with('error', 'Silakan login terlebih dahulu.');
        }
        
        if (!auth()->user()->adalahMahasiswa()) {
            return redirect()->route('pilih.peran')
                ->with('error', 'Halaman ini hanya untuk mahasiswa.');
        }
        
        return $next($request);
    }
}