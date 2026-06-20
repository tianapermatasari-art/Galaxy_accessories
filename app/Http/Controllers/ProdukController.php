<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        $produk = Produk::latest()->paginate(10);
        return view('produk.index', compact('produk'));
    }

    /**
     * Menampilkan form tambah produk (View yang kamu buat sebelumnya)
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Menyimpan data produk baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // 2. Handle Upload Gambar jika ada
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            // Menyimpan ke folder 'public/produk' dengan nama unik
            $namaGambar = time() . '_' . $gambar->hashName();
            $gambar->storeAs('public/produk', $namaGambar);
        }

        // 3. Simpan data ke Database
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $namaGambar,
        ]);

        // 4. Redirect kembali dengan notifikasi sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}