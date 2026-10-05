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
use App\Models\Jadwal;
use App\Models\Layanan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('frontend.beranda');
});

Route::get('/buat-janji', [BookingController::class, 'create'])->name('booking.create');
Route::post('/buat-janji', [BookingController::class, 'store'])->name('booking.store');

Route::get('/jadwal-dokter', function (Request $request) {
    // 1. Mulai query dengan relasi dokter
    $query = Jadwal::with('dokter');

    // 2. Filter berdasarkan Pencarian Cepat (nama atau keahlian)
    if ($request->has('q') && $request->q != '') {
        $keyword = $request->q;
        $query->whereHas('dokter', function($q) use ($keyword) {
            $q->where('nama_dokter', 'like', '%' . $keyword . '%')
              ->orWhere('spesialisasi', 'like', '%' . $keyword . '%');
        });
    }

    // 3. Filter berdasarkan Spesialisasi (dropdown/kategori cepat)
    if ($request->has('spesialisasi') && $request->spesialisasi != '') {
        $spesialis = $request->spesialisasi;
        $query->whereHas('dokter', function($q) use ($spesialis) {
            $q->where('spesialisasi', $spesialis);
        });
    }

    // 4. Filter berdasarkan Hari Praktik (dropdown)
    if ($request->has('hari') && $request->hari != '') {
        $query->where('hari', $request->hari);
    }

    // 5. Ambil hasil akhirnya
    $jadwals = $query->get();

    return view('frontend.jadwal', compact('jadwals'));
})->name('jadwal');

Route::get('/kontak', function () {
    return view('frontend.kontak');
})->name('kontak');

Route::get('/layanan-biaya', function () {
    $layanans = Layanan::all();
    return view('frontend.layanan', compact('layanans'));
})->name('layanan');

Route::get('/dashboard', function () {
    // Mengambil data statistik secara real-time
    $totalPasien = \App\Models\Pasien::count();
    $totalDokter = \App\Models\Dokter::count();
    $totalLayanan = \App\Models\Layanan::count();
    
    // Menghitung antrean khusus untuk tanggal hari ini
    $antreanHariIni = \App\Models\JanjiTemu::whereDate('tanggal_berobat', \Carbon\Carbon::today())->count();
    
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
    Route::resource('spesialisasi', \App\Http\Controllers\SpesialisasiController::class);
});

require __DIR__.'/auth.php';