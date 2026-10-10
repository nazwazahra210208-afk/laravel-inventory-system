@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        
        @if(session('success'))
            <div style="background: #f0fdf4; border-left: 4px solid #22c55e; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="color: #0f172a; margin: 0 0 6px 0; font-size: 24px; font-weight: 700;">Daftar Produk Inventaris</h2>
                <p style="color: #64748b; font-size: 14px; margin: 0;">Kelola data produk lengkap dengan filter, pencarian, dan sorting</p>
            </div>
            <div style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); padding: 8px 16px; border-radius: 10px; font-size: 12px; color: #1a1a1a; font-weight: 700; box-shadow: 0 4px 12px rgba(202, 138, 4, 0.2);">
                ROLE: {{ strtoupper(auth()->user()->role ?? 'STAFF') }}
            </div>
        </div>

        <!-- Form Search, Filter Kategori, dan Sorting -->
        <form action="{{ route('products.index') }}" method="GET" style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr auto auto; gap: 12px; margin-bottom: 30px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau SKU produk..." style="padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">

            <!-- Filter Kategori dengan Selected -->
            <select name="category_id" style="padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <!-- Sorting dengan Selected yang Diperbarui -->
            <select name="sort" style="padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Termurah</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Termahal</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                <option value="stock_low" {{ request('sort') == 'stock_low' ? 'selected' : '' }}>Stok Tersedikit</option>
            </select>

            <button type="submit" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; padding: 0 20px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 14px;">Terapkan</button>
            
            @if(request('search') || request('category_id') || request('sort'))
                <a href="{{ route('products.index') }}" style="background: #e2e8f0; color: #334155; padding: 12px 18px; border-radius: 10px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center;">Reset</a>
            @endif
        </form>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px 18px; text-align: left; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase;">SKU</th>
                        <th style="padding: 14px 18px; text-align: left; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase;">Nama Produk & Supplier</th>
                        <th style="padding: 14px 18px; text-align: left; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase;">Harga</th>
                        <th style="padding: 14px 18px; text-align: left; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase;">Stok</th>
                        <th style="padding: 14px 18px; text-align: left; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 18px; color: #64748b; font-weight: 500; font-size: 14px;">{{ $product->sku ?? '-' }}</td>
                            <td style="padding: 16px 18px;">
                                <div style="font-weight: 600; color: #0f172a; font-size: 14px; margin-bottom: 4px;">{{ $product->name }}</div>
                                <div style="display: flex; gap: 6px; flex-wrap: wrap; align-items: center;">
                                    @if($product->category && is_object($product->category))
                                        <span style="background: rgba(15, 23, 42, 0.08); color: #0f172a; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 600;">{{ $product->category->name }}</span>
                                    @endif
                                    @forelse($product->suppliers as $sup)
                                        <span style="background: rgba(202, 138, 4, 0.12); color: #b45309; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 600; border: 1px solid rgba(202, 138, 4, 0.2);">{{ $sup->name }}</span>
                                    @empty
                                        <span style="color: #94a3b8; font-size: 11px; font-style: italic;">Tanpa supplier</span>
                                    @endforelse
                                </div>
                            </td>
                            <td style="padding: 16px 18px; color: #059669; font-weight: 700; font-size: 14px;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td style="padding: 16px 18px; color: #334155; font-size: 14px; font-weight: 500;">{{ $product->stock }}</td>
                            <td style="padding: 16px 18px;">
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <a href="{{ route('products.edit', $product->id) }}" style="background: rgba(202, 138, 4, 0.12); color: #ca8a04; border: 1px solid rgba(202, 138, 4, 0.3); padding: 6px 14px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 600;">Edit</a>
                                    
                                    @if(strtolower(auth()->user()->role) === 'admin')
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.3); padding: 6px 14px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
                                        </form>
                                    @else
                                        <span style="color: #94a3b8; font-size: 12px; font-style: italic; background: #f8fafc; padding: 6px 10px; border-radius: 6px; border: 1px solid #e2e8f0;">Dibatasi</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #64748b; font-size: 14px;">Produk inventaris tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <style>
            nav svg { 
                width: 16px !important; 
                height: 16px !important; 
                max-width: 16px !important; 
                max-height: 16px !important; 
                display: inline-block !important; 
                vertical-align: middle; 
            }
            .pagination { display: flex; gap: 6px; justify-content: flex-end; align-items: center; margin-top: 30px; list-style: none; padding: 0; }
            .pagination li a, .pagination li span { padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; color: #334155; font-size: 13px; display: inline-block; background: #ffffff; }
            .pagination li.active span { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-color: #0f172a; font-weight: 600; }
            .pagination li.disabled span { color: #94a3b8; background-color: #f8fafc; }
        </style>

        <div style="margin-top: 30px;">
            {{ $products->links() }}
        </div>
    </div>
@endsection