<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use App\Models\Obat;
use App\Models\RekamMedis;
use App\Models\Resep;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    // 1. Tampilkan form pemeriksaan saat dokter memanggil pasien
    public function create(Request $request)
    {
        // Mengambil data janji temu yang akan diperiksa
        $janjiTemu = JanjiTemu::findOrFail($request->janji_temu_id);
        
        // Mengambil daftar obat yang stoknya masih ada
        $obats = Obat::where('stok', '>', 0)->get();
        
        return view('rekam_medis.create', compact('janjiTemu', 'obats'));
    }

    // 2. Simpan hasil pemeriksaan, potong stok, dan terbitkan tagihan
    public function store(Request $request)
    {
        $request->validate([
            'janji_temu_id' => 'required|exists:janji_temus,id',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            // Validasi array karena dokter bisa meresepkan lebih dari 1 obat
            'obat_id' => 'nullable|array',
            'jumlah' => 'nullable|array',
            'dosis' => 'nullable|array',
        ]);

        DB::beginTransaction(); // Memulai transaksi database (Keamanan tingkat tinggi)

        try {
            // A. Simpan data rekam medis
            $rekamMedis = RekamMedis::create([
                'janji_temu_id' => $request->janji_temu_id,
                'keluhan' => $request->keluhan,
                'diagnosa' => $request->diagnosa,
                'tindakan' => $request->tindakan,
            ]);

            $totalBiayaObat = 0;

            // B. Proses Resep dan Potong Stok Obat (Jika dokter meresepkan obat)
            if ($request->has('obat_id')) {
                foreach ($request->obat_id as $index => $obatId) {
                    $obat = Obat::findOrFail($obatId);
                    $jumlah = $request->jumlah[$index];

                    // Kurangi stok obat di database
                    $obat->stok -= $jumlah;
                    $obat->save();

                    // Catat ke tabel resep
                    Resep::create([
                        'rekam_medis_id' => $rekamMedis->id,
                        'obat_id' => $obatId,
                        'jumlah' => $jumlah,
                        'dosis' => $request->dosis[$index],
                    ]);

                    // Hitung total harga obat yang diresepkan
                    $totalBiayaObat += ($obat->harga * $jumlah);
                }
            }

            // C. Terbitkan Transaksi / Tagihan Pasien
            // (Contoh: Biaya jasa pemeriksaan dokter / layanan tetap Rp 50.000)
            $biayaLayanan = 50000; 
            
            Transaksi::create([
                'rekam_medis_id' => $rekamMedis->id,
                'total_biaya' => $biayaLayanan + $totalBiayaObat,
                'status_pembayaran' => 'Belum Lunas',
            ]);

            DB::commit(); // Kunci dan simpan semua perubahan ke database secara permanen

            // Arahkan ke halaman kasir/transaksi agar pasien bisa langsung bayar
            return redirect()->route('transaksi.index')->with('success', 'Pemeriksaan selesai! Tagihan otomatis diterbitkan.');

        } catch (\Exception $e) {
            DB::rollback(); // Batalkan semua jika ada error agar data tidak setengah-setengah
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}