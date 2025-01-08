<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $productNames = [
            'Roti', 'Mouse', 'Pulpen', 'Kursi', 'Meja', 'Laptop', 'Keyboard', 'Buku', 
            'Kacamata', 'Tas', 'Sepatu', 'Jam Tangan', 'Kulkas', 'Televisi', 'Handphone', 
            'Microwave', 'Lampu', 'Sofa', 'Kipas Angin', 'Kamera', 'Smartwatch'
        ];

        foreach (range(1, 50) as $index) {
            DB::table('products')->insert([
                'nama_produk' => $faker->randomElement($productNames), // Pilih nama produk acak dari daftar
                'harga_produk' => $faker->randomFloat(2, 100, 1000), // Harga acak antara 100 sampai 1000
            ]);
        }
    }
}
