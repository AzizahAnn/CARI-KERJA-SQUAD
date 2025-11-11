<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// === TAMBAHKAN 'use' DI BAWAH INI ===
use App\Models\Perusahaan;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lowongan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'perusahaan_id',
        'nama_lowongan',
        'deskripsi',
        'kriteria',
        'jenis',
        'deadline',
        'status',
    ];


    // === TAMBAHKAN 2 FUNGSI RELASI DI BAWAH INI ===

    /**
     * Get the perusahaan that owns the lowongan.
     */
    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

    /**
     * Get the pendaftarans for the lowongan.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }
}