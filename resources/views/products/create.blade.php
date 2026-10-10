@extends('layouts.app')

@section('content')
    <div style="max-width: 650px; margin: 30px auto; background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        
        <div style="margin-bottom: 30px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
            <h2 style="color: #0f172a; font-size: 24px; font-weight: 700; margin: 0 0 5px 0;">+ Entri Produk Baru</h2>
            <p style="color: #64748b; font-size: 14px; margin: 0;">Tambahkan data inventaris beserta supplier pengampunya</p>
        </div>

        @if ($errors->any())
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">ID Kategori (Category ID)</label>
                <input type="number" name="category_id" value="{{ old('category_id') }}" required placeholder="Contoh: 1" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Kode SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}" required placeholder="Contoh: PRD-001" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Louis Vuitton Neverfull MM" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Harga (Rp)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required placeholder="25000000" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none;">
                </div>
                <div>
                    <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" required placeholder="10" style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none;">
                </div>
            </div>

            <!-- Pilihan Supplier (Many-to-Many Checkbox) -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Pilih Supplier (Bisa lebih dari satu)</label>
                <div style="display: flex; flex-direction: column; gap: 8px; background: #f8fafc; padding: 14px; border: 1px solid #cbd5e1; border-radius: 10px; max-height: 160px; overflow-y: auto;">
                    @forelse($suppliers as $supplier)
                        <label style="color: #334155; font-size: 14px; display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="suppliers[]" value="{{ $supplier->id }}" 
                                {{ is_array(old('suppliers')) && in_array($supplier->id, old('suppliers')) ? 'checked' : '' }}
                                style="width: 16px; height: 16px; accent-color: #ca8a04;">
                            {{ $supplier->name }}
                        </label>
                    @empty
                        <span style="color: #64748b; font-size: 13px; font-style: italic;">Belum ada data supplier. Tambahkan dulu di menu Supplier.</span>
                    @endforelse
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="flex: 1; padding: 14px; font-size: 15px; font-weight: 600; color: #1a1a1a; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3);">Simpan Produk</button>
                <a href="{{ route('products.index') }}" style="padding: 14px 24px; font-size: 15px; font-weight: 500; color: #475569; background: #e2e8f0; border-radius: 10px; text-decoration: none; text-align: center;">Batal</a>
            </div>
        </form>
    </div>
@endsection