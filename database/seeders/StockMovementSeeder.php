<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StockMovementSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $branchIds = DB::table('branches')->pluck('id');
        $productIds = DB::table('products')->pluck('id');
        $userIds = DB::table('update_users')->pluck('id');

        foreach (range(1, 50) as $index) {
            DB::table('stock_movements')->insert([
                'id_cabang' => $faker->randomElement($branchIds),
                'id_produk' => $faker->randomElement($productIds),
                'user_id' => $faker->randomElement($userIds),
                'movement_type' => $faker->randomElement(['in', 'out']),
                'jumlah' => $faker->numberBetween(1, 100),
                'deskripsi' => $faker->sentence(),
                'tanggal_perubahan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
