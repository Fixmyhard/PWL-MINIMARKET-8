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
        $this->call([
            BranchSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            StockSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}