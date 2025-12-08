<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class PendaftaranController extends Controller

    // Proses daftar lowongan + upload CV
    public function daftar(Request $request, $lowongan_id)
{
    $request->validate([
        'cv' => 'required|file|mimes:pdf|max:2048', // Max 2MB
    ]);
    
    $mahasiswa = auth()->user()->mahasiswa;
    
    // Upload CV
    $file = $request->file('cv');
    $namaFile = 'cv_' . $mahasiswa->nim . '_' . time() . '.pdf';
    $jalurCV = $file->storeAs('cv', $namaFile, 'public');
    
    // Simpan pendaftaran
    Pendaftaran::create([
        'lowongan_id' => $lowongan_id,
        'mahasiswa_id' => $mahasiswa->id,
        'jalur_cv' => $jalurCV,
        'status' => 'menunggu',
    ]);
    
    return redirect()->route('mahasiswa.lamaran.index')
        ->with('success', 'Lamaran berhasil dikirim!');
}