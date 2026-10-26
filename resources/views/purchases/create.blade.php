@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Form Input Pembelian Stok (Stock-In)</h2>
            <p class="text-sm mt-1" style="color: #94a3b8 !important;">Catat pengadaan barang baru dari supplier dan tambah stok otomatis</p>
        </div>

        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST" style="background-color: #111827; border: 1px solid #1f2937; border-radius: 12px; padding: 30px;">
            @csrf

            <!-- Pilih Supplier -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Pilih Supplier</label>
                <select name="supplier_id" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                    <option value="">-- Pilih Supplier Resmi --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }} ({{ $supplier->phone }})</option>
                    @endforeach
                </select>
            </div>

            <hr style="border-color: #1f2937; margin: 25px 0;">

            <!-- Item Produk Pembelian -->
            <div style="margin-bottom: 20px;">
                <h3 style="color: #fef08a; font-size: 16px; font-weight: 600; margin-bottom: 12px;">Item Produk yang Dibeli</h3>
                
                <div style="background-color: #030712; border: 1px solid #1f2937; border-radius: 8px; padding: 16px; display: grid; gap: 15px;">
                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 12px;">
                        <div>
                            <label style="color: #94a3b8; font-size: 12px; display: block; margin-bottom: 4px;">Produk</label>
                            <select name="items[0][product_id]" required style="width: 100%; background-color: #111827; border: 1px solid #374151; color: #ffffff; padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="color: #94a3b8; font-size: 12px; display: block; margin-bottom: 4px;">Kuantitas</label>
                            <input type="number" name="items[0][quantity]" value="1" min="1" required style="width: 100%; background-color: #111827; border: 1px solid #374151; color: #ffffff; padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                        </div>
                        <div>
                            <label style="color: #94a3b8; font-size: 12px; display: block; margin-bottom: 4px;">Harga Beli Satuan (Rp)</label>
                            <input type="number" name="items[0][unit_cost]" value="0" min="0" step="any" required style="width: 100%; background-color: #111827; border: 1px solid #374151; color: #ffffff; padding: 8px 12px; border-radius: 6px; font-size: 13px;">
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px;">
                <a href="{{ route('purchases.index') }}" style="background: rgba(107, 114, 128, 0.2); color: #d1d5db; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">Batal</a>
                <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px;">
                    💾 Simpan Pembelian & Tambah Stok
                </button>
            </div>
        </form>

    </div>
</div>
@endsection