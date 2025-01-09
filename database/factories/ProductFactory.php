<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'nama_produk' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1000, 100000), // Harga antara Rp1,000 - Rp100,000
        ];
    }
}
