# 💎 Luxury Inventory Management System (Laravel)

Sistem Manajemen Inventaris eksklusif dan profesional yang dibangun menggunakan **Laravel 13**, **PHP 8.5**, dan **MySQL**, dengan mengusung tema estetika **"Luxury Dark & Gold"**. Aplikasi ini dirancang untuk mengelola stok barang mewah secara akurat, aman, dan terstruktur.

---

## 🚀 Fitur Utama

1. **Dashboard & Laporan Real-Time**:
   - Ringkasan statistik total produk, kategori, dan supplier.
   - Perhitungan nilai total aset inventaris secara otomatis.
   - Peringatan dini untuk produk dengan stok kritis ($\le 5$).
   - Log aktivitas transaksi masuk dan keluar terbaru.

2. **Manajemen Produk & Relasi (*CRUD*)**:
   - Pencarian produk berdasarkan Nama atau SKU.
   - Filter produk berdasarkan Kategori.
   - Pengurutan data (*Sorting*) berdasarkan harga (termurah/termahal), nama (A-Z), dan stok tersedikit.
   - Relasi *Many-to-Many* antara Produk dan Supplier.
   - Pagination untuk efisiensi tampilan data.

3. **Manajemen Transaksi Stok**:
   - Pencatatan barang masuk (*Restock*) dan barang keluar (*Distribusi/Penjualan*).
   - Validasi stok otomatis untuk mencegah stok minus.
   - Proteksi *Database Transaction Locking* untuk menghindari inkonsistensi data saat akses serentak.

4. **Keamanan Tingkat Tinggi (*Security*)**:
   - **Prepared Statements**: Terlindung dari serangan *SQL Injection* menggunakan Eloquent ORM.
   - **Validasi Ketat**: Penyaringan input data berlapis pada setiap form controller.
   - **XSS Protection**: Otomatis *escaping* pada seluruh Blade template.

---

## 🛠️ Tech Stack

* **Framework**: Laravel 13.35
* **Bahasa Pemrograman**: PHP 8.5
* **Database**: MySQL (`store_db`)
* **Frontend UI**: Custom inline CSS (*Luxury Dark & Gold Theme*), Google Fonts (Poppins).

---

## ⚙️ Cara Menjalankan Proyek (Installation)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

1. **Clone Repository ini**:
   ```bash
   git clone [https://github.com/username/nama-repository.git](https://github.com/username/nama-repository.git)
   cd nama-repository

## 👥 Akun Demo (Demo Accounts)

Gunakan kredensial berikut untuk menguji hak akses aplikasi:
- **Admin / Owner:** `admin@gmail.com` / `password`
- **Staff Gudang:** `staff@gmail.com` / `password`
- **Customer VIP:** `customer@gmail.com` / `password`

---

## 📊 Database ERD & Relasi Model
- `users` 1 ── * `sales` / `purchases`
- `categories` 1 ── * `products`
- `suppliers` 1 ── * `purchases`
- `sales` 1 ── * `sale_items`
- `products` 1 ── * `sale_items` / `purchase_items`