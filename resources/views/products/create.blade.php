@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Tambah Produk Baru</h2>
            <p class="text-sm mt-1" style="color: #94a3b8 !important;">Masukkan informasi detail produk inventaris baru</p>
        </div>

        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                <ul style="list-style-type: disc; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" style="background-color: #111827; border: 1px solid #1f2937; border-radius: 12px; padding: 30px;">
            @csrf

            <!-- Kategori Produk -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Kategori Produk</label>
                <select name="category_id" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kode SKU -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Kode SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}" placeholder="Contoh: LUX-RLX-01" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
            </div>

            <!-- Nama Produk -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Rolex Submariner Date Watch" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Harga Beli -->
                <div>
                    <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Harga Beli (Rp)</label>
                    <input type="number" name="purchase_price" value="{{ old('purchase_price', 0) }}" min="0" step="any" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                </div>
                <!-- Harga Jual -->
                <div>
                    <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Harga Jual (Rp)</label>
                    <input type="number" name="selling_price" value="{{ old('selling_price', 0) }}" min="0" step="any" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <!-- Stok Awal -->
                <div>
                    <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                </div>
                <!-- Minimum Stok -->
                <div>
                    <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Minimum Stok</label>
                    <input type="number" name="minimum_stock" value="{{ old('minimum_stock', 5) }}" min="0" required style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                </div>
            </div>

            <!-- Pilih Supplier -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; color: #fef08a; font-size: 14px; font-weight: 600; margin-bottom: 8px;">Pilih Supplier</label>
                <select name="supplier_id" style="width: 100%; background-color: #030712; border: 1px solid #374151; color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                    <option value="">-- Pilih Supplier Utama (Opsional) --</option>
                    @forelse($suppliers ?? [] as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }} ({{ $supplier->phone }})
                        </option>
                    @empty
                        <option value="" disabled>Belum ada data supplier tersedia.</option>
                    @endforelse
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('products.index') }}" style="background: rgba(107, 114, 128, 0.2); color: #d1d5db; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">Batal</a>
                <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px;">
                    💾 Simpan Produk
                </button>
            </div>
        </form>

    </div>
</div>
@endsection