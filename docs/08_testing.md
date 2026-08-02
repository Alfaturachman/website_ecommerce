# 08. QA Testing Strategy & UAT Report

## 1. Strategi & Kerangka Kerja Pengujian (Testing Strategy)

Pengujian perangkat lunak pada aplikasi Nomadenstuff E-Commerce menggunakan kombinasi pengujian otomatis (**Automated Unit & Feature Testing**) berbasis CLI runner dan pengujian manual (**User Acceptance Testing / UAT**).

### Struktur Test Suite (`tests/`):
```text
tests/
├── unit/                         # Pengujian Unit Komponen
│   ├── RegisterModelTest.php     # Test Hashing Password & Active Status
│   ├── CheckoutCalculationTest.php# Test Formula Server-Side Pricing
│   └── ImageUploaderTest.php     # Test Rule Security Upload File
├── feature/                      # Pengujian Fitur End-to-End & Keamanan
│   ├── ProfileAuthorizationTest.php# Test IDOR Mitigation pada Profil
│   ├── CartIsolationTest.php     # Test Isolasi Data Cart per User
│   └── SearchPaginationTest.php  # Test Session Query & Pagination
├── bootstrap.php                 # Environment Test Bootstrapper
├── TestCase.php                  # Custom Assertion Engine
└── run_tests.php                 # CLI Test Suite Execution Runner
```

---

## 2. Matriks Automated Test Cases & Hasil Eksekusi

Perintah untuk menjalankan seluruh suite pengujian otomatis:
```bash
php tests/run_tests.php
```

### Ringkasan Hasil Automated Test Suite:

| Suite / Test Class | Test Case ID | Skenario Pengujian | Expected Result | Status |
| :--- | :--- | :--- | :--- | :--- |
| `RegisterModelTest` | `UT-01` | Registrasi user baru | Password di-hash Bcrypt & `is_active` bernilai `1` | **PASSED** |
| `CheckoutCalculationTest` | `UT-02` | Kalkulasi Total Belanja Server-Side | Diskon persentase & ongkir dihitung presisi | **PASSED** |
| `ImageUploaderTest` | `UT-03` | Upload file non-image (`script.php`) | Sistem menolak upload dengan error type | **PASSED** |
| `ProfileAuthorizationTest` | `FT-01` | Akses update profile ID user lain (IDOR) | Akses ditolak (`(int)$id !== session_id`) | **PASSED** |
| `CartIsolationTest` | `FT-02` | Hapus cart item user B menggunakan session user A | Item tidak terhapus (`where id_user`) | **PASSED** |
| `SearchPaginationTest` | `FT-03` | Pencarian produk dengan keyword & pagination | Data ter-filter sesuai keyword tanpa leak | **PASSED** |

---

## 3. Matriks Skenario User Acceptance Testing (UAT) Manual

### A. Pengujian Customer Flow

| Test Case ID | Fitur / Alur | Langkah Pengujian | Hasil yang Diharapkan | Status UAT |
| :--- | :--- | :--- | :--- | :--- |
| `UAT-CUS-01` | Registrasi & Login | Isi form daftar -> Submit -> Login dengan email/password | Akun berhasil dibuat dan masuk ke session customer | **PASSED** |
| `UAT-CUS-02` | Filter & Search | Pilih gender `Men` & Kategori `Jaket` | Katalog hanya menampilkan produk Jaket Pria | **PASSED** |
| `UAT-CUS-03` | Tambah Keranjang | Klik "Tambah ke Keranjang" dengan pesan khusus | Item muncul di keranjang dengan pesan yang benar | **PASSED** |
| `UAT-CUS-04` | Checkout & Ongkir | Pilih Provinsi Jawa Tengah & Kabupaten Semarang | Pilihan kurir & biaya ongkir muncul via AJAX | **PASSED** |
| `UAT-CUS-05` | Upload Bukti Bayar | Unggah file `.jpg` pada formulir konfirmasi pesanan | Status pesanan berubah dari `waiting` menjadi `paid` | **PASSED** |

### B. Pengujian Admin Flow

| Test Case ID | Fitur / Alur | Langkah Pengujian | Hasil yang Diharapkan | Status UAT |
| :--- | :--- | :--- | :--- | :--- |
| `UAT-ADM-01` | CRUD Produk | Tambah produk baru + upload gambar produk | Produk tampil di katalog publik & dashboard admin | **PASSED** |
| `UAT-ADM-02` | Verifikasi Order | Cek bukti bayar -> Ubah status `process` -> Input Resi | Status ter-update dan resi tampil di akun customer | **PASSED** |
| `UAT-ADM-03` | Cetak Laporan PDF | Klik tombol "Cetak Laporan PDF" | File PDF transaksi berhasil di-download | **PASSED** |

---

## 4. Log Mitigasi Keamanan (Security Hardening Test Log)

| Vulnerability ID | Deskripsi Temuan Keamanan | Metode Mitigasi yang Diterapkan | Hasil Pengujian |
| :--- | :--- | :--- | :--- |
| `SEC-01` | **Client-side Price Tampering**: Parameter harga checkout dapat di-POST ulang via DevTools | Perhitungan ulang total belanja & ongkir di server-side (`Checkout::create()`) | **SECURE** |
| `SEC-02` | **IDOR pada Profil**: User A dapat mengedit profil User B dengan mengubah URL ID | Enforce validasi `$id == $this->session->userdata('id')` pada `Profile::update()` | **SECURE** |
| `SEC-03` | **IDOR pada Cart & Order**: User A dapat melihat / menghapus cart User B | Menambahkan filter wajib `where('id_user', $id_user)` di seluruh query cart/order | **SECURE** |
| `SEC-04` | **CSRF & Cookie Exposure**: Proteksi CSRF dimatikan & cookie tanpa HttpOnly | Mengaktifkan `csrf_protection = TRUE` dan `cookie_httponly = TRUE` di `config.php` | **SECURE** |
