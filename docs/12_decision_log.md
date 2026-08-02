# 12. Architectural Decision Log (ADR)

## 1. Pendahuluan

Dokumen ini mencatat **Architectural Decision Records (ADR)** yang mendokumentasikan alasan di balik keputusan teknis, arsitektur sistem, pemilihan teknologi, dan pola desain yang diterapkan dalam proyek **Nomadenstuff E-Commerce**.

---

## 2. Daftar Rekam Keputusan Arsitektur (ADRs)

### ADR-001: Penggunaan Framework CodeIgniter 3 MVC & Ekstensi Core (`MY_Controller`, `MY_Model`)
- **Status**: Accepted / Active
- **Konteks**: Diperlukan framework PHP yang ringan, cepat dipasang di lingkungan hosting lokal/shared, dan memiliki arsitektur MVC yang jelas.
- **Keputusan**: Menggunakan CodeIgniter 3.1.13 dengan memperluas kelas `MY_Controller` dan `MY_Model` di `application/core/`.
- **Konsekuensi**:
  - *Positif*: Ukuran repositori sangat ringan, performa eksekusi sangat cepat, dan standarisasi logika CRUD via `MY_Model` (method `select`, `where`, `join`, `paginate`).
  - *Negatif*: CI3 belum memiliki ORM bawaan layaknya Laravel Eloquent, sehingga pembuatan helper query manual diperlukan pada `MY_Model`.

---

### ADR-002: Perhitungan Harga, Diskon, dan Ongkir Wajib Server-Side
- **Status**: Accepted / Active
- **Konteks**: Pada versi terdahulu, parameter `totalBelanja` dan `shippingCost` dikirim langsung dari form HTTP POST client-side browser yang rentan di-manipulasi (*Price Tampering*).
- **Keputusan**: Mewajibkan rekalkulasi total belanja dan biaya ongkos kirim secara independen pada controller `Checkout::create()`.
- **Konsekuensi**:
  - *Positif*: Menjamin integritas transaksi keuangan 100%. Pembeli tidak dapat mengubah total harga bayar.
  - *Negatif*: Membutuhkan panggil ulang API RajaOngkir di server-side saat pembuatan pesanan.

---

### ADR-003: Integrasi API RajaOngkir via Server-Side cURL Library
- **Status**: Accepted / Active
- **Konteks**: Aplikasi membutuhkan data wilayah (Provinsi, Kota/Kabupaten) dan tarif pengiriman otomatis dari kurir resmi di Indonesia (JNE, POS, TIKI).
- **Keputusan**: Membuat custom library `application/libraries/Rajaongkir.php` yang berinteraksi dengan API cURL ke server RajaOngkir Starter.
- **Konsekuensi**:
  - *Positif*: Tidak perlu menyimpan master data tarif ongkir ratusan kota yang sering berubah di database lokal.
  - *Negatif*: Bergantung pada ketersediaan Uptime server API RajaOngkir.

---

### ADR-004: Autentikasi Session Native CodeIgniter & Hashing Bcrypt
- **Status**: Accepted / Active
- **Konteks**: Membutuhkan mekanisme otentikasi user dan admin yang aman dan kompatibel dengan browser tanpa kerumitan token SPA.
- **Keputusan**: Menggunakan Native CodeIgniter Session dengan enkripsi Bcrypt (`PASSWORD_DEFAULT`) serta pemisahan session guard (`_requireLogin` vs `_requireAdmin`).
- **Konsekuensi**:
  - *Positif*: Sangat aman untuk aplikasi web tradisional, terlindungi dari XSS jika cookie diset `HttpOnly`.
  - *Negatif*: Session disimpan di server storage/cookie.

---

### ADR-005: Soft Delete pada Tabel Katalog Produk (`product.delete`)
- **Status**: Accepted / Active
- **Konteks**: Jika produk yang pernah dibeli oleh pelanggan dihapus secara permanen (Hard Delete) dari database, maka data rincian histori pesanan lama (`order_detail`) akan mengalami *broken relation*.
- **Keputusan**: Mengimplementasikan Soft Delete menggunakan kolom `delete TINYINT(1)` (1=Aktif, 0=Deleted).
- **Konsekuensi**:
  - *Positif*: Menjaga integritas data transaksi pesanan terdahulu dan laporan keuangan.
  - *Negatif*: Data produk yang di-delete tetap berada di tabel `product`, membutuhkan filter `where('delete', 1)` pada pencarian katalog publik.

---

### ADR-006: Kontainerisasi Aplikasi Menggunakan Docker & Docker Compose
- **Status**: Accepted / Active
- **Konteks**: Diperlukan standarisasi lingkungan pengembangan (Development) dan produksi (Production) yang konsisten antara pengembang tanpa kendala perbedaan versi PHP/MySQL lokal.
- **Keputusan**: Menyediakan `Dockerfile` (PHP 8.2 Apache dengan ekstensi `gd`, `mysqli`, `pdo_mysql`) dan `docker-compose.yml` (multi-container Web + MySQL 8.0).
- **Konsekuensi**:
  - *Positif*: Aplikasi dapat dijalankan di mana saja dengan satu perintah `docker-compose up -d`.
  - *Negatif*: Membutuhkan Docker Desktop / Runtime terpasang pada komputer pengembang.

---

### ADR-007: Custom CLI Test Suite Runner (`tests/run_tests.php`)
- **Status**: Accepted / Active
- **Konteks**: Membutuhkan pengujian otomatis yang dapat dijalankan tanpa dependensi berat PHPUnit di lingkungan CI/CD GitHub Actions.
- **Keputusan**: Membangun custom test runner ringan `tests/run_tests.php` dengan `tests/TestCase.php` assertion engine.
- **Konsekuensi**:
  - *Positif*: Eksekusi test sangat cepat (< 1 detik), tidak perlu install package testing tambahan di vendor.
  - *Negatif*: Sintaks assertion terbatas pada fungsi assertion bawaan yang dibuat.
