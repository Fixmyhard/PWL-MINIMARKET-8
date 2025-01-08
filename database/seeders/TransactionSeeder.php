<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $branchIds = DB::table('branches')->pluck('id');

        foreach (range(1, 50) as $index) {
            DB::table('transactions')->insert([
                'branch_id' => $faker->randomElement($branchIds),
                'transaction_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'total_amount' => $faker->randomFloat(2, 1000, 50000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
