@extends('layouts.app')

@section('content')
    <div style="max-width: 650px; margin: 30px auto; background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; font-size: 24px; font-weight: 700; margin-bottom: 5px;">✏️ Edit Data Produk</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Perbarui spesifikasi dan kategori produk inventaris</p>

        @if($errors->any())
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pilihan Kategori (Dropdown) -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Kategori Produk</label>
                <select name="category_id" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kode SKU -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Kode SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <!-- Nama Produk -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <!-- Harga -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Harga (Rp)</label>
                <input type="number" step="any" name="price" value="{{ old('price', $product->price) }}" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <!-- Stok -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Jumlah Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="flex: 1; padding: 14px; font-size: 15px; font-weight: 600; color: #ffffff; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: none; border-radius: 10px; cursor: pointer;">Simpan Perubahan</button>
                <a href="{{ route('products.index') }}" style="padding: 14px 24px; font-size: 15px; font-weight: 500; color: #475569; background: #e2e8f0; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Batal</a>
            </div>
        </form>
    </div>
@endsection