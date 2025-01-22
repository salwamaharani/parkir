<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayatparkir extends Model
{
     protected $fillable = ['jeniskendaraan_id', 'nomor_plat', 'waktu_masuk', 'waktu_keluar', 'durasi', 'biaya'];
     public function jeniskendaraan()
     {
        return $this->belongsTo(jeniskendaraan::class,);
     }
}
