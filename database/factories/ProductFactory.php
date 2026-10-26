<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 2), // Menyebar kategori secara acak antara 1 dan 2
            'sku' => 'LUX-' . fake()->unique()->numerify('###'),
            'name' => fake()->unique()->randomElement([
                'Rolex Submariner Date Watch',
                'Cartier Love Gold Bracelet',
                'Chanel Classic Flap Handbag',
                'Louis Vuitton Keepall Bandouliere',
                'Hermes Birkin Leather Bag',
                'Tom Ford Private Blend Perfume',
                'Apple iPhone 17 Pro Max Gold Edition',
                'Bvlgari B.zero1 Ring Diamond',
                'Tiffany & Co. Solitaire Diamond Ring',
                'Patek Philippe Nautilus Luxury'
            ]),
            'purchase_price' => fake()->numberBetween(5000000, 15000000), // Harga beli realistis
            'selling_price' => fake()->numberBetween(16000000, 35000000), // Harga jual realistis
            'stock' => fake()->numberBetween(5, 25),
        ];
    }
}