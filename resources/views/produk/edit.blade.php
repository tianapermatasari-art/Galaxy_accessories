@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4 fw-bold">✏️ Edit Produk</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control"
                           value="{{ $produk->nama_produk }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">
{{ $produk->deskripsi }}
                    </textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control"
                               value="{{ $produk->harga }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control"
                               value="{{ $produk->stok }}" required>
                    </div>
                </div>

                {{-- Preview gambar --}}
                @if($produk->gambar)
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="{{ asset('images/' . $produk->gambar) }}"
                             width="150" class="rounded shadow">
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    ✅ Update
                </button>

                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>
@endsection