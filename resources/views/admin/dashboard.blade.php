@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<!-- Wrapper Utama denganBackground Hitam Obsidian yang Senada -->
<div class="-mt-6 -mx-4 sm:-mx-6 lg:-mx-8 min-h-screen bg-[#0b0f19] py-10 px-4 sm:px-6 lg:px-8 text-gray-100">
    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- Header Banner Mewah -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-gray-900 via-gray-800 to-black p-8 sm:p-10 border border-amber-500/30 shadow-2xl shadow-amber-500/10">
            <div class="absolute -right-10 -top-10 w-60 h-60 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-semibold tracking-wider uppercase mb-3">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        VIP Luxury Inventory Suite
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                        Dashboard Eksekutif, <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-400 to-yellow-500">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-gray-400 mt-2 text-sm sm:text-base max-w-2xl">
                        Pusat kendali inventaris eksklusif kelas dunia. Pantau pergerakan stok, nilai aset, dan analisis transaksi secara real-time dengan presisi tinggi.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-300 font-bold text-xs tracking-widest uppercase shadow-inner">
                        ROLE: {{ strtoupper(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistik Kartu Grid (Dark Luxury Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Total Produk -->
            <div class="group relative bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Koleksi Produk</p>
                        <h3 class="text-3xl font-extrabold text-white mt-2 group-hover:text-amber-400 transition-colors">{{ $totalProducts }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-800 flex items-center justify-between text-xs">
                    <span class="text-gray-400">Status: Aktif</span>
                    <a href="{{ route('products.index') }}" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1 transition-colors">
                        Kelola Produk &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 2: Total Kategori -->
            <div class="group relative bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 hover:border-emerald-500/50 transition-all duration-300 shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori Barang</p>
                        <h3 class="text-3xl font-extrabold text-white mt-2 group-hover:text-emerald-400 transition-colors">{{ $totalCategories }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-800 flex items-center justify-between text-xs">
                    <span class="text-gray-400">Klasifikasi</span>
                    <a href="{{ route('categories.index') }}" class="text-emerald-400 hover:text-emerald-300 font-semibold flex items-center gap-1 transition-colors">
                        Kelola Kategori &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 3: Total Supplier -->
            <div class="group relative bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Supplier Mitra</p>
                        <h3 class="text-3xl font-extrabold text-white mt-2 group-hover:text-amber-400 transition-colors">{{ $totalSuppliers }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-800 flex items-center justify-between text-xs">
                    <span class="text-gray-400">Mitra Resmi</span>
                    <a href="{{ route('suppliers.index') }}" class="text-amber-400 hover:text-amber-300 font-semibold flex items-center gap-1 transition-colors">
                        Kelola Supplier &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 4: Total Transaksi -->
            <div class="group relative bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-2xl p-6 hover:border-purple-500/50 transition-all duration-300 shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Transaksi</p>
                        <h3 class="text-3xl font-extrabold text-white mt-2 group-hover:text-purple-400 transition-colors">{{ $totalSales ?? 0 }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-800 flex items-center justify-between text-xs">
                    <span class="text-gray-400">Laporan Penjualan</span>
                    <a href="{{ route('transactions.index') }}" class="text-purple-400 hover:text-purple-300 font-semibold flex items-center gap-1 transition-colors">
                        Lihat Laporan &rarr;
                    </a>
                </div>
            </div>

        </div>

        <!-- Quick Actions & Panel Tambahan -->
        <div class="bg-gray-900/90 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 shadow-2xl">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-white">Aksi Cepat Eksekutif</h3>
                <p class="text-gray-400 text-sm mt-1">Pintasan operasional untuk manajemen inventaris harian.</p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-400 hover:to-yellow-500 text-gray-950 font-bold text-sm shadow-lg shadow-amber-500/20 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Produk Baru
                </a>
                <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gray-800 hover:bg-gray-700 text-white font-semibold text-sm border border-gray-700 transition-all duration-300">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Kelola Transaksi Penjualan
                </a>
            </div>
        </div>

    </div>
</div>
@endsection