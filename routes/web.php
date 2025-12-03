<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginPerusahaanController;
use App\Http\Controllers\Auth\LoginMahasiswaController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\VerifikasiPerusahaanController;
use App\Http\Controllers\Admin\VerifikasiLowonganController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Perusahaan\DashboardPerusahaanController;
use App\Http\Controllers\Perusahaan\LowonganController;
use App\Http\Controllers\Perusahaan\PelamarController;
use App\Http\Controllers\Mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\Mahasiswa\CariLowonganController;
use App\Http\Controllers\Mahasiswa\PendaftaranController;
use App\Http\Controllers\Mahasiswa\LamaranController;

// ========================================
// HALAMAN UTAMA
// ========================================
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/masuk', function () {
    return view('auth.pilih-peran');
})->name('pilih.peran');

// ========================================
// ROUTES ADMIN
// ========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/masuk', [LoginAdminController::class, 'tampilkanFormMasuk'])->name('masuk');
    Route::post('/masuk', [LoginAdminController::class, 'masuk']);
    Route::post('/keluar', [LoginAdminController::class, 'keluar'])->name('keluar');
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
        
        // Verifikasi Perusahaan
        Route::get('/perusahaan', [VerifikasiPerusahaanController::class, 'index'])->name('perusahaan.index');
        Route::post('/perusahaan/{id}/setujui', [VerifikasiPerusahaanController::class, 'setujui'])->name('perusahaan.setujui');
        Route::post('/perusahaan/{id}/tolak', [VerifikasiPerusahaanController::class, 'tolak'])->name('perusahaan.tolak');
        
        // Verifikasi Lowongan
        Route::get('/lowongan', [VerifikasiLowonganController::class, 'index'])->name('lowongan.index');
        Route::get('/lowongan/{id}', [VerifikasiLowonganController::class, 'detail'])->name('lowongan.detail');
        Route::post('/lowongan/{id}/setujui', [VerifikasiLowonganController::class, 'setujui'])->name('lowongan.setujui');
        Route::post('/lowongan/{id}/tolak', [VerifikasiLowonganController::class, 'tolak'])->name('lowongan.tolak');
        
        // Laporan
        Route::get('/laporan/rekap-pendaftar', [LaporanController::class, 'rekapPendaftar'])->name('laporan.rekap');
    });
});

// ========================================
// ROUTES PERUSAHAAN
// ========================================
Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/masuk', [LoginPerusahaanController::class, 'tampilkanFormMasuk'])->name('masuk');
    Route::post('/masuk', [LoginPerusahaanController::class, 'masuk']);
    Route::get('/daftar', [DaftarController::class, 'tampilkanFormPerusahaan'])->name('daftar');
    Route::post('/daftar', [DaftarController::class, 'daftarPerusahaan']);
    Route::post('/keluar', [LoginPerusahaanController::class, 'keluar'])->name('keluar');
    
    Route::middleware(['auth', 'perusahaan'])->group(function () {
        Route::get('/dashboard', [DashboardPerusahaanController::class, 'index'])->name('dashboard');
        
        // CRUD Lowongan
        Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
        Route::get('/lowongan/buat', [LowonganController::class, 'buat'])->name('lowongan.buat');
        Route::post('/lowongan', [LowonganController::class, 'simpan'])->name('lowongan.simpan');
        Route::get('/lowongan/{id}', [LowonganController::class, 'detail'])->name('lowongan.detail');
        Route::get('/lowongan/{id}/ubah', [LowonganController::class, 'ubah'])->name('lowongan.ubah');
        Route::put('/lowongan/{id}', [LowonganController::class, 'perbarui'])->name('lowongan.perbarui');
        Route::delete('/lowongan/{id}', [LowonganController::class, 'hapus'])->name('lowongan.hapus');
        
        // Lihat Pelamar
        Route::get('/lowongan/{id}/pelamar', [PelamarController::class, 'daftarPelamar'])->name('lowongan.pelamar');
        Route::post('/pendaftaran/{id}/ubah-status', [PelamarController::class, 'ubahStatus'])->name('pendaftaran.ubah-status');
        Route::get('/pendaftaran/{id}/unduh-cv', [PelamarController::class, 'unduhCV'])->name('pendaftaran.unduh-cv');
    });
});

// ========================================
// ROUTES MAHASISWA
// ========================================
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/masuk', [LoginMahasiswaController::class, 'tampilkanFormMasuk'])->name('masuk');
    Route::post('/masuk', [LoginMahasiswaController::class, 'masuk']);
    Route::get('/daftar', [DaftarController::class, 'tampilkanFormMahasiswa'])->name('daftar');
    Route::post('/daftar', [DaftarController::class, 'daftarMahasiswa']);
    Route::post('/keluar', [LoginMahasiswaController::class, 'keluar'])->name('keluar');
    
    Route::middleware(['auth', 'mahasiswa'])->group(function () {
        Route::get('/dashboard', [DashboardMahasiswaController::class, 'index'])->name('dashboard');
        
        // Cari & Lihat Lowongan
        Route::get('/lowongan', [CariLowonganController::class, 'index'])->name('lowongan.index');
        Route::get('/lowongan/{id}', [CariLowonganController::class, 'detail'])->name('lowongan.detail');
        
        // Daftar Lowongan (dengan Upload CV)
        Route::post('/lowongan/{id}/daftar', [PendaftaranController::class, 'daftar'])->name('lowongan.daftar');
        
        // Riwayat Lamaran
        Route::get('/lamaran', [LamaranController::class, 'index'])->name('lamaran.index');
        Route::get('/lamaran/{id}', [LamaranController::class, 'detail'])->name('lamaran.detail');
    });
});