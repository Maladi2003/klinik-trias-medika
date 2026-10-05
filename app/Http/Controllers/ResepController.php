<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    // Menampilkan riwayat resep obat untuk bagian farmasi
    public function index()
    {
        // Mengambil data resep beserta nama obat dan data pasiennya
        $reseps = Resep::with(['obat', 'rekamMedis.janjiTemu.pasien'])->latest()->get();
        
        return view('resep.index', compact('reseps'));
    }
}