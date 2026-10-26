@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6 flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Daftar Transaksi Inventaris</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Kelola dan pantau riwayat barang masuk, barang keluar, serta pembelian customer</p>
            </div>
            <div>
                <a href="{{ route('transactions.create') }}" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px; display: inline-block;">
                    + Tambah Transaksi Manual
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            
            <!-- Tabel 1: Penjualan VIP Customer (Sales) -->
            <div class="mb-8">
                <h3 style="color: #fef08a; font-size: 18px; font-weight: 600; margin-bottom: 14px;">🛒 Riwayat Penjualan ke Customer VIP</h3>
                <div class="overflow-x-auto">
                    <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                        <thead>
                            <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">INVOICE</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TANGGAL</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">CUSTOMER</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">PRODUK & QTY</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TOTAL HARGA</th>
                                <th style="padding: 12px 14px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salesAsTransactions ?? [] as $sale)
                                <tr style="border-bottom: 1px solid #1f2937;">
                                    <td style="padding: 14px; font-size: 13px; font-weight: 600; color: #fef08a;">{{ $sale->sale_number }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #94a3b8;">{{ $sale->created_at->format('d M Y, H:i') }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #ffffff;">{{ $sale->user->name ?? 'Customer VIP' }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #f3f4f6;">
                                        @foreach($sale->items as $item)
                                            <div>{{ $item->product->name ?? '-' }} ({{ $item->quantity }} unit)</div>
                                        @endforeach
                                    </td>
                                    <td style="padding: 14px; font-size: 13px; font-weight: 600; color: #fef08a;">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td style="padding: 14px; text-align: center;">
                                        <span style="background: rgba(34, 197, 94, 0.2); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.4); padding: 2px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;">Selesai</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 20px; text-align: center; color: #94a3b8; font-style: italic; font-size: 13px;">Belum ada transaksi penjualan customer.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel 2: Transaksi Manual Inventaris (In/Out) -->
            <div>
                <h3 style="color: #fef08a; font-size: 18px; font-weight: 600; margin-bottom: 14px;">📦 Catatan Barang Masuk / Keluar Manual</h3>
                <div class="overflow-x-auto">
                    <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                        <thead>
                            <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">ID</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TANGGAL</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">PRODUK</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TIPE</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">JUMLAH</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TOTAL HARGA</th>
                                <th style="padding: 12px 14px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">PETUGAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions ?? [] as $trx)
                                <tr style="border-bottom: 1px solid #1f2937;">
                                    <td style="padding: 14px; font-size: 13px; font-weight: 600; color: #fef08a;">#{{ $trx->id }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #94a3b8;">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #ffffff;">{{ $trx->product->name ?? '-' }}</td>
                                    <td style="padding: 14px; font-size: 12px;">
                                        <span style="background: {{ $trx->type == 'in' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(239, 68, 68, 0.2)' }}; color: {{ $trx->type == 'in' ? '#86efac' : '#fca5a5' }}; padding: 2px 8px; border-radius: 4px; font-weight: 600;">
                                            {{ strtoupper($trx->type) }}
                                        </span>
                                    </td>
                                    <td style="padding: 14px; font-size: 13px; color: #f3f4f6;">{{ $trx->quantity }} unit</td>
                                    <td style="padding: 14px; font-size: 13px; font-weight: 600; color: #fef08a;">Rp {{ number_format($trx->total_harga ?? 0, 0, ',', '.') }}</td>
                                    <td style="padding: 14px; font-size: 13px; color: #94a3b8;">{{ $trx->user->name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 20px; text-align: center; color: #94a3b8; font-style: italic; font-size: 13px;">Belum ada catatan transaksi manual.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection