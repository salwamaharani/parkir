<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatParkir extends Model
{
    protected $fillable = ['jeniskendaraan_id', 'nomor_plat', 'waktu_masuk', 'waktu_keluar', 'durasi', 'biaya'];

    // Relasi dengan model JenisKendaraan
    public function jeniskendaraan()
    {
        // Pastikan penamaan model JenisKendaraan sesuai dengan penulisan PascalCase
        return $this->belongsTo(JenisKendaraan::class, 'jeniskendaraan_id');
    }
}
