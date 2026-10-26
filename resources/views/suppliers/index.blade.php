@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 24px;">
            
            <div class="mb-6 flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Daftar Supplier Mitra</h2>
                    <p class="text-sm mt-1" style="color: #94a3b8 !important;">Kelola mitra supplier resmi untuk inventaris</p>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="background: rgba(202, 138, 4, 0.15); color: #fef08a; border: 1px solid rgba(254, 240, 138, 0.3); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        ROLE: {{ strtoupper(auth()->user()->role ?? 'ADMIN') }}
                    </span>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('suppliers.create') }}" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">
                            + Tambah Supplier
                        </a>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.4); color: #86efac; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table style="width: 100%; border-collapse: collapse; background-color: #111827; color: #f3f4f6;">
                    <thead>
                        <tr style="background-color: #1f2937; border-bottom: 1px solid #374151;">
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">NAMA SUPPLIER</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">KONTAK / TELEPON</th>
                            <th style="padding: 14px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">ALAMAT</th>
                            @if(auth()->user()->role === 'admin')
                                <th style="padding: 14px 16px; text-align: center; font-size: 12px; font-weight: 600; color: #fbbf24; letter-spacing: 0.5px;">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers ?? [] as $supplier)
                            <tr style="border-bottom: 1px solid #1f2937; transition: background 0.2s;" onmouseover="this.style.backgroundColor='rgba(245, 158, 11, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 16px; font-size: 14px; font-weight: 600; color: #f3f4f6;">{{ $supplier->name }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #94a3b8;">{{ $supplier->phone ?? '-' }}</td>
                                <td style="padding: 16px; font-size: 14px; color: #94a3b8;">{{ $supplier->address ?? '-' }}</td>
                                @if(auth()->user()->role === 'admin')
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}" style="background: rgba(202, 138, 4, 0.2); color: #fef08a; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; border: 1px solid rgba(254, 240, 138, 0.3);">
                                                Edit
                                            </a>
                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline; margin: 0;" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 6px 14px; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid rgba(239, 68, 68, 0.3); cursor: pointer;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 4 : 3 }}" style="padding: 30px; text-align: center; color: #94a3b8; font-style: italic;">
                                    Belum ada data supplier tersedia.
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