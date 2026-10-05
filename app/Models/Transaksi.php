<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['rekam_medis_id', 'total_biaya', 'status_pembayaran'];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }
}