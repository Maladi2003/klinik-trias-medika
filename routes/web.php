<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\SpesialisasiController;
use App\Models\Jadwal;
use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JanjiTemu;
use App\Models\Spesialisasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

// --- RUTE PUBLIK / FRONTEND ---
Route::get('/', function () {
    return view('frontend.beranda');
});

Route::get('/buat-janji', [BookingController::class, 'create'])->name('booking.create');

// Proteksi Rate Limiting: Membatasi maksimal 5 kali submit per 1 menit per Alamat IP
Route::post('/buat-janji', [BookingController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('booking.store');

// Rute Bukti Booking & Invoice PDF (Menggunakan UUID pada parameter {id})
Route::get('/booking/sukses/{id}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/pdf/{id}', [BookingController::class, 'downloadPdf'])->name('booking.pdf');

Route::get('/jadwal-dokter', function (Request $request) {
    $query = Jadwal::with('dokter');

    // 1. Pencarian Cepat (Nama Dokter / Spesialisasi)
    if ($request->filled('q')) {
        $keyword = $request->q;
        $query->whereHas('dokter', function($q) use ($keyword) {
            $q->where('nama_dokter', 'like', '%' . $keyword . '%')
              ->orWhere('spesialisasi', 'like', '%' . $keyword . '%');
        });
    }

    // 2. Filter Spesialisasi Fleksibel
    if ($request->filled('spesialisasi')) {
        $spesialis = $request->spesialisasi;
        $clean = trim(str_replace(['Dokter', 'Poli'], '', $spesialis));

        $query->whereHas('dokter', function($q) use ($spesialis, $clean) {
            $q->where('spesialisasi', 'like', '%' . $spesialis . '%')
              ->orWhere('spesialisasi', 'like', '%' . $clean . '%');
        });
    }

    // 3. Filter Hari Praktik
    if ($request->filled('hari')) {
        $query->where('hari', $request->hari);
    }

    $jadwals = $query->get();
    $spesialisasis = Spesialisasi::all();

    return view('frontend.jadwal', compact('jadwals', 'spesialisasis'));
})->name('jadwal');

Route::get('/kontak', function () {
    return view('frontend.kontak');
})->name('kontak');

Route::get('/layanan-biaya', function () {
    $layanans = Layanan::all();
    return view('frontend.layanan', compact('layanans'));
})->name('layanan');

// --- RUTE PANEL ADMIN (PROTECTED AUTH) ---
Route::get('/dashboard', function () {
    $totalPasien = Pasien::count();
    $totalDokter = Dokter::count();
    $totalLayanan = Layanan::count();
    $antreanHariIni = JanjiTemu::whereDate('tanggal_berobat', Carbon::today())->count();
    
    return view('dashboard', compact('totalPasien', 'totalDokter', 'totalLayanan', 'antreanHariIni'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('resep', ResepController::class);
    Route::resource('janji-temu', JanjiTemuController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('spesialisasi', SpesialisasiController::class);
});

Route::get('/google0f8d1a4591fe8521.html', function () {
    return response()->file(public_path('google0f8d1a4591fe8521.html'));
});
Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'));
});

Route::get('/robots.txt', function () {
    return response()->file(public_path('robots.txt'));
});
Route::get('/', function () {
    return response(view('index'))
        ->header('Cache-Control', 'public, max-age=3600, s-maxage=86400, stale-while-revalidate=59');
});
require __DIR__.'/auth.php';