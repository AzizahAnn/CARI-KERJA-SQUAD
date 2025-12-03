<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// === TAMBAHKAN 'use' DI BAWAH INI ===
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lowongan_id',
        'mahasiswa_id',
        'tanggal_daftar',
        'status_lamaran',
    ];


    // === TAMBAHKAN 2 FUNGSI RELASI DI BAWAH INI ===

    /**
     * Get the lowongan that the pendaftaran belongs to.
     */
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    /**
     * Get the mahasiswa that the pendaftaran belongs to.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}