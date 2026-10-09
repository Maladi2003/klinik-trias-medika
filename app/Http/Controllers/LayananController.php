<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Spesialisasi;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('spesialisasi')->latest()->get();
        $spesialisasis = Spesialisasi::all();

        return view('layanan.index', compact('layanans', 'spesialisasis'));
    }

    public function create()
    {
        $spesialisasis = Spesialisasi::all();
        return view('layanan.create', compact('spesialisasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'spesialisasi_id' => 'required|exists:spesialisasis,id',
            'nama_layanan'    => 'required|string|max:255',
            'estimasi_biaya'  => 'required|numeric|min:0',
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil ditambahkan!');
    }

    public function destroy(string $id)
    {
        Layanan::findOrFail($id)->delete();
        return back()->with('success', 'Data layanan berhasil dihapus.');
    }
}