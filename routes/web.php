<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Halaman utama diarahkan langsung ke Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rute yang dilindungi oleh middleware 'auth' (Harus Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard & Laporan Inventory
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Master Data Kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Master Data Supplier
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Transaksi (Barang Masuk, Keluar, & Riwayat)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/in', [TransactionController::class, 'createIn'])->name('transactions.in');
    Route::post('/transactions/in', [TransactionController::class, 'storeIn'])->name('transactions.in.store');
    Route::get('/transactions/out', [TransactionController::class, 'createOut'])->name('transactions.out');
    Route::post('/transactions/out', [TransactionController::class, 'storeOut'])->name('transactions.out.store');
});

// Memuat rute autentikasi bawaan
require __DIR__.'/auth.php';