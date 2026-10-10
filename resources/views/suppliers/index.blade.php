@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; margin-bottom: 6px; font-weight: 700; font-size: 24px;">Kelola Master Supplier</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Tambah dan pantau data mitra supplier produk</p>

        @if(session('success'))
            <div style="background: #f0fdf4; border-left: 4px solid #22c55e; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('suppliers.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 12px; margin-bottom: 30px;">
            @csrf
            <input type="text" name="name" placeholder="Nama Supplier..." required style="padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            <input type="text" name="phone" placeholder="No. Telepon..." required style="padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            <input type="text" name="address" placeholder="Alamat..." required style="padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; padding: 0 24px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 14px; box-shadow: 0 4px 12px rgba(202, 138, 4, 0.25);">Tambah</button>
        </form>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Nama Supplier</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Telepon</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Alamat</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 18px; font-weight: 600; color: #0f172a; font-size: 14px;">{{ $supplier->name }}</td>
                            <td style="padding: 16px 18px; color: #64748b; font-size: 14px;">{{ $supplier->phone }}</td>
                            <td style="padding: 16px 18px; color: #64748b; font-size: 14px;">{{ $supplier->address }}</td>
                            <td style="padding: 16px 18px;">
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.3); padding: 6px 14px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="padding: 30px; text-align: center; color: #64748b; font-size: 14px;">Belum ada data supplier.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 25px;">{{ $suppliers->links() }}</div>
    </div>
@endsection