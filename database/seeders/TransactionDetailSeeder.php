<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionDetailSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $transactionIds = DB::table('transactions')->pluck('id');
        $productIds = DB::table('products')->pluck('id');


        if ($transactionIds->isEmpty() || $productIds->isEmpty()) {
            $this->command->info('Tabel transactions atau products kosong. Pastikan tabel ini memiliki data sebelum menjalankan seeder ini.');
            return;
        }

        foreach (range(1, 100) as $index) {
            $productId = $faker->randomElement($productIds);
            $quantity = $faker->numberBetween(1, 10);
            $unitPrice = $faker->randomFloat(2, 1000, 5000); // Harga satuan antara 1000-5000
            $subtotal = $quantity * $unitPrice;

            DB::table('transaction_details')->insert([
                'transaction_id' => $faker->randomElement($transactionIds),
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
