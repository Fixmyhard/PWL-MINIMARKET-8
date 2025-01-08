<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

     
        $branchIds = DB::table('branches')->pluck('id');
        $productIds = DB::table('products')->pluck('id');

        foreach (range(1, 100) as $index) {
            DB::table('stocks')->insert([
                'branch_id' => $faker->randomElement($branchIds), 
                'product_id' => $faker->randomElement($productIds),
                'quantity' => $faker->numberBetween(1, 100), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
