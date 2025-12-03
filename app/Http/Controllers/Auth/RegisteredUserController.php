<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// === PASTIKAN 2 MODEL INI DITAMBAHKAN ===
use App\Models\Mahasiswa;
use App\Models\Perusahaan;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // === DI SINI KITA UBAH VALIDASINYA ===
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Tambahkan validasi untuk field baru kita
            'role' => ['required', 'in:mahasiswa,perusahaan'],
            // 'required_if' artinya: WAJIB diisi JIKA role=mahasiswa
            'jurusan' => ['required_if:role,mahasiswa', 'nullable', 'string', 'max:255'],
            'alamat' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:255'],
            'bidang_usaha' => ['required_if:role,perusahaan', 'nullable', 'string', 'max:255'],
        ]);

        // === DI SINI KITA UBAH CARA BUAT USER ===
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role-nya
            
            // Status perusahaan 'pending', mahasiswa langsung 'terverifikasi'
            'status' => $request->role == 'perusahaan' ? 'pending' : 'terverifikasi', 
        ]);

        // === INI LOGIKA TAMBAHAN KITA ===
        // Setelah User dibuat, kita buat profilnya
        if ($request->role == 'mahasiswa') {
            // Buat data di tabel 'mahasiswas'
            $user->mahasiswa()->create([
                'jurusan' => $request->jurusan,
            ]);
        } elseif ($request->role == 'perusahaan') {
            // Buat data di tabel 'perusahaans'
            $user->perusahaan()->create([
                'alamat' => $request->alamat,
                'bidang_usaha' => $request->bidang_usaha,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Arahkan ke Halaman Dashboard
        return redirect(RouteServiceProvider::HOME); 
    }
}