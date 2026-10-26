@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Informasi Profil Customer -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1px solid rgba(254, 240, 138, 0.3); border-radius: 16px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.3);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <span style="background: rgba(202, 138, 4, 0.2); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.4); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        ⭐ PROFIL AKUN VIP
                    </span>
                    <h2 style="color: #fef08a; font-size: 26px; font-weight: 700; margin: 12px 0 5px 0;">{{ auth()->user()->name }}</h2>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">Email: {{ auth()->user()->email }}</p>
                </div>
                <div>
                    <a href="{{ route('products.index') }}" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px; display: inline-block;">
                        🛍️ Belanja Koleksi Baru
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Riwayat Transaksi / Pesanan -->
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            <div class="mb-6">
                <h3 style="color: #fef08a; font-size: 20px; font-weight: 700;">Riwayat Pesanan & Transaksi Saya</h3>
                <p style="color: #94a3b8; font-size: 13px; margin-top: 4px;">Daftar seluruh pembelian barang mewah yang telah Anda lakukan</p>
            </div>

            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">NO. INVOICE</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TANGGAL</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">PRODUK & KUANTITAS</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TOTAL HARGA</th>
                            <th style="padding: 14px 16px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales ?? [] as $sale)
                            <tr style="border-bottom: 1px solid #1f2937;">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #fef08a;">
                                    {{ $sale->sale_number }}
                                </td>
                                <td style="padding: 16px; font-size: 13px; color: #94a3b8;">
                                    {{ $sale->created_at->format('d M Y, H:i') }}
                                </td>
                                <td style="padding: 16px; font-size: 14px; color: #ffffff;">
                                    @foreach($sale->items as $item)
                                        <div style="margin-bottom: 4px;">
                                            <strong>{{ $item->product->name ?? 'Produk' }}</strong> 
                                            <span style="color: #94a3b8; font-size: 12px;">({{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }})</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #fef08a;">
                                    Rp {{ number_format($sale->total, 0, ',', '.') }}
                                </td>
                                <td style="padding: 16px; text-align: center;">
                                    <span style="background: rgba(34, 197, 94, 0.2); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.4); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Belum ada riwayat transaksi atau pembelian yang tercatat.
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