@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Daftar Produk Inventaris</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Kelola data produk lengkap dengan filter, pencarian, dan sorting</p>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="mb-6 flex flex-wrap gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-3 items-center flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." 
                           style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 10px 16px; border-radius: 8px; font-size: 14px; flex: 1; min-width: 200px;">
                    
                    <select name="category_id" style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                        <option value="">Semua Kategori</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    </select>
                </div>

                <div>
                    <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;">
                        Terapkan
                    </button>
                </div>
            </form>

            <div class="mb-4 flex justify-end">
                <span style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                    ROLE: {{ strtoupper(auth()->user()->role ?? 'ADMIN') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">SKU</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">NAMA PRODUK & SUPPLIER</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">HARGA</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">STOK</th>
                            @if(auth()->user()->role === 'admin')
                                <th style="padding: 14px 16px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products ?? [] as $product)
                            <tr style="border-bottom: 1px solid #1f2937; transition: background 0.2s;" onmouseover="this.style.backgroundColor='rgba(245, 158, 11, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">
                                    {{ $product->sku ?? $product->code ?? '-' }}
                                </td>
                                <td style="padding: 16px; font-size: 14px;">
                                    <div style="font-weight: 600; color: #ffffff;">{{ $product->name }}</div>
                                    <div style="font-size: 12px; color: #94a3b8; margin-top: 2px;">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }} • 
                                        <span style="font-style: italic;">
                                            {{ $product->supplier->name ?? 'Tanpa supplier' }}
                                        </span>
                                    </div>
                                </td>
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #fef08a;">
                                    Rp {{ number_format($product->price ?? $product->harga ?? $product->selling_price ?? 0, 0, ',', '.') }}
                                </td>
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">
                                    {{ $product->stock ?? $product->stok ?? 0 }}
                                </td>
                                @if(auth()->user()->role === 'admin')
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            <a href="{{ route('products.edit', $product->id) }}" style="background: rgba(202, 138, 4, 0.2); color: #fef08a; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; border: 1px solid rgba(254, 240, 138, 0.3);">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid rgba(239, 68, 68, 0.3); cursor: pointer;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Belum ada data produk tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection