# 11. Security Architecture & Audit Report

## 1. Ringkasan Postur Keamanan (Security Posture Summary)

Aplikasi **Nomadenstuff E-Commerce** telah melalui proses **Security Audit & Vulnerability Hardening** menyeluruh berdasarkan panduan keamanan **OWASP Top 10**. Seluruh fitur utama (Autentikasi, Cart, Checkout, Profile, dan Panel Admin) telah diproteksi dari berbagai ancaman kejahatan siber umum.

---

## 2. Matriks Temuan Vulnerability & Status Mitigasi

| ID Vulnerability | Modul Target | Severity | Deskripsi Ancaman Keamanan | Status Mitigasi |
| :--- | :--- | :--- | :--- | :--- |
| **SEC-01** | `Checkout.php` | **CRITICAL** | **Client-side Price & Discount Tampering**: Parameter `totalBelanja` dan `shippingCost` diambil dari input POST client tanpa kalkulasi server-side. Penyerang dapat merubah total bayar menjadi Rp 1. | **FIXED** (Kalkulasi ulang wajib di server-side) |
| **SEC-02** | `Profile.php` | **HIGH** | **Account Takeover via IDOR**: Method `update($id)` tidak memverifikasi apakah `$id` milik user ter-login. User dapat mengedit data user lain. | **FIXED** (Enforce validation `(int)$id === (int)$this->id`) |
| **SEC-03** | `Cart.php` | **HIGH** | **Cart Data Tampering via IDOR**: Method `update()`, `updateMessage()`, dan `delete()` tidak memfilter `id_user`. Pembeli dapat mengubah/menghapus cart orang lain. | **FIXED** (Added `where('id_user', $this->id)`) |
| **SEC-04** | `Myorder.php` | **HIGH** | **Order Information Disclosure via IDOR**: Method `detail()`, `confirm()`, dan `cancel()` tidak memvalidasi `id_user`. Pembeli dapat melihat/membatalkan pesanan lain. | **FIXED** (Added `where('id_user', $this->id)` & lock `id_orders`) |
| **SEC-05** | `config.php` | **MEDIUM** | **Disabled CSRF & HttpOnly Cookie**: Protection CSRF dimatikan (`csrf_protection = FALSE`) dan cookie session tidak diproteksi dari XSS (`cookie_httponly = FALSE`). | **FIXED** (Enabled CSRF & HttpOnly cookie) |
| **SEC-06** | `Customer.php` | **MEDIUM** | **Password Hash Disclosure in View Dataset**: Method `index()` dan `search()` memuat kolom `user.password` ke array dataset view. | **FIXED** (Removed `user.password` dari SELECT) |
| **SEC-07** | `Setting.php` | **HIGH** | **Undefined Variable Fatal Error**: Method `unique_username()` menggunakan variabel yang tidak pernah dideklarasikan. | **FIXED** (Koreksi variabel & pesan error key) |
| **SEC-08** | `Register_model` | **MEDIUM** | **Account Lockout on Register**: Pendaftaran user tidak menyertakan `'is_active' => 1`, menyebabkan akun tidak dapat login. | **FIXED** (Set default `is_active` ke 1) |

---

## 3. Rincian Implementasi Proteksi Keamanan

### A. Server-Side Price Calculation (`Checkout::create()`)
Seluruh nilai transaksi keuangan (harga barang, persentase diskon promo, dan ongkos kirim ekspedisi) dihitung dan diverifikasi ulang secara independen oleh server dari database dan API resmi RajaOngkir:
```php
// Hitung ulang harga item langsung dari Database (Server-Side)
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += ((int)$item->price * (int)$item->quantity);
}

// Hitung ulang ongkir via API RajaOngkir di Server-Side
$costResponse = json_decode($this->rajaongkir->cost(152, (int)$id_kabupaten, $berat, $courier), true);
$shippingCost = (int)$costResponse['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

// Rekalkulasi total akhir tagihan
$totalBelanja = ($subtotal - $diskon) + $shippingCost;
```

---

### B. Proteksi Access Control & IDOR (In-Direct Object Reference)
Seluruh query modifikasi data sensitif dibatasi menggunakan kriteria pemilik session aktif:
```php
// Contoh pada Cart.php
$this->db->where('id', $id);
$this->db->where('id_user', $this->session->userdata('id')); // Isolasi per ID User
$this->db->delete('cart');
```

---

### C. Keamanan Konfigurasi Session & CSRF (`application/config/config.php`)
- **CSRF Protection**: `$config['csrf_protection'] = TRUE;` (Semua form POST wajib menyertakan token CSRF).
- **HttpOnly Cookie**: `$config['cookie_httponly'] = TRUE;` (Mencegah skrip JavaScript malicious/XSS membaca cookie session).
- **Session Encryption**: Menggunakan string acak 32 karakter pada `$config['encryption_key']`.

---

### D. Hashing Password & Proteksi SQL Injection
- Hashing password menggunakan algoritma Bcrypt via `password_hash($password, PASSWORD_DEFAULT)` dan diverifikasi dengan `password_verify()`.
- Semua interaksi database menggunakan CodeIgniter Query Builder yang secara otomatis melakukan *parameter escaping* untuk mencegah serangan **SQL Injection**.

---

### E. Validasi Upload Berkas Gambar (`application/libraries/Image_uploader.php`)
- Pembatasan ekstensi file terverifikasi: `jpg`, `jpeg`, `png`, `gif`.
- Pembaruan nama file secara acak berbasis timestamp (`md5(uniqid(rand(), true))`) untuk mencegah eksekusi skrip berbahaya (*Arbitrary File Upload / Remote Code Execution*).
- Batas maksimal ukuran file gambar diset 2MB.

---

## 4. Panduan Pemeliharaan Keamanan Berkelanjutan (Security Maintenance)

1. **CSRF Tokens pada Form Baru**: Pastikan setiap form buatan baru di view menyertakan input token CSRF:
   ```html
   <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
   ```
2. **Isolasi File Environment**: Jangan simpan API Key RajaOngkir atau password database di dalamRepositori Publik (Gunakan file `.env`).
3. **Environment Production**: Pastikan `ENVIRONMENT` diatur ke `'production'` di server live untuk menyembunyikan stack trace error internal dari pengguna luar.
