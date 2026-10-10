<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System - Luxury Edition</title>
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Standarisasi ukuran dan bentuk tombol */
        .nav-btn {
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
            letter-spacing: 0.3px;
        }

        /* 1. Tombol Gold Outline (Menu Navigasi) */
        .nav-btn-gold-outline {
            background: rgba(202, 138, 4, 0.15);
            color: #fef08a;
            border: 1px solid rgba(254, 240, 138, 0.3);
        }
        .nav-btn-gold-outline:hover {
            background: rgba(202, 138, 4, 0.25);
            border-color: rgba(254, 240, 138, 0.5);
            transform: translateY(-1px);
        }

        /* 2. Tombol Gold Solid (Entri Utama) */
        .nav-btn-gold-solid {
            background: linear-gradient(135deg, #fef08a 0%, #ca8a04 100%);
            color: #1a1a1a;
            border: 1px solid transparent;
            box-shadow: 0 4px 15px rgba(202, 138, 4, 0.3);
        }
        .nav-btn-gold-solid:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(202, 138, 4, 0.4);
        }

        /* 3. Tombol Keluar */
        .nav-btn-gold-subtle {
            background: rgba(217, 119, 6, 0.12);
            color: #fde047;
            border: 1px solid rgba(217, 119, 6, 0.25);
        }
        .nav-btn-gold-subtle:hover {
            background: rgba(217, 119, 6, 0.22);
            color: #ffffff;
            border-color: rgba(217, 119, 6, 0.4);
            transform: translateY(-1px);
        }

        /* 4. Tombol Kembali ke Dashboard (Tema Selaras) */
        .btn-back-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }
        .btn-back-dashboard:hover {
            background: #e2e8f0;
            color: #0f172a;
            border-color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 1150px; margin: 30px auto; padding: 0 20px;">
        <!-- Header Mewah Berwarna Gelap & Emas -->
        <header class="branded-header" style="display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 30px 40px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15); margin-bottom: 25px; border: 1px solid rgba(202, 138, 4, 0.3);">
            <div class="header-text">
                <h1 style="color: #fef08a; font-size: 28px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 0.5px;">Inventory App</h1>
                <p style="color: #94a3b8; font-size: 14px; margin: 0; font-weight: 400;">Sistem Manajemen Inventaris Eksklusif & Profesional</p>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-btn nav-btn-gold-outline">Dashboard</a>
                    <a href="{{ route('products.index') }}" class="nav-btn nav-btn-gold-outline">Produk</a>
                    <a href="{{ route('categories.index') }}" class="nav-btn nav-btn-gold-outline">Kategori</a>
                    <a href="{{ route('suppliers.index') }}" class="nav-btn nav-btn-gold-outline">Supplier</a>
                    <a href="{{ route('transactions.index') }}" class="nav-btn nav-btn-gold-outline">Transaksi</a>
                    <a href="{{ route('products.create') }}" class="nav-btn nav-btn-gold-solid">+ Entri</a>

                    <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                        @csrf
                        <button type="submit" class="nav-btn nav-btn-gold-subtle">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-gold-solid">Masuk Sistem</a>
                @endauth
            </div>
        </header>

        <!-- Tombol Kembali Otomatis (Muncul di semua halaman kecuali Dashboard) -->
        @if (!request()->routeIs('dashboard'))
            <div>
                <a href="{{ route('dashboard') }}" class="btn-back-dashboard">
                    ← Kembali ke Dashboard
                </a>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>