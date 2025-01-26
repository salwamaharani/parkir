<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
    // Jika diperlukan, definisikan relasi balik
    public function riwayatParkir()
    {
        return $this->hasMany(RiwayatParkir::class, 'jeniskendaraan_id');
    }
}
