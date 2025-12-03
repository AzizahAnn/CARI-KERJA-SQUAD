<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        $totalLowongan = Lowongan::aktif()->count();
        $totalLamaran = $mahasiswa->pendaftaran()->count();
        $lamaranMenunggu = $mahasiswa->pendaftaran()->where('status', 'menunggu')->count();
        $lamaranDiterima = $mahasiswa->pendaftaran()->where('status', 'diterima')->count();
        
        return view('mahasiswa.dashboard', compact(
            'totalLowongan',
            'totalLamaran',
            'lamaranMenunggu',
            'lamaranDiterima'
        ));
    }
}