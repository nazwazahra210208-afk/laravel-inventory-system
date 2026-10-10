@extends('layouts.app')

@section('content')
    <div style="max-width: 480px; margin: 50px auto; background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
        
        <!-- Header Judul Form dengan Sentuhan Mewah -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="display: inline-block; width: 50px; height: 50px; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); border-radius: 12px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(202, 138, 4, 0.3);">
                <span style="font-size: 22px; font-weight: bold; color: #1e293b;">⚡</span>
            </div>
            <h2 style="color: #0f172a; font-size: 26px; font-weight: 700; margin: 0 0 8px 0; letter-spacing: -0.5px;">Selamat Datang Kembali</h2>
            <p style="color: #64748b; font-size: 14px; margin: 0; line-height: 1.5;">Autentikasi keamanan tingkat lanjut untuk akses panel inventaris</p>
        </div>

        <!-- Pesan Error Validasi -->
        @if ($errors->any())
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; padding: 14px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com" style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none; transition: border-color 0.2s, box-shadow 0.2s;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #334155; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.8px;">Kata Sandi</label>
                <input type="password" name="password" required placeholder="••••••••••••" style="width: 100%; padding: 13px 16px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; background-color: #f8fafc; color: #0f172a; outline: none; transition: border-color 0.2s, box-shadow 0.2s;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; font-size: 13px;">
                <label style="color: #64748b; display: flex; align-items: center; gap: 8px; cursor: pointer; user-select: none;">
                    <input type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: #ca8a04; border-radius: 4px;"> Ingat sesi saya
                </label>
            </div>

            <!-- Tombol Masuk Eksklusif -->
            <button type="submit" style="width: 100%; padding: 14px; font-size: 15px; font-weight: 600; color: #1a1a1a; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3); transition: transform 0.1s, opacity 0.2s;">Akses Sistem Sekarang</button>
        </form>

        <div style="border-top: 1px solid #f1f5f9; margin-top: 30px; padding-top: 20px; text-align: center;">
            <p style="font-size: 13px; color: #64748b; margin: 0;">
                Belum memiliki akses terdaftar? <a href="{{ route('register') }}" style="color: #ca8a04; text-decoration: none; font-weight: 600;">Daftar Akun Baru</a>
            </p>
        </div>
    </div>
@endsection