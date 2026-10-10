@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        
        <!-- Header Dashboard -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h2 style="color: #0f172a; margin: 0 0 6px 0; font-size: 26px; font-weight: 700;">Dashboard & Laporan Inventaris</h2>
                <p style="color: #64748b; font-size: 14px; margin: 0;">Ringkasan statistik real-time sistem manajemen eksklusif</p>
            </div>
            <div style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); padding: 8px 16px; border-radius: 10px; font-size: 12px; color: #1a1a1a; font-weight: 700; box-shadow: 0 4px 12px rgba(202, 138, 4, 0.2);">
                ROLE: {{ strtoupper(auth()->user()->role ?? 'STAFF') }}
            </div>
        </div>

        <!-- Grid Kartu Statistik Utama -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 35px;">
            
            <!-- Total Produk -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 22px; border-radius: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Produk</div>
                <div style="color: #0f172a; font-size: 28px; font-weight: 700;">{{ $totalProducts }}</div>
            </div>

            <!-- Total Kategori -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 22px; border-radius: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Kategori</div>
                <div style="color: #0f172a; font-size: 28px; font-weight: 700;">{{ $totalCategories }}</div>
            </div>

            <!-- Total Supplier -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 22px; border-radius: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Supplier</div>
                <div style="color: #0f172a; font-size: 28px; font-weight: 700;">{{ $totalSuppliers }}</div>
            </div>

            <!-- Total Nilai Aset Inventaris -->
            <div style="background: rgba(202, 138, 4, 0.08); border: 1px solid rgba(202, 138, 4, 0.25); padding: 22px; border-radius: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <div style="color: #b45309; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Nilai Total Inventaris</div>
                <div style="color: #92400e; font-size: 20px; font-weight: 700;">Rp {{ number_format($totalInventoryValue, 0, ',', '.') }}</div>
            </div>

            <!-- Stok Menipis -->
            <div style="background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.25); padding: 22px; border-radius: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                <div style="color: #dc2626; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Peringatan Stok Kritis</div>
                <div style="color: #991b1b; font-size: 28px; font-weight: 700;">{{ $lowStockProducts }} <span style="font-size: 13px; font-weight: 500;">Produk</span></div>
            </div>

        </div>

        <!-- Bagian Laporan & Tabel Pendukung -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            
            <!-- Tabel Peringatan Stok Menipis -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 25px; border-radius: 14px;">
                <h3 style="color: #0f172a; font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">⚠️ Peringatan Stok Kritis (≤ 5)</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">Nama Produk</th>
                            <th style="padding: 10px; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockList as $item)
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px 10px; font-weight: 600; color: #0f172a; font-size: 13px;">{{ $item->name }}</td>
                                <td style="padding: 12px 10px; color: #dc2626; font-weight: 700; font-size: 13px;">{{ $item->stock }} pcs</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" style="padding: 20px; text-align: center; color: #64748b; font-size: 13px;">Aman! Tidak ada produk dengan stok kritis.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Aktivitas Transaksi Terbaru -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 25px; border-radius: 14px;">
                <h3 style="color: #0f172a; font-size: 16px; font-weight: 700; margin: 0 0 15px 0;">📋 Aktivitas Transaksi Terakhir</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #cbd5e1;">
                            <th style="padding: 10px; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">Produk</th>
                            <th style="padding: 10px; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">Tipe</th>
                            <th style="padding: 10px; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">Jml</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $trx)
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px 10px; font-weight: 600; color: #0f172a; font-size: 13px;">{{ $trx->product->name ?? 'Dihapus' }}</td>
                                <td style="padding: 12px 10px; font-size: 12px;">
                                    @if($trx->type === 'in')
                                        <span style="color: #059669; font-weight: 700;">MASUK</span>
                                    @else
                                        <span style="color: #dc2626; font-weight: 700;">KELUAR</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 10px; color: #334155; font-size: 13px; font-weight: 600;">{{ $trx->quantity }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" style="padding: 20px; text-align: center; color: #64748b; font-size: 13px;">Belum ada aktivitas transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection