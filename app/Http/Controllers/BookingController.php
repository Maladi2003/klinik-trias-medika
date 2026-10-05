<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JanjiTemu;
use App\Models\Pasien;
use App\Models\Jadwal;
use App\Models\Layanan;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        $jadwals = Jadwal::with('dokter')->get();
        $layanans = Layanan::all();
        return view('frontend.booking', compact('jadwals', 'layanans'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jadwal_id' => 'required|exists:jadwals,id',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        // 2. Validasi Kecocokan Hari
        $jadwal = Jadwal::findOrFail($request->jadwal_id);
        $hariDipilih = Carbon::parse($request->tanggal)->translatedFormat('l'); 
        
        $mapHari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $hariDipilihIndo = $mapHari[Carbon::parse($request->tanggal)->format('l')];

        if (strtolower($hariDipilihIndo) !== strtolower($jadwal->hari)) {
            return back()->withInput()->withErrors([
                'tanggal' => "Dokter hanya praktik pada hari $jadwal->hari. Anda memilih hari $hariDipilihIndo."
            ]);
        }

        DB::beginTransaction();

        try {
            // 3. Auto-Register Pasien
            $pasien = Pasien::where('no_wa', $request->no_hp)->first();
            if (!$pasien) {
                $pasien = Pasien::create([
                    'nama_pasien' => $request->nama_pasien,
                    'no_wa'       => $request->no_hp,
                    'alamat'      => 'Belum diisi',
                    'no_bpjs'     => '-'
                ]);
            }

            // 4. Lock For Update & Cek Kuota (MENGGUNAKAN 'tanggal_berobat')
            $jumlahAntrean = JanjiTemu::where('tanggal_berobat', $request->tanggal)
                                      ->where('jadwal_id', $request->jadwal_id)
                                      ->lockForUpdate() 
                                      ->count();

            $kuotaMaksimal = 20; 

            if ($jumlahAntrean >= $kuotaMaksimal) {
                DB::rollBack();
                return back()->withInput()->withErrors([
                    'kuota' => 'Mohon maaf, antrean jadwal ini sudah penuh (Maks: '.$kuotaMaksimal.' pasien).'
                ]);
            }

            // 5. Generate Nomor Antrean (MENGGUNAKAN 'tanggal_berobat')
            $nomorBaru = $jumlahAntrean + 1;

            $janji = JanjiTemu::create([
                'pasien_id'       => $pasien->id,
                'jadwal_id'       => $request->jadwal_id,
                'layanan_id'      => $request->layanan_id,
                'tanggal_berobat' => $request->tanggal, 
                'no_antrean'      => $nomorBaru,
                'status_booking'  => 'Menunggu'
            ]);

            DB::commit();

            // 6. Generate Kode Tampilan Cantik
            $layanan = Layanan::find($request->layanan_id);
            $hurufDepan = strtoupper(substr($layanan->nama_layanan, 0, 1));
            $kodeAntrean = $hurufDepan . '-' . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);

            return back()->with('success', "Pendaftaran Berhasil! Nomor Antrean Anda: " . $kodeAntrean);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->withErrors(['sistem' => 'Terjadi kesalahan sistem (Kode: '.$e->getMessage().'). Silakan coba lagi.']);
        }
    }
}