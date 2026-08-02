# 13. System Changelog & Version History

Format riwayat perubahan ini mengikuti standar [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) dan mematuhi [Semantic Versioning (SemVer)](https://semver.org/).

---

## [v1.0.0] - 2026-08-02 (Production Release & Post-Audit Hardened)

### Fitur Baru (Added)
- **Modul Katalog & Pencarian**:
  - Filter produk berdasarkan Kategori, Gender (`L`=Pria, `W`=Wanita, `U`=Unisex), dan Rentang Harga.
  - Pencarian produk via keyword dengan penanganan session persistence & pagination terisolasi.
  - Tampilan slider banner promosi di halaman utama (Beranda).
- **Modul Keranjang & Checkout**:
  - Penambahan pesan khusus per item di keranjang belanja.
  - Integrasi RajaOngkir API (Starter Plan: JNE, POS, TIKI) untuk perhitungan biaya kirim otomatis berdasar berat barang dan kota tujuan.
  - Siklus transaksi pesanan (*Order Lifecycle*: `waiting` -> `paid` -> `process` -> `done` / `cancel`).
- **Modul Konfirmasi & Riwayat Transaksi**:
  - Formulir unggah foto bukti transfer pembayaran bank.
  - Pelacakan status pengiriman dan tampilan nomor resi (*waybill*).
- **Dashboard Administrator**:
  - Dashboard statistik toko (Total User, Produk, Orders, dan Order Tercepat).
  - Manajemen Inventaris Produk (CRUD + Upload Gambar + Soft Delete).
  - Manajemen Kategori & Banner Slider Beranda.
  - Manajemen Pelanggan (View/Edit/Delete).
  - Input nomor resi pengiriman (*waybill*) & pengubahan status order.
  - Cetak dan unduh Laporan Transaksi Format PDF lanskap A4 menggunakan `Dompdf`.
- **Infrastruktur & DevOps**:
  - Kontainerisasi berbasis Docker (`Dockerfile` PHP 8.2 Apache & `docker-compose.yml` MySQL 8.0).
  - Pipeline CI/CD GitHub Actions (`.github/workflows/ci.yml`) untuk linting sintaks PHP dan eksekusi test suite otomatis.
  - Custom Automated Test Suite (`tests/run_tests.php`) untuk pengujian unit & fitur.

---

### Keamanan & Perbaikan Celah (Security & Fixed)
- **SEC-01 (Price Tampering)**: Rekalkulasi total belanja dan biaya ongkos kirim secara independen di server-side pada `Checkout::create()`.
- **SEC-02 (IDOR Profile)**: Penambahan validasi otorisasi `(int)$id === (int)$this->id` pada `Profile::update()` untuk mencegah pengubahan akun user lain.
- **SEC-03 & SEC-04 (IDOR Cart & Order)**: Penambahan kriteria wajib `where('id_user', $id_user)` pada controller `Cart` dan `Myorder` untuk mengisolasi data transaksi per pengguna.
- **SEC-05 (Session & CSRF Hardening)**: Mengaktifkan `$config['csrf_protection'] = TRUE` dan `$config['cookie_httponly'] = TRUE` pada `config.php`.
- **SEC-06 (Data Leakage)**: Menghapus kolom `user.password` dari SELECT query view dataset pada `Customer.php`.
- **SEC-07 (Undefined Variable)**: Memperbaiki variabel undefined `$username` pada validation callback `Setting::unique_username()`.
- **SEC-08 (Account Lockout)**: Menambahkan nilai default `'is_active' => 1` saat registrasi akun baru pada `Register_model`.

---

### Dokumentasi Proyek (Documentation)
- Restrukturisasi folder `docs/` menjadi **13 file standar terstruktur**:
  1. `01_brd.md` (Business Requirement Document)
  2. `02_prd.md` (Product Requirement Document)
  3. `03_srs.md` (Software Requirement Specification)
  4. `04_architecture.md` (System Architecture & Tech Stack)
  5. `05_database.md` (Database ERD & Data Dictionary)
  6. `06_desain.md` (UI Design System & Figma Wireframe)
  7. `07_routing.md` (API & Routing Specification)
  8. `08_testing.md` (QA Testing & UAT Report)
  9. `09_user_manual.md` (User & Admin Operating Manual)
  10. `10_deployment.md` (Deployment, Docker & CI/CD Guide)
  11. `11_security.md` (Security Architecture & Audit Report)
  12. `12_decision_log.md` (Architectural Decision Records / ADR)
  13. `13_changelog.md` (System Version History)
