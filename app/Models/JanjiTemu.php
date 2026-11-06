<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // 1. Import Trait HasUuids

class JanjiTemu extends Model
{
    use HasFactory, HasUuids; // 2. Gunakan HasUuids di sini

    // 3. Pengaturan Primary Key berbasis UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // 4. Baris kunci untuk mengatasi Mass Assignment Exception
    protected $fillable = [
        'pasien_id', 
        'jadwal_id', 
        'layanan_id', 
        'tanggal_berobat', 
        'no_antrean', 
        'status_booking'
    ];

    // 5. Relasi ke tabel Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // 6. Relasi ke tabel Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // 7. Relasi ke tabel Layanan
    public function layanan() 
    {
        return $this->belongsTo(Layanan::class);
    }
}