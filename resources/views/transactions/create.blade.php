@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 30px;">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Tambah Transaksi Baru</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Catat barang masuk (restock) atau barang keluar manual ke sistem inventaris</p>
            </div>

            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Pilih Produk</label>
                    <select name="product_id" required style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                        <option value="">-- Pilih Produk Inventaris --</option>
                        @foreach($products ?? [] as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Tipe Transaksi</label>
                    <select name="type" required style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                        <option value="in">Barang Masuk (Restock / Tambah Stok)</option>
                        <option value="out">Barang Keluar (Kurangi Stok)</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Jumlah (Quantity)</label>
                    <input type="number" name="quantity" min="1" value="1" required style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                </div>

                <div style="display: flex; gap: 12px; align-items: center;">
                    <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;">
                        Simpan Transaksi
                    </button>
                    <a href="{{ route('transactions.index') }}" style="background: rgba(30, 41, 59, 0.8); color: #94a3b8; font-weight: 600; padding: 12px 20px; border-radius: 8px; text-decoration: none; border: 1px solid #374151;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection