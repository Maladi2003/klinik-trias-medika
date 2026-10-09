<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JanjiTemu;
use App\Models\Pasien;
use App\Models\Jadwal;
use App\Models\Layanan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $jadwals = Jadwal::with('dokter')->get();
        
        // Eager loading relasi spesialisasi agar data spesialisasi_id siap digunakan di Blade/JS
        $layanans = Layanan::with('spesialisasi')->get();
        
        $selectedJadwalId = $request->query('jadwal_id');
        $selectedDokterId = null;

        // Cari ID dokter dari jadwal yang diklik di halaman publik
        if ($selectedJadwalId) {
            $selectedJadwal = Jadwal::find($selectedJadwalId);
            if ($selectedJadwal) {
                $selectedDokterId = $selectedJadwal->dokter_id;
            }
        }

        return view('frontend.booking', compact('jadwals', 'layanans', 'selectedJadwalId', 'selectedDokterId'));
    }

    public function store(Request $request)
    {
        // Mengunci tanggal minimal ke hari ini WIB
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        // 1. Validasi Input Dasar
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
            'jadwal_id'   => 'required|exists:jadwals,id',
            'layanan_id'  => 'required|exists:layanans,id',
            'tanggal'     => 'required|date|after_or_equal:' . $today,
        ], [
            'tanggal.after_or_equal' => 'Tanggal pendaftaran tidak boleh memilih hari yang sudah lewat.',
        ]);

        // 2. Validasi Kecocokan Hari
        $jadwal = Jadwal::findOrFail($request->jadwal_id);
        
        $mapHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $hariDipilihIndo = $mapHari[Carbon::parse($request->tanggal)->format('l')];

        if (strtolower($hariDipilihIndo) !== strtolower($jadwal->hari)) {
            return back()->withInput()->withErrors([
                'tanggal' => "Dokter hanya praktik pada hari {$jadwal->hari}. Anda memilih hari {$hariDipilihIndo}."
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

            // 4. Lock For Update & Cek Kuota (Hanya menghitung antrean yang tidak Batal)
            $jumlahAntrean = JanjiTemu::where('tanggal_berobat', $request->tanggal)
                                      ->where('jadwal_id', $request->jadwal_id)
                                      ->where('status_booking', '!=', 'Batal')
                                      ->lockForUpdate() 
                                      ->count();

            $kuotaMaksimal = 20; 

            if ($jumlahAntrean >= $kuotaMaksimal) {
                DB::rollBack();
                return back()->withInput()->withErrors([
                    'kuota' => 'Mohon maaf, antrean jadwal ini sudah penuh (Maks: '.$kuotaMaksimal.' pasien).'
                ]);
            }

            // 5. Generate Nomor Antrean Baru
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

            // 6. Redirect Langsung ke Halaman Bukti / Invoice Booking Sukses
            return redirect()->route('booking.success', $janji->id);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->withErrors(['sistem' => 'Terjadi kesalahan sistem (Kode: '.$e->getMessage().'). Silakan coba lagi.']);
        }
    }

    /**
     * Menampilkan Halaman Bukti / Tiket Booking Invoice
     */
    public function success($id)
    {
        $janji = JanjiTemu::with(['pasien', 'jadwal.dokter', 'layanan.spesialisasi'])->findOrFail($id);
        
        // URL verifikasi tiket antrean untuk dipindai
        $qrUrl = route('booking.success', $janji->id);

        return view('frontend.booking_success', compact('janji', 'qrUrl'));
    }

    /**
     * Generasi & Download PDF Tiket Booking
     */
    public function downloadPdf($id)
    {
        $janji = JanjiTemu::with(['pasien', 'jadwal.dokter', 'layanan.spesialisasi'])->findOrFail($id);
        
        $qrUrl = route('booking.success', $janji->id);

        // Generate QR Code ke bentuk Base64 SVG agar dapat dirender oleh DomPDF
        $qrCodeBase64 = base64_encode(QrCode::format('svg')->size(130)->errorCorrection('H')->generate($qrUrl));

        $pdf = Pdf::loadView('pdf.tiket_booking', compact('janji', 'qrCodeBase64'))
                  ->setPaper('a5', 'portrait');

        return $pdf->download('Bukti-Booking-'.$janji->id.'.pdf');
    }
}