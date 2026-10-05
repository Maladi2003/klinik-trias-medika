<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan daftar tagihan pasien
    public function index()
    {
        // Mengambil data transaksi beserta relasi ke pasien (melalui rekam medis dan janji temu)
        // Diurutkan agar yang 'Belum Lunas' tampil di paling atas
        $transaksis = Transaksi::with('rekamMedis.janjiTemu.pasien')
                        ->orderBy('status_pembayaran', 'asc')
                        ->get();
                        
        return view('transaksi.index', compact('transaksis'));
    }

    // Fungsi untuk mengubah status tagihan menjadi "Lunas"
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        $transaksi->update([
            'status_pembayaran' => 'Lunas'
        ]);

        return back()->with('success', 'Pembayaran tagihan berhasil dilunasi!');
    }
}