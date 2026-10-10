@extends('layouts.app')

@section('content')
    <div style="background: #ffffff; padding: 35px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; margin-bottom: 6px; font-weight: 700; font-size: 24px;">Kelola Master Kategori</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px;">Tambah dan pantau kategori produk inventaris</p>

        @if(session('success'))
            <div style="background: #f0fdf4; border-left: 4px solid #22c55e; color: #166534; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px; font-size: 14px; font-weight: 500;">{{ session('error') }}</div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" style="display: flex; gap: 12px; margin-bottom: 30px;">
            @csrf
            <input type="text" name="name" placeholder="Masukkan nama kategori baru..." required style="flex: 1; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #f8fafc; color: #0f172a; outline: none;">
            <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; padding: 0 24px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 14px; box-shadow: 0 4px 12px rgba(202, 138, 4, 0.25);">Tambah Kategori</button>
        </form>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Nama Kategori</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Jumlah Produk</th>
                        <th style="padding: 14px 18px; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 18px; font-weight: 600; color: #0f172a; font-size: 14px;">{{ $category->name }}</td>
                            <td style="padding: 16px 18px; color: #64748b; font-size: 14px;">{{ $category->products_count }} produk</td>
                            <td style="padding: 16px 18px;">
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.12); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.3); padding: 6px 14px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="padding: 30px; text-align: center; color: #64748b; font-size: 14px;">Belum ada data kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 25px;">{{ $categories->links() }}</div>
    </div>
@endsection