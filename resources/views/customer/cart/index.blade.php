@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Keranjang Belanja VIP</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Kelola pesanan eksklusif Anda sebelum melakukan checkout</p>
            </div>
            <div>
                <a href="{{ route('products.index') }}" style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none;">
                    ← Lanjut Belanja
                </a>
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

        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">SKU</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">NAMA PRODUK</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">HARGA SATUAN</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">JUMLAH</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">SUBTOTAL</th>
                            <th style="padding: 14px 16px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $total = 0; 
                            $cartItems = session('cart', []);
                        @endphp
                        
                        @forelse($cartItems as $id => $details)
                            @php 
                                $subtotal = $details['price'] * $details['quantity']; 
                                $total += $subtotal; 
                            @endphp
                            <tr style="border-bottom: 1px solid #1f2937;">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">{{ $details['sku'] }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #ffffff;">{{ $details['name'] }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #fef08a;">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #f3f4f6;">{{ $details['quantity'] }}</td>
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #fef08a;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td style="padding: 16px; text-align: center;">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4); padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Keranjang belanja Anda masih kosong.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(count(session('cart', [])) > 0)
                <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #1f2937; padding-top: 20px; flex-wrap: wrap; gap: 15px;">
                    <div style="font-size: 18px; font-weight: 700; color: #fef08a;">
                        Total Pembayaran: Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3);">
                            🛍️ Checkout Pesanan Sekarang
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection