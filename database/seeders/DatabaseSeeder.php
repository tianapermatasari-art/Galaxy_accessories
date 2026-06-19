<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Contoh: generate 10 user dummy
        \App\Models\User::factory(10)->create();

        // Contoh: 1 user spesifik
        \App\Models\User::factory()->create([
            'name' => 'Admin Galaxy Accesoris',
            'email' => 'admin@galaxy.com',
        ]);

        // Panggil seeder lain (misalnya ProdukSeeder)
        $this->call([
            ProdukSeeder::class,
        ]);
    }
}
