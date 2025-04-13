<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showRumahSakit()
    {
        $rumahSakit = RumahSakit::all();
        return view('content.rumah_sakit.list', compact('rumahSakit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.rumah_sakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:rumah_sakits,email',
            'telp' => 'required|string|max:15',
        ]);

        // Simpan data Rumah Sakit ke database
        RumahSakit::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('showRumahSakit')->with('success', 'Rumah Sakit berhasil ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumahSakit = RumahSakit::with('pasien')->findOrFail($id);

        return view('content.rumah_sakit.detail', compact('rumahSakit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rumahSakit = RumahSakit::findOrFail($id);
        return view('content.rumah_sakit.edit', compact('rumahSakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'telp' => 'required|string|max:20',
        ]);

        $rumahSakit = RumahSakit::findOrFail($id);
        $rumahSakit->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telp' => $request->telp,
        ]);

        return redirect()->route('showRumahSakit')->with('success', 'Data rumah sakit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rs = RumahSakit::findOrFail($id);
        $rs->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
