<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = Pasien::all();
        $rumahSakit = RumahSakit::all();
        return view('content.pasien.list', compact('pasien', 'rumahSakit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rumahSakit = RumahSakit::all();
        return view('content.pasien.create', compact('rumahSakit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'rumah_sakit_id' => 'required',
        ]);

        // Simpan data Rumah Sakit ke database
        Pasien::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('showPasien')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('content.pasien.detail', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $rumahSakit = RumahSakit::all();
        return view('content.pasien.edit', compact('pasien', 'rumahSakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'rumah_sakit_id' => 'required',
        ]);

        $rumahSakit = Pasien::findOrFail($id);
        $rumahSakit->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'rumah_sakit_id' => $request->rumah_sakit_id,
        ]);

        return redirect()->route('showPasien')->with('success', 'Data Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    //filter pasien berdasarkan rumah sakit yang dipilih
    public function filterByRumahSakit(Request $request)
    {
        $rumahSakitId = $request->input('rumah_sakit_id');
        $query = Pasien::with('rumahSakit');

        if ($rumahSakitId) {
            $query->where('rumah_sakit_id', $rumahSakitId);
        }

        $pasien = $query->get();

        return response()->json($pasien);
    }
}
