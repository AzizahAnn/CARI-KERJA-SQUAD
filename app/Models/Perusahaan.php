<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// === TAMBAHKAN 'use' DI BAWAH INI ===
use App\Models\User;
use App\Models\Lowongan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perusahaan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Ini untuk melindungi 'user_id' agar tidak diisi sembarangan
    // Kita akan isi relasinya lewat $user->perusahaan()->create()
    protected $fillable = [
        'alamat',
        'bidang_usaha',
    ];


    // === TAMBAHKAN 2 FUNGSI RELASI DI BAWAH INI ===

    /**
     * Get the user that owns the perusahaan profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lowongans for the perusahaan.
     */
    public function lowongans(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }
}