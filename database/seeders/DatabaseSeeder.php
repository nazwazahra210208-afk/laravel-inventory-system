<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data kategori statis
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Pakaian']);

        // Buat data dummy produk menggunakan factory
        Product::factory(10)->create();
    }
}