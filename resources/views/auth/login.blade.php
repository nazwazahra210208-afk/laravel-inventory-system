<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div style="text-align: center; margin-bottom: 30px;">
        <div style="display: inline-flex; justify-content: center; align-items: center; width: 50px; height: 50px; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); border-radius: 12px; margin-bottom: 15px; box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3);">
            ⚡
        </div>
        <h2 style="color: #fef08a; font-size: 24px; font-weight: 700; margin-bottom: 5px;">Selamat Datang Kembali</h2>
        <p style="color: #94a3b8; font-size: 13px;">Autentikasi keamanan tingkat lanjut untuk akses panel inventaris</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 12px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            @error('email')
                <span style="color: #fca5a5; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 12px; font-weight: 600; color: #fbbf24; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   style="width: 100%; background-color: #030712 !important; border: 1px solid #374151 !important; color: #ffffff !important; padding: 12px 16px; border-radius: 8px; font-size: 14px; box-sizing: border-box;">
            @error('password')
                <span style="color: #fca5a5; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px;">
            <label style="display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 13px; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember" style="accent-color: #ca8a04; width: 16px; height: 16px;">
                Ingat sesi saya
            </label>
        </div>

        <div style="margin-bottom: 20px;">
            <button type="submit" style="width: 100%; background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%); color: #1a1a1a; font-weight: 600; padding: 12px; border-radius: 8px; border: none; cursor: pointer; font-size: 15px; box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3); transition: all 0.2s;">
                Akses Sistem Sekarang
            </button>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <span style="color: #94a3b8; font-size: 13px;">Belum memiliki akses terdaftar? </span>
            <a href="{{ route('register') }}" style="color: #fef08a; font-size: 13px; font-weight: 600; text-decoration: none;">Daftar Akun Baru</a>
        </div>
    </form>
</x-guest-layout>