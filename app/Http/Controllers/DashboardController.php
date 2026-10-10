<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Ringkasan Utama
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalInventoryValue = Product::sum(\DB::raw('price * stock'));
        $lowStockProducts = Product::where('stock', '<=', 5)->count(); // Indikator stok menipis (<= 5)

        // 2. Data Produk Stok Menipis untuk Peringatan Dini
        $lowStockList = Product::where('stock', '<=', 5)->take(5)->get();

        // 3. Aktivitas Transaksi Terbaru
        $recentTransactions = Transaction::with(['product', 'user'])->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalProducts', 
            'totalCategories', 
            'totalSuppliers', 
            'totalInventoryValue', 
            'lowStockProducts', 
            'lowStockList', 
            'recentTransactions'
        ));
    }
}