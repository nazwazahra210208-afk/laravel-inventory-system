@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="color: #0f172a; margin: 0 0 6px 0; font-size: 24px; font-weight: 700;">Riwayat Transaksi Stok</h2>
                <p style="color: #64748b; font-size: 14px; margin: 0;">Log aktivitas barang masuk dan keluar gudang</p>
            </div>
            
            <!-- Tombol Aksi dengan Tema Luxury Gold & Dark yang Serasi -->
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('transactions.in') }}" style="background: rgba(202, 138, 4, 0.12); color: #ca8a04; border: 1px solid rgba(202, 138, 4, 0.3); padding: 10px 18px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.2s;">+ Barang Masuk</a>
                <a href="{{ route('transactions.out') }}" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border: 1px solid rgba(15, 23, 42, 0.3); padding: 10px 18px; border-radius: 10px; text-decoration: none; font-size: 13px; font-weight: 600; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);">- Barang Keluar</a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #f0fdf4; border-left: 4px solid #22c55e; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">{{ session('success') }}</div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Waktu</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Produk</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Tipe</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Jumlah</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Catatan</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">Operator</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 18px; color: #64748b; font-size: 13px;">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 16px 18px; font-weight: 600; color: #0f172a; font-size: 14px;">{{ $trx->product->name ?? 'Produk Dihapus' }}</td>
                            <td style="padding: 16px 18px;">
                                @if($trx->type === 'in')
                                    <span style="background: rgba(202, 138, 4, 0.12); color: #ca8a04; border: 1px solid rgba(202, 138, 4, 0.3); padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">MASUK</span>
                                @else
                                    <span style="background: rgba(15, 23, 42, 0.08); color: #0f172a; border: 1px solid rgba(15, 23, 42, 0.2); padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700;">KELUAR</span>
                                @endif
                            </td>
                            <td style="padding: 16px 18px; font-weight: 700; color: #0f172a; font-size: 14px;">{{ $trx->quantity }}</td>
                            <td style="padding: 16px 18px; color: #64748b; font-size: 13px;">{{ $trx->notes }}</td>
                            <td style="padding: 16px 18px; color: #334155; font-size: 13px; font-weight: 500;">{{ $trx->user->name ?? 'System' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding: 40px; text-align: center; color: #64748b; font-size: 14px;">Belum ada riwayat transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <style>
            nav svg { width: 16px !important; height: 16px !important; display: inline-block !important; vertical-align: middle; }
            .pagination { display: flex; gap: 6px; justify-content: flex-end; align-items: center; margin-top: 30px; list-style: none; padding: 0; }
            .pagination li a, .pagination li span { padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; color: #334155; font-size: 13px; display: inline-block; background: #ffffff; }
            .pagination li.active span { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-color: #0f172a; font-weight: 600; }
            .pagination li.disabled span { color: #94a3b8; background-color: #f8fafc; }
        </style>

        <div style="margin-top: 25px;">{{ $transactions->links() }}</div>
    </div>
@endsection