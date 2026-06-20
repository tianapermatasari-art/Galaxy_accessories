@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📦 Daftar Produk</h3>
        {{-- Tombol Menuju Form Tambah Produk --}}
        <a href="{{ route('produk.create') }}" class="btn btn-primary">
            ➕ Tambah Produk
        </a>
    </div>

    {{-- Notifikasi Sukses dari Controller --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="15%">Gambar</th>
                            <th width="25%">Nama Produk</th>
                            <th width="15%">Harga</th>
                            <th width="10%" class="text-center">Stok</th>
                            <th width="30%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produk as $key => $item)
                            <tr>
                                <td class="text-center fw-bold">
                                    {{ $produk->firstItem() + $key }}
                                </td>
                                <td>
                                    @if($item->gambar)
                                        {{-- Menampilkan gambar dari folder storage --}}
                                        <img src="{{ asset('storage/produk/' . $item->gambar) }}" 
                                             alt="{{ $item->nama_produk }}" 
                                             class="rounded" 
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        {{-- Gambar Placeholder jika produk tidak punya gambar --}}
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $item->nama_produk }}</div>
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                        {{ $item->deskripsi }}
                                    </small>
                                </td>
                                <td class="text-success fw-semibold">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $item->stok > 0 ? 'bg-info' : 'bg-danger' }}">
                                        {{ $item->stok }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{-- Group Tombol Aksi --}}
                                    <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" 
                                          action="{{ route('produk.destroy', $item->id) }}" 
                                          method="POST">
                                        
                                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">
                                            ✏️ Edit
                                        </a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <p class="mb-0">Belum ada data produk tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Navigasi Pagination (Halaman) --}}
    <div class="mt-3 d-flex justify-content-end">
        {{ $produk->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection