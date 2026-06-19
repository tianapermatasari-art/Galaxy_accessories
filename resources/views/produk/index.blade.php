@extends('layouts.app')

@section('content')

<h3 class="mb-4 fw-bold">📦 Daftar Produk</h3>

<a href="{{ route('produk.create') }}" class="btn btn-primary mb-4 shadow-sm">
    + Tambah Produk
</a>

<div class="row g-4">

    @forelse ($produks as $produk)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0 product-card">

                {{-- Gambar --}}
                @if($produk->gambar)
                    <img src="{{ asset('images/' . $produk->gambar) }}" 
                         class="card-img-top img-card"
                         alt="{{ $produk->nama_produk }}">
                @else
                    <div class="text-center py-5 text-muted">
                        Tidak ada gambar
                    </div>
                @endif

                <div class="card-body d-flex flex-column">

                    {{-- Nama --}}
                    <h6 class="fw-bold mb-1">
                        {{ $produk->nama_produk }}
                    </h6>

                    {{-- Deskripsi --}}
                    <small class="text-muted mb-2">
                        {{ Str::limit($produk->deskripsi, 50) }}
                    </small>

                    {{-- Harga --}}
                    <div class="fw-bold text-success mb-2">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>

                    {{-- Stok --}}
                    <span class="badge bg-{{ $produk->stok > 0 ? 'success' : 'danger' }} mb-3">
                        Stok: {{ $produk->stok }}
                    </span>

                    {{-- Tombol --}}
                    <div class="mt-auto d-flex justify-content-between">
                        <a href="{{ route('produk.edit', $produk->id) }}" 
                           class="btn btn-warning btn-sm">
                            ✏
                        </a>

                        <form action="{{ route('produk.destroy', $produk->id) }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">
                                🗑
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <p class="text-muted">Belum ada produk</p>
    @endforelse

</div>

{{-- STYLE --}}
<style>
    .product-card {
        border-radius: 15px;
        transition: 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .img-card {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        transition: 0.3s;
    }

    .img-card:hover {
        transform: scale(1.05);
    }
</style>

@endsection
