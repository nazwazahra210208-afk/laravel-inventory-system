@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome Banner VIP Store -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1px solid rgba(254, 240, 138, 0.3); border-radius: 16px; padding: 40px; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.3);">
            <span style="background: rgba(202, 138, 4, 0.2); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.4); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                ⭐ VIP CUSTOMER PORTAL
            </span>
            <h2 style="color: #fef08a; font-size: 32px; font-weight: 700; margin: 15px 0 10px 0;">Selamat Datang, {{ auth()->user()->name }}</h2>
            <p style="color: #94a3b8; font-size: 15px; margin: 0; line-height: 1.6;">
                Jelajahi koleksi barang mewah eksklusif kelas dunia. Nikmati kemudahan berbelanja langsung dari katalog inventaris resmi kami dengan jaminan keaslian 100%.
            </p>
        </div>

        <!-- Quick Actions Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            
            <div style="background-color: #111827 !important; border: 1px solid #1f2937 !important; border-radius: 12px; padding: 25px;">
                <div style="font-size: 28px; margin-bottom: 12px;">🛍️</div>
                <h3 style="color: #fef08a; font-size: 18px; font-weight: 600; margin-bottom: 8px;">Katalog Produk Eksklusif</h3>
                <p style="color: #94a3b8; font-size: 13px; margin-bottom: 20px;">Temukan berbagai koleksi jam tangan, perhiasan, dan barang mewah pilihan.</p>
                <a href="{{ route('products.index') }}" style="display: inline-block; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px;">
                    Buka Katalog →
                </a>
            </div>

            <div style="background-color: #111827 !important; border: 1px solid #1f2937 !important; border-radius: 12px; padding: 25px;">
                <div style="font-size: 28px; margin-bottom: 12px;">🛒</div>
                <h3 style="color: #fef08a; font-size: 18px; font-weight: 600; margin-bottom: 8px;">Keranjang Belanja</h3>
                <p style="color: #94a3b8; font-size: 13px; margin-bottom: 20px;">Kelola barang pilihan Anda sebelum melakukan proses *checkout* pesanan.</p>
                <a href="{{ route('cart.index') }}" style="display: inline-block; background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px;">
                    Lihat Keranjang
                </a>
            </div>

            <div style="background-color: #111827 !important; border: 1px solid #1f2937 !important; border-radius: 12px; padding: 25px;">
                <div style="font-size: 28px; margin-bottom: 12px;">📜</div>
                <h3 style="color: #fef08a; font-size: 18px; font-weight: 600; margin-bottom: 8px;">Riwayat Transaksi</h3>
                <p style="color: #94a3b8; font-size: 13px; margin-bottom: 20px;">Pantau status pesanan dan riwayat pembelian barang mewah Anda secara *real-time*.</p>
                <a href="{{ route('customer.profile') }}" style="display: inline-block; background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px;">
                    Cek Riwayat
                </a>
            </div>

        </div>

    </div>
</div>
@endsection