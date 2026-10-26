<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // JIKA CUSTOMER: Arahkan ke Dashboard VIP Store Customer
        if ($user && $user->role === 'customer') {
            $productsCount = Product::count();
            $categories = Category::all();
            return view('customer.dashboard', compact('productsCount', 'categories'));
        }

        // JIKA ADMIN / STAFF: Tampilkan Panel Manajemen Inventaris
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        
        $totalInventoryValue = Product::all()->sum(function($product) {
            $price = $product->selling_price ?? $product->price ?? 0;
            return $price * ($product->stock ?? $product->stok ?? 0);
        });

        $lowStockProducts = Product::where('stock', '<=', 5)->get();
        $lowStockCount = $lowStockProducts->count();
        $recentSales = Transaction::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalInventoryValue',
            'lowStockCount',
            'lowStockProducts',
            'recentSales'
        ));
    }
}