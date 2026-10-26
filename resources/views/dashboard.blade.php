@extends('layouts.app')

@section('content')
    <div style="display: flex; flex-direction: column; gap: 25px;">
        
        <!-- Banner Sambutan Eksklusif -->
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 45px 40px; border-radius: 16px; border: 1px solid rgba(202, 138, 4, 0.3); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;">
            <div style="position: relative; z-index: 2;">
                <span style="background: rgba(202, 138, 4, 0.2); color: #fef08a; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; border: 1px solid rgba(254, 240, 138, 0.4);">
                    ✨ MEMBER VIP LUXURY STORE
                </span>
                <h2 style="color: #ffffff; font-size: 30px; font-weight: 700; margin: 15px 0 10px 0;">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>
                <p style="color: #94a3b8; font-size: 15px; margin: 0 0 25px 0; max-width: 600px; line-height: 1.6;">
                    Nikmati akses eksklusif ke koleksi jam tangan, perhiasan, dan parfum pilihan terbaik kelas dunia. Belanja aman, mudah, dan elegan.
                </p>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('products.index') }}" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(202, 138, 4, 0.3);">
                        🛍️ Jelajahi Katalog Produk
                    </a>
                    <a href="{{ route('cart.index') }}" style="background: rgba(255, 255, 255, 0.1); color: #ffffff; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; border: 1px solid rgba(255, 255, 255, 0.2);">
                        🛒 Lihat Keranjang Belanja
                    </a>
                </div>
            </div>
        </div>

        <!-- Grid Menu Pintasan / Fitur Cepat -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            
            <!-- Kartu 1 -->
            <div style="background: #ffffff; padding: 30px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div style="font-size: 28px; margin-bottom: 12px;">💎</div>
                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Koleksi Mewah</h3>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0; line-height: 1.5;">Temukan berbagai barang bermerek dengan kualitas premium dan garansi keaslian.</p>
                <a href="{{ route('products.index') }}" style="color: #ca8a04; font-weight: 600; font-size: 13px; text-decoration: none;">Buka Katalog &rarr;</a>
            </div>

            <!-- Kartu 2 -->
            <div style="background: #ffffff; padding: 30px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div style="font-size: 28px; margin-bottom: 12px;">🛍️</div>
                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Keranjang Saya</h3>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0; line-height: 1.5;">Cek barang yang sudah Anda pilih dan lanjutkan proses *checkout* pesanan.</p>
                <a href="{{ route('cart.index') }}" style="color: #ca8a04; font-weight: 600; font-size: 13px; text-decoration: none;">Lihat Keranjang &rarr;</a>
            </div>

            <!-- Kartu 3 -->
            <div style="background: #ffffff; padding: 30px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div style="font-size: 28px; margin-bottom: 12px;">🛡️</div>
                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Layanan Pelanggan</h3>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0; line-height: 1.5;">Butuh bantuan khusus seputar pengiriman atau produk? Tim kami siap melayani.</p>
                <span style="color: #94a3b8; font-weight: 500; font-size: 13px;">Hubungi VIP Support</span>
            </div>

        </div>

    </div>
@endsection