@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; margin: 0 0 6px 0; font-size: 24px; font-weight: 700;">Keranjang Belanja</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Kelola produk pilihan Anda sebelum melakukan proses pemesanan</p>

        @if(session('success'))
            <div style="background: #f0fdf4; border-left: 4px solid #22c55e; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px;">
                {{ session('error') }}
            </div>
        @endif

        @php $total = 0; @endphp
        @if(session('cart') && count(session('cart')) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">SKU</th>
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Nama Produk</th>
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Harga</th>
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Jumlah</th>
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Subtotal</th>
                            <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $details)
                            @php 
                                $subtotal = $details['price'] * $details['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 16px 18px; color: #64748b; font-size: 14px;">{{ $details['sku'] }}</td>
                                <td style="padding: 16px 18px; font-weight: 600; color: #0f172a; font-size: 14px;">{{ $details['name'] }}</td>
                                <td style="padding: 16px 18px; color: #059669; font-weight: 700; font-size: 14px;">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td style="padding: 16px 18px; color: #334155; font-size: 14px;">{{ $details['quantity'] }}</td>
                                <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; font-size: 14px;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td style="padding: 16px 18px;">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.3); padding: 6px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 20px 25px; border-radius: 12px; border: 1px solid #e2e8f0; flex-wrap: wrap; gap: 15px;">
                <h3 style="margin: 0; font-size: 18px; color: #0f172a;">Total Pembayaran: <span style="color: #059669;">Rp {{ number_format($total, 0, ',', '.') }}</span></h3>
                <form action="{{ route('cart.checkout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 14px; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);">
                        🛍️ Proses Checkout Sekarang
                    </button>
                </form>
            </div>
        @else
            <div style="text-align: center; padding: 50px 20px; color: #64748b;">
                <p style="font-size: 16px; margin-bottom: 15px;">Keranjang belanja Anda masih kosong.</p>
                <a href="{{ route('products.index') }}" style="background: #0f172a; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">Lihat Katalog Produk</a>
            </div>
        @endif
    </div>
@endsection