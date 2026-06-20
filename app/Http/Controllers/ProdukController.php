@extends('layouts.app')

@section('content')

<div class="container">

```
<h3 class="mb-4 fw-bold">➕ Tambah Produk</h3>

{{-- Notifikasi error --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Produk --}}
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            {{-- Upload Gambar --}}
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" onchange="previewImage(event)">
            </div>

            {{-- Preview Gambar --}}
            <div class="mb-3 text-center">
                <img id="preview" src="#" class="img-fluid d-none rounded" style="max-height:200px;">
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    ⬅ Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    💾 Simpan Produk
                </button>
            </div>

        </form>

    </div>
</div>
```

</div>

{{-- SCRIPT PREVIEW GAMBAR --}}

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
    }
}
</script>

@endsection
