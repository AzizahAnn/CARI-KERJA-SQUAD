<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMahasiswaController extends Controller
{
    public function tampilkanFormMasuk()
    {
        if (auth()->check() && auth()->user()->adalahMahasiswa()) {
            return redirect()->route('mahasiswa.dashboard');
        }
        
        return view('auth.masuk.mahasiswa');
    }
    
    public function masuk(Request $request)
    {
        $kredensial = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        
        if (Auth::attempt(array_merge($kredensial, ['peran' => 'mahasiswa']), $request->filled('ingat_saya'))) {
            $request->session()->regenerate();
            
            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'Selamat datang, ' . auth()->user()->name);
        }
        
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }
    
    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('pilih.peran')
            ->with('success', 'Anda berhasil keluar.');
    }
}