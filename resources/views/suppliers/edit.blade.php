@extends('layouts.app')

@section('content')
<div class="py-12" style="background-color: #0b0f19 !important;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: #111827 !important; border: 1px solid #1f2937 !important; padding: 30px;">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold" style="color: #fef08a !important;">Edit Supplier</h2>
                <p class="text-sm mt-1" style="color: #94a3b8 !important;">Perbarui informasi mitra supplier inventaris</p>
            </div>

            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Nama Supplier</label>
                    <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                </div>

                <div class="mb-5">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Kontak / Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                </div>

                <div class="mb-6">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Alamat</label>
                    <textarea name="address" rows="3" style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px;">{{ old('address', $supplier->address) }}</textarea>
                </div>

                <div style="display: flex; gap: 12px; align-items: center;">
                    <button type="submit" style="background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s;">
                        Perbarui Supplier
                    </button>
                    <a href="{{ route('suppliers.index') }}" style="background: rgba(30, 41, 59, 0.8); color: #94a3b8; font-weight: 600; padding: 12px 20px; border-radius: 8px; text-decoration: none; border: 1px solid #374151;">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection