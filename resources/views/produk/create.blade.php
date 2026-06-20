@extends('layouts.app')

@section('content')
    <h1>Tambah Produk</h1>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nama_produk" placeholder="Nama Produk" required>

        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>

        <input type="number" name="harga" placeholder="Harga" required>

        <input type="number" name="stok" placeholder="Stok" required>

        <input type="file" name="gambar">

        <button type="submit">Simpan</button>
    </form>
@endsection