<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// === PASTIKAN 3 'use' INI ADA ===
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // <-- Tambahkan ini
        'status', // <-- Tambahkan ini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // <-- Ini 'hashed' (bukan 'hash') di Laravel baru
    ];


    // === TAMBAHKAN 2 FUNGSI RELASI DI BAWAH INI ===

    /**
     * Get the mahasiswa profile associated with the user.
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }

    /**
     * Get the perusahaan profile associated with the user.
     */
    public function perusahaan(): HasOne
    {
        return $this->hasOne(Perusahaan::class);
    }
}