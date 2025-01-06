<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            DB::table('branches')->insert([
                'nama_cabang' => $faker->company,
                'alias' => 'Cabang ' . $index,
                'telepon' => $faker->phoneNumber,
                'alamat' => $faker->address,
            ]);
        }
    }
}
