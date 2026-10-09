<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use App\Models\Pasien;
use App\Models\Jadwal;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JanjiTemuController extends Controller
{
    public function index()
    {
        $janjiTemus = JanjiTemu::with(['pasien', 'jadwal.dokter'])->latest()->get();
        return view('janji_temu.index', compact('janjiTemus'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $jadwals = Jadwal::with('dokter')->get();
        $layanans = Layanan::all(); // Menarik data layanan dari database Anda
        return view('janji_temu.create', compact('pasiens', 'jadwals', 'layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'jadwal_id' => 'required',
            'layanan_id' => 'required',
            'tanggal' => 'required|date',
        ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        $dayOfWeek = Carbon::parse($request->tanggal)->dayOfWeek;
        $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hariDipilih = $namaHari[$dayOfWeek];

        if (strtolower($hariDipilih) !== strtolower($jadwal->hari)) {
            return back()->withInput()->withErrors([
                'tanggal' => "Gagal! Tanggal yang Anda pilih jatuh pada hari $hariDipilih, sedangkan jadwal dokter ini khusus untuk hari $jadwal->hari."
            ]);
        }

        // LOGIKA CERDAS: Generate Nomor Antrean Otomatis
        $antreanTerakhir = JanjiTemu::where('tanggal_berobat', $request->tanggal)
                                    ->where('jadwal_id', $request->jadwal_id)
                                    ->count();

        JanjiTemu::create([
            'pasien_id' => $request->pasien_id,
            'jadwal_id' => $request->jadwal_id,
            'layanan_id' => $request->layanan_id,
            'tanggal_berobat' => $request->tanggal, // Menggunakan nama kolom asli Anda
            'no_antrean' => $antreanTerakhir + 1,   // Nomor otomatis bertambah
            'status_booking' => 'Menunggu'
        ]);

        return redirect()->route('janji-temu.index')->with('success', 'Pasien berhasil didaftarkan ke antrean!');
    }
    
    public function destroy(string $id)
    {
        JanjiTemu::findOrFail($id)->delete();
        return back()->with('success', 'Antrean berhasil dibatalkan.');
    }
}