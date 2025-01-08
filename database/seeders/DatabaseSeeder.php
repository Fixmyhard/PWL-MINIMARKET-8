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
            ProductSeeder::class,
            StockSeeder::class,
            TransactionSeeder::class,
            TransactionDetailSeeder::class,
            StockMovementSeeder::class,
        ]);
    }
}
