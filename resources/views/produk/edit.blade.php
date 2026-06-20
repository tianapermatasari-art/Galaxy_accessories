@extends('layouts.app')

@section('content')
    <h1>Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
        <textarea name="deskripsi">{{ $produk->deskripsi }}</textarea>
        <input type="number" name="harga" value="{{ $produk->harga }}" required>
        <input type="number" name="stok" value="{{ $produk->stok }}" required>
        <input type="text" name="gambar" value="{{ $produk->gambar }}">
        <button type="submit">Update</button>
    </form>
@endsection