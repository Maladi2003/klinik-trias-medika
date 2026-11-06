<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasien', 
        'no_wa', 
        'alamat', 
        'no_bpjs',
    ];

    /**
     * Enkripsi otomatis data sensitif pasien di basis data (AES-256)
     */
    protected $casts = [
        'no_bpjs' => 'encrypted',
        'no_wa' => 'encrypted',
    ];

    /**
     * Relasi One-to-Many ke tabel JanjiTemu
     */
    public function janjiTemus()
    {
        return $this->hasMany(JanjiTemu::class);
    }
}