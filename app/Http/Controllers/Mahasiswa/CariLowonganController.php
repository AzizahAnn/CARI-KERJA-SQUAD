<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class CariLowonganController extends Controller
{
    // Tampilkan daftar lowongan aktif
    public function index(Request $request)
    {
        $query = Lowongan::with('perusahaan')
            ->aktif(); // hanya yang status aktif dan belum deadline
        
        // Filter berdasarkan pencarian
        if ($request->filled('cari')) {
            $query->where(function($q) use ($request) {
                $q->where('posisi', 'like', '%' . $request->cari . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->cari . '%');
            });
        }
        
        // Filter berdasarkan tipe
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }
        
        $lowongan = $query->orderBy('created_at', 'desc')->get();
        
        return view('mahasiswa.lowongan.index', compact('lowongan'));
    }
    
    // Tampilkan detail lowongan
    public function detail($id)
    {
        $lowongan = Lowongan::with('perusahaan')->aktif()->findOrFail($id);
        
        $mahasiswa = auth()->user()->mahasiswa;
        
        // Cek apakah sudah daftar
        $sudahDaftar = $lowongan->pendaftaran()
            ->where('mahasiswa_id', $mahasiswa->id)
            ->exists();
        
        return view('mahasiswa.lowongan.detail', compact('lowongan', 'sudahDaftar'));
    }
}