<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    use HasFactory;

    // 1. Baris kunci untuk mengatasi Mass Assignment Exception
    protected $fillable = [
        'pasien_id', 
        'jadwal_id', 
        'layanan_id', 
        'tanggal_berobat', 
        'no_antrean', 
        'status_booking'
    ];

    // 2. Relasi ke tabel Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // 3. Relasi ke tabel Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    // 4. Relasi Ke tabel Layanan
    public function layanan() 
    {
        return $this->belongsTo(Layanan::class);
    }
}