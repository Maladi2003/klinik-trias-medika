<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'spesialisasi_id',
        'nama_layanan',
        'estimasi_biaya'
    ];

    /**
     * Relasi ke model Spesialisasi
     */
    public function spesialisasi()
    {
        return $this->belongsTo(Spesialisasi::class, 'spesialisasi_id');
    }
}