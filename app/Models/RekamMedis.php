<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $fillable = ['janji_temu_id', 'keluhan', 'diagnosa', 'tindakan'];

    public function janjiTemu()
    {
        return $this->belongsTo(JanjiTemu::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}