<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Laravel berhasil berjalan';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|string',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|string',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}
