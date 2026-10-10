@extends('layouts.app')

@section('content')
    <div style="max-width: 450px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <h2 style="color: #0f172a; margin-bottom: 20px; text-align: center;">Daftar Akun Baru</h2>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #334155; font-size: 14px; font-weight: 600; margin-bottom: 5px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #334155; font-size: 14px; font-weight: 600; margin-bottom: 5px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #334155; font-size: 14px; font-weight: 600; margin-bottom: 5px;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 14px; font-weight: 600; margin-bottom: 5px;">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 16px; border: none; border-radius: 8px; cursor: pointer;">Daftar</button>
        </form>

        <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #64748b;">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: #2563eb; text-decoration: none; font-weight: 600;">Login di sini</a>
        </p>
    </div>
@endsection