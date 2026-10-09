<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    use HasFactory;

    // mengizinkan data masuk ke database
    protected $fillable = ['nama_spesialisasi'];

    /**
     * Relasi ke model Layanan (Satu spesialisasi/poli memiliki banyak layanan)
     */
    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'spesialisasi_id');
    }
}