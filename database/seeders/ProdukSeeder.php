<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama_produk' => 'Gelang Fashion',
                'deskripsi'   => 'Gelang stylish dengan desain modern dan elegan',
                'harga'       => 50000,
                'stok'        => 100,
                'gambar'      => 'gelang.jpeg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_produk' => 'Cincin Silver',
                'deskripsi'   => 'Cincin berbahan silver dengan tampilan mewah',
                'harga'       => 85000,
                'stok'        => 75,
                'gambar'      => 'cincin.webp',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_produk' => 'Bandana Motif',
                'deskripsi'   => 'Bandana dengan berbagai motif menarik dan nyaman digunakan',
                'harga'       => 30000,
                'stok'        => 120,
                'gambar'      => 'bandana.webp',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_produk' => 'Kalung Aksesoris',
                'deskripsi'   => 'Kalung elegan yang cocok untuk berbagai acara',
                'harga'       => 95000,
                'stok'        => 60,
                'gambar'      => 'kalung1.jpeg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}