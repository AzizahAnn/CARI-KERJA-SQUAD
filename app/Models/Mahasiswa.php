<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// === TAMBAHKAN 'use' DI BAWAH INI ===
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jurusan',
        'cv',
    ];


    // === TAMBAHKAN 2 FUNGSI RELASI DI BAWAH INI ===

    /**
     * Get the user that owns the mahasiswa profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pendaftarans for the mahasiswa.
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }
}