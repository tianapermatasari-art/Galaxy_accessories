<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;


Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
Route::resource('produk', ProdukController::class);
