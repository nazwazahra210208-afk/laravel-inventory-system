<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Pengguna (Admin, Staff, Customer)
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Luxury',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        $staff = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff Inventaris',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        $customer = User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer VIP',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // 2. Buat Kategori Produk
        $catWatch = Category::firstOrCreate(['name' => 'Jam Tangan & Aksesoris Mewah']);
        $catRing = Category::firstOrCreate(['name' => 'Perhiasan & Berlian']);
        $catPerfume = Category::firstOrCreate(['name' => 'Parfum & Kecantikan Eksklusif']);

        // 3. Buat Supplier Mitra
        $sup1 = Supplier::firstOrCreate(['name' => 'The Hour Glass Indonesia', 'phone' => '0215551234', 'address' => 'Jakarta Selatan']);
        $sup2 = Supplier::firstOrCreate(['name' => 'MAP Luxury Boutique', 'phone' => '0215555678', 'address' => 'Central Park Jakarta']);
        $sup3 = Supplier::firstOrCreate(['name' => 'Pacific Luxury Distribution', 'phone' => '0215559012', 'address' => 'Plaza Indonesia']);

        // 4. Buat Produk dengan 'purchase_price' dan 'selling_price'
        $p1 = Product::updateOrCreate(
            ['sku' => 'LUX-RLX-01'],
            [
                'category_id' => $catWatch->id,
                'name' => 'Rolex Submariner Date Watch',
                'purchase_price' => 120000000,
                'selling_price' => 150000000,
                'stock' => 18,
            ]
        );
        $p1->suppliers()->sync([$sup1->id]);

        $p2 = Product::updateOrCreate(
            ['sku' => 'LUX-TIF-02'],
            [
                'category_id' => $catRing->id,
                'name' => 'Tiffany & Co. Solitaire Diamond Ring',
                'purchase_price' => 50000000,
                'selling_price' => 65000000,
                'stock' => 12,
            ]
        );
        $p2->suppliers()->sync([$sup2->id]);

        $p3 = Product::updateOrCreate(
            ['sku' => 'LUX-BVG-03'],
            [
                'category_id' => $catRing->id,
                'name' => 'Bvlgari B.zero1 Ring Diamond',
                'purchase_price' => 60000000,
                'selling_price' => 75000000,
                'stock' => 10,
            ]
        );
        $p3->suppliers()->sync([$sup2->id]);

        $p4 = Product::updateOrCreate(
            ['sku' => 'LUX-TFD-04'],
            [
                'category_id' => $catPerfume->id,
                'name' => 'Tom Ford Private Blend Perfume',
                'purchase_price' => 4000000,
                'selling_price' => 5500000,
                'stock' => 30,
            ]
        );
        $p4->suppliers()->sync([$sup3->id]);

        $p5 = Product::updateOrCreate(
            ['sku' => 'LUX-PTK-05'],
            [
                'category_id' => $catWatch->id,
                'name' => 'Patek Philippe Nautilus Luxury',
                'purchase_price' => 700000000,
                'selling_price' => 850000000,
                'stock' => 29,
            ]
        );
        $p5->suppliers()->sync([$sup1->id]);
    }
}