@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header Katalog -->
        <div class="mb-8 flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Katalog Produk Eksklusif</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Pilih dan pesan koleksi mewah terbaik untuk Anda</p>
            </div>
            <div>
                <span style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                    ROLE: VIP CUSTOMER
                </span>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-8 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-3 items-center flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau SKU koleksi mewah..." 
                       style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 10px 16px; border-radius: 8px; font-size: 14px; flex: 1; min-width: 200px;">
                
                <select name="category_id" style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 10px 16px; border-radius: 8px; font-size: 14px;">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                    Filter Katalog
                </button>
            </div>
        </form>

        <!-- Product Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(310px, 1fr)); gap: 24px;">
            @forelse($products ?? [] as $product)
                <div style="background-color: #111827; border: 1px solid #1f2937; border-radius: 12px; padding: 24px; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s;" onmouseover="this.style.borderColor='#ca8a04'" onmouseout="this.style.borderColor='#1f2937'">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <span style="font-size: 12px; font-weight: 600; color: #fbbf24; background: rgba(245, 158, 11, 0.1); padding: 4px 10px; border-radius: 6px;">
                                SKU: {{ $product->sku ?? '-' }}
                            </span>
                            <span style="font-size: 12px; color: #94a3b8;">
                                Stok: <strong style="color: #f3f4f6;">{{ $product->stock ?? 0 }}</strong>
                            </span>
                        </div>

                        <h3 style="color: #ffffff; font-size: 18px; font-weight: 600; margin-bottom: 8px;">{{ $product->name }}</h3>
                        <p style="color: #94a3b8; font-size: 13px; margin-bottom: 16px;">
                            {{ $product->category->name ?? 'Kategori Mewah' }}
                        </p>
                    </div>

                    <div>
                        <div style="font-size: 20px; font-weight: 700; color: #fef08a; margin-bottom: 16px;">
                            Rp {{ number_format($product->selling_price ?? $product->price ?? 0, 0, ',', '.') }}
                        </div>

                        <!-- Tombol Aksi (Beli Sekarang & Keranjang) -->
                        <div style="display: flex; gap: 10px;">
                            <form action="{{ route('customer.buy', $product->id) }}" method="POST" style="flex: 1; margin: 0;" onsubmit="return confirm('Lakukan pembelian instan untuk {{ $product->name }}?');">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px; border-radius: 8px; border: none; cursor: pointer; text-align: center; font-size: 13px;">
                                    ⚡ Beli Sekarang
                                </button>
                            </form>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); font-weight: 600; padding: 10px 14px; border-radius: 8px; cursor: pointer; font-size: 13px;" title="Tambah ke Keranjang">
                                    🛒
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #94a3b8; font-style: italic;">
                    Belum ada produk eksklusif tersedia dalam katalog saat ini.
                </div>
            @endforelse
        </div>

        <!-- Pagination Links (Slide 18 UTS Requirement) -->
        <div style="margin-top: 40px; color: #fef08a;">
            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection