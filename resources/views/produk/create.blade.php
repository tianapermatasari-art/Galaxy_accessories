@extends('layouts.app')

@section('content')
    <h1>Tambah Produk</h1>
    <form action="{{ route('produks.store') }}" method="POST">
        @csrf
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="text" name="gambar" placeholder="Nama File Gambar">
        <button type="submit">Simpan</button>
    </form>
@endsection
