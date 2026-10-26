@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Kelola Master Kategori</h2>
                    <p class="text-sm mt-1" style="color: #94a3b8 !important;">Tambah dan pantau kategori produk inventaris</p>
                </div>
                <div>
                    <span style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        ROLE: {{ strtoupper(auth()->user()->role ?? 'ADMIN') }}
                    </span>
                </div>
            </div>

            {{-- HANYA ADMIN YANG BISA MENAMBAH KATEGORI --}}
            @if(auth()->user()->role === 'admin')
                <form action="{{ route('categories.store') }}" method="POST" class="mb-8 flex gap-4 items-center">
                    @csrf
                    <input type="text" name="name" placeholder="Masukkan nama kategori baru..." required
                           style="background-color: #030712 !important; border-color: #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px; flex: 1;">
                    
                    <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; white-space: nowrap;">
                        Tambah Kategori
                    </button>
                </form>
            @endif

            @if(session('success'))
                <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">NAMA KATEGORI</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">JUMLAH PRODUK</th>
                            @if(auth()->user()->role === 'admin')
                                <th style="padding: 14px 16px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories ?? [] as $category)
                            <tr style="border-bottom: 1px solid #1f2937; transition: background 0.2s;" onmouseover="this.style.backgroundColor='rgba(245, 158, 11, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">{{ $category->name }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #94a3b8;">
                                    {{ $category->products_count ?? $category->products->count() ?? 0 }} produk
                                </td>
                                @if(auth()->user()->role === 'admin')
                                    <td style="padding: 16px; text-align: center;">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid rgba(239, 68, 68, 0.3); cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 3 : 2 }}" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Belum ada data kategori tersedia.
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