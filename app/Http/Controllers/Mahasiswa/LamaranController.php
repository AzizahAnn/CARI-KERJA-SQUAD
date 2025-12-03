<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    // Tampilkan riwayat lamaran mahasiswa
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        $lamaran = $mahasiswa->pendaftaran()
            ->with('lowongan.perusahaan')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
        
        return view('mahasiswa.lamaran.index', compact('lamaran'));
    }
    
    // Detail lamaran
    public function detail($id)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        $lamaran = $mahasiswa->pendaftaran()
            ->with('lowongan.perusahaan')
            ->findOrFail($id);
        
        return view('mahasiswa.lamaran.detail', compact('lamaran'));
    }
}