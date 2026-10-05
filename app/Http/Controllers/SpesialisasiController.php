<?php

namespace App\Http\Controllers;

use App\Models\Spesialisasi;
use Illuminate\Http\Request;

class SpesialisasiController extends Controller
{
    public function index()
    {
        $spesialisasis = Spesialisasi::latest()->get();
        return view('spesialisasi.index', compact('spesialisasis'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_spesialisasi' => 'required|string|max:255']);
        Spesialisasi::create(['nama_spesialisasi' => $request->nama_spesialisasi]);
        return redirect()->back()->with('success', 'Spesialisasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Spesialisasi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Spesialisasi berhasil dihapus!');
    }
}