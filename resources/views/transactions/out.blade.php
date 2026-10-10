@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 30px auto; background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; font-size: 24px; font-weight: 700; margin-bottom: 5px;">📤 Catat Barang Keluar</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Mengurangi stok produk karena penjualan atau distribusi</p>

        @if(session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">{{ session('error') }}</div>
        @endif

        <form action="{{ route('transactions.out.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Pilih Produk</label>
                <select name="product_id" required style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} (Stok Tersedia: {{ $p->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Jumlah Keluar</label>
                <input type="number" name="quantity" min="1" required placeholder="Contoh: 2" style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase;">Catatan / Keterangan</label>
                <input type="text" name="notes" placeholder="Contoh: Penjualan kepada klien VIP" style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            </div>

            <div style="display: flex; gap: 12px;">
                <!-- Tombol dengan Tema Luxury Dark & Gold -->
                <button type="submit" style="flex: 1; padding: 14px; font-size: 15px; font-weight: 600; color: #ffffff; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1px solid rgba(202, 138, 4, 0.4); border-radius: 10px; cursor: pointer; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);">Simpan Barang Keluar</button>
                <a href="{{ route('transactions.index') }}" style="padding: 14px 24px; font-size: 15px; font-weight: 500; color: #475569; background: #e2e8f0; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Batal</a>
            </div>
        </form>
    </div>
@endsection