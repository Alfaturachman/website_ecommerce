# 03. Software Requirement Specification (SRS) - Nomadenstuff E-Commerce

## 1. Pendahuluan & Lingkup Spesifikasi
Dokumen Software Requirement Specification (SRS) ini memuat spesifikasi teknis terperinci mengenai kebutuhan fungsi fitur, antarmuka eksternal, batasan sistem (*system constraints*), serta atribut kualitas perangkat lunak untuk aplikasi Nomadenstuff E-Commerce.

---

## 2. Batasan Sistem & Persyaratan Lingkungan (System Constraints)

### A. Persyaratan Perangkat Lunak Server (Server-Side Specifications)
- **Bahasa Pemrograman**: PHP Version 7.4 s.d. PHP 8.2+.
- **Framework Web**: CodeIgniter 3.1.x (Arsitektur MVC).
- **Web Server**: Apache HTTP Server 2.4+ dengan modul `mod_rewrite` aktif.
- **Database Management System**: MySQL 8.0 / MariaDB 10.4+.
- **Dependency Manager**: Composer v2.0+ (pustaka `dompdf/dompdf`).

### B. Batasan Eksekusi & Memori (Execution Limits)
- `memory_limit`: Minimal 128MB (Rekomendasi 256MB untuk pemrosesan Dompdf).
- `upload_max_filesize`: Minimal 5MB (Upload gambar produk & bukti bayar).
- `post_max_size`: Minimal 8MB.
- `max_execution_time`: Minimal 60 detik.

### C. Persyaratan Client / Web Browser
- Browser modern yang mendukung HTML5, CSS3, JavaScript ES6+, & AJAX (`fetch` / jQuery AJAX).
- Dukungan Cookie & Local Session aktif untuk manajemen autentikasi & CSRF.

---

## 3. Spesifikasi Antarmuka Eksternal (External Interfaces)

### A. API Pengiriman RajaOngkir (Logistics API)
- **Provider**: RajaOngkir Starter API (`api.rajaongkir.com/starter/`).
- **Protokol**: HTTP GET / POST via PHP cURL Extension.
- **Header Autentikasi**: `key: {RAJAONGKIR_API_KEY}`.
- **Endpoints Dikonsumsi**:
  1. `/province` - Mengambil daftar provinsi di Indonesia.
  2. `/city?province={id_provinsi}` - Mengambil daftar kota/kabupaten.
  3. `/cost` - Menghitung tarif pengiriman berdasarkan kota asal (ID: 152), kota tujuan, berat total (gram), dan kode kurir (`jne`, `pos`, `tiki`).

### B. Library Cetak PDF Dompdf
- **Library**: `dompdf/dompdf`.
- **Fungsi**: Memproses template HTML/CSS view menjadi dokumen PDF fisik lanskap/potret untuk laporan transaksi admin.

---

## 4. Spesifikasi Detail Fungsional Fitur

### A. Otentikasi & Otorisasi Pengguna
1. **Registrasi Akun (`Register.php`)**:
   - Menerima nama, email, password, phone, address.
   - Validasi email unik (`is_unique[user.email]`).
   - Hash password menggunakan `PASSWORD_DEFAULT` (Bcrypt).
   - Mengatur `is_active = 1` dan `role = 'member'`.
2. **Login Akun (`Login.php`)**:
   - Memeriksa kredensial email & password menggunakan `password_verify()`.
   - Menginisialisasi session `is_login`, `id`, `name`, `email`.
3. **Proteksi Otorisasi IDOR**:
   - Method sensitif di `Profile`, `Cart`, `Myorder` diwajibkan memeriksa kepemilikan data berdasar ID session aktif (`$this->id`).

### B. Manajemen Keranjang Belanja (`Cart.php`)
1. Isolation data keranjang per `id_user`.
2. Penambahan item dengan opsi pesan varian/catatan khusus.
3. Rekalkulasi otomatis kuantitas dan subtotal item.

### C. Pembuatan Orders & Rekalkulasi Harga (`Checkout.php`)
1. **Pencegahan Manipulasi Harga (*Price Tampering*)**:
   - Harga produk diambil langsung dari database tabel `product`.
   - Diskon dihitung ulang berdasarkan rumus persentase di server.
   - Ongkos kirim diverifikasi ulang via API RajaOngkir di server.
2. **Generasi Kode Invoice**:
   - Format invoice unik: `INV/YYYYMMDD/{RANDOM_NUM}`.

---

## 5. Atribut Kualitas Perangkat Lunak (Non-Functional Specifications)

### A. Keamanan (Security)
- **CSRF Protection**: Aktif (`$config['csrf_protection'] = TRUE`).
- **Session Hardening**: Cookie diset `HttpOnly` untuk mencegah pencurian cookie via XSS.
- **SQL Injection Prevention**: Menggunakan CodeIgniter Query Builder binding yang melakukan escaping otomatis.
- **Otorisasi IDOR**: Verifikasi kepemilikan objek pada seluruh endpoint user.

### B. Performa & Respon Sistem (Performance)
- Waktu muat Halaman Katalog < 2.0 detik.
- Penggunaan indeks database pada Foreign Key (`id_category`, `id_user`, `id_orders`, `id_product`).
- Query teroptimasi menggunakan JOIN explicit untuk mencegah N+1 Query Problem.

### C. Reliabilitas & Ketersediaan (Reliability)
- Penanganan error upload gambar (validasi tipe file `jpg|jpeg|png|gif` dan batas ukuran 2MB).
- Soft Delete pada tabel produk (`delete = 0`) untuk menjaga integritas data histori transaksi pesanan lama.
