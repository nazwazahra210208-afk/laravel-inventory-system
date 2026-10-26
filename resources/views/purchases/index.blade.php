@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6 flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Daftar Transaksi Pembelian (Stock-In)</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Riwayat pengadaan stok barang dari supplier resmi</p>
            </div>
            <div>
                <a href="{{ route('purchases.create') }}" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 13px; display: inline-block;">
                    + Tambah Pembelian Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">NO. PO</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">SUPPLIER</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">PETUGAS</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TOTAL BIAYA</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24;">TANGGAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchases ?? [] as $purchase)
                            <tr style="border-bottom: 1px solid #1f2937;">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #fef08a;">{{ $purchase->purchase_number }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #ffffff;">{{ $purchase->supplier->name ?? '-' }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #94a3b8;">{{ $purchase->user->name ?? '-' }}</td>
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                                <td style="padding: 16px; font-size: 13px; color: #94a3b8;">{{ $purchase->purchased_at ? \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y, H:i') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Belum ada transaksi pembelian stok tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div style="margin-top: 30px; color: #fef08a;">
                {{ $purchases->links() }}
            </div>
        </div>

    </div>
</div>
@endsection