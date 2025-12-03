<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lowongan extends Model
{
    protected $table = 'lowongan';

    protected $fillable = [
        'perusahaan_id',
        'posisi',
        'deskripsi',
        'persyaratan',
        'lokasi',
        'tipe',
        'batas_akhir',
        'status',
    ];

    protected $casts = [
        'batas_akhir' => 'date',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif')
                     ->where('batas_akhir', '>=', Carbon::today());
    }

    public function masihTerbuka()
    {
        return $this->status === 'aktif' && $this->batas_akhir >= Carbon::today();
    }
}