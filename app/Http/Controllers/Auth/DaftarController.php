<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DaftarController extends Controller
{
    // ===== PERUSAHAAN =====
    
    public function tampilkanFormPerusahaan()
    {
        return view('auth.daftar.perusahaan');
    }
    
    public function daftarPerusahaan(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telp.required' => 'Nomor telepon wajib diisi',
        ]);
        
        // Gunakan transaction agar data konsisten
        DB::beginTransaction();
        try {
            // 1. Buat user dulu
            $user = User::create([
                'name' => $request->nama_perusahaan,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'peran' => 'perusahaan',
            ]);
            
            // 2. Buat data perusahaan yang terhubung ke user
            Perusahaan::create([
                'user_id' => $user->id,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'deskripsi' => $request->deskripsi,
                'status_verifikasi' => 'menunggu',
            ]);
            
            // Commit = simpan semua perubahan
            DB::commit();
            
            return redirect()->route('perusahaan.masuk')
                ->with('success', 'Pendaftaran berhasil! Silakan masuk dan tunggu verifikasi dari admin.');
                
        } catch (\Exception $e) {
            // Rollback = batalkan semua jika ada error
            DB::rollback();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // ===== MAHASISWA =====
    
    public function tampilkanFormMahasiswa()
    {
        return view('auth.daftar.mahasiswa');
    }
    
    public function daftarMahasiswa(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'no_telp.required' => 'Nomor telepon wajib diisi',
        ]);
        
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'peran' => 'mahasiswa',
            ]);
            
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'nama_lengkap' => $request->nama_lengkap,
                'jurusan' => $request->jurusan,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);
            
            DB::commit();
            
            return redirect()->route('mahasiswa.masuk')
                ->with('success', 'Pendaftaran berhasil! Silakan masuk.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}