<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil data jadwal sekaligus nama dokter (relasi)
        $jadwals = Jadwal::with('dokter')->latest()->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        // Mengirim daftar dokter ke halaman form untuk dropdown pilihan
        $dokters = Dokter::all();
        return view('jadwal.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai', // Mencegah jam selesai lebih dulu dari jam mulai
            'kuota_pasien' => 'required|integer|min:1',
        ], [
            'jam_selesai.after' => 'Jam selesai praktik harus setelah jam mulai praktik.'
        ]);

        // Logika Pengecekan Jadwal Bentrok
        $bentrok = Jadwal::where('dokter_id', $request->dokter_id)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereTime('jam_mulai', '<', $request->jam_selesai)
                      ->whereTime('jam_selesai', '>', $request->jam_mulai);
            })->first();

        if ($bentrok) {
            return back()->withInput()->withErrors(['waktu' => 'Gagal! Dokter tersebut sudah memiliki jadwal praktik yang bertabrakan di hari dan jam tersebut.']);
        }

        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $dokters = Dokter::all();
        return view('jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai', 
            'kuota_pasien' => 'required|integer|min:1',
        ], [
            'jam_selesai.after' => 'Jam selesai praktik harus setelah jam mulai praktik.'
        ]);

        // Pengecekan bentrok (kecuali jadwal yang sedang di-edit ini)
        $bentrok = Jadwal::where('dokter_id', $request->dokter_id)
            ->where('hari', $request->hari)
            ->where('id', '!=', $id) // Abaikan ID jadwal saat ini
            ->where(function ($query) use ($request) {
                $query->whereTime('jam_mulai', '<', $request->jam_selesai)
                      ->whereTime('jam_selesai', '>', $request->jam_mulai);
            })->first();

        if ($bentrok) {
            return back()->withInput()->withErrors(['waktu' => 'Gagal! Perubahan bertabrakan dengan jadwal lain milik dokter ini.']);
        }

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}