@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📦 Daftar Produk</h3>
        <a href="{{ route('produk.create') }}" class="btn btn-primary shadow-sm">
            ➕ Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse ($produk as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm product-card">

                    {{-- Gambar --}}
                    @if($item->gambar && file_exists(public_path('images/' . $item->gambar)))
                        <img src="{{ asset('images/' . $item->gambar) }}" 
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $item->nama_produk }}</h5>

                        <p class="text-muted small">
                            {{ Str::limit($item->deskripsi, 80) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>

                            <span class="badge {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                Stok: {{ $item->stok }}
                            </span>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 text-center">
                        <a href="{{ route('produk.edit', $item->id) }}" 
                           class="btn btn-sm btn-warning me-1">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('produk.destroy', $item->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                <p>Belum ada produk</p>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $produk->links('pagination::bootstrap-5') }}
    </div>

</div>

<style>
.product-card {
    transition: 0.3s;
}

.product-card:hover {
    transform: translateY(-6px);
}
</style>

@endsection