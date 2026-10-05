<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    use HasFactory;

    // Baris ajaib ini yang akan mengizinkan data masuk ke database
    protected $fillable = ['nama_spesialisasi'];
}