<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_obat', 'jenis_obat', 'stok', 'harga'];

    // Relasi: Satu obat bisa ada di banyak resep
    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}