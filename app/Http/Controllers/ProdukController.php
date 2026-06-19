<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // 🔹 Tampilkan semua produk
    public function index()
    {
        $produks = Produk::latest()->get();
        return view('produk.index', compact('produks'));
    }

    // 🔹 Form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // 🔹 Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'deskripsi'   => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $gambar);
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'gambar'      => $gambar
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // 🔹 Form edit
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // 🔹 Update data
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required',
            'deskripsi'   => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $gambar);

            $produk->gambar = $gambar;
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'gambar'      => $produk->gambar
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    // 🔹 Hapus data
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // hapus gambar jika ada
        if ($produk->gambar && file_exists(public_path('images/' . $produk->gambar))) {
            unlink(public_path('images/' . $produk->gambar));
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}