# 09. User & Administrator Manual

## 1. Panduan Pengguna / Pembeli (Customer Manual)

### A. Registrasi Akun & Login
1. Buka browser dan kunjungi `http://localhost/nomadenstuff/`.
2. Klik tombol **Register** pada menu navigasi kanan atas.
3. Isi data formulir registrasi:
   - **Nama Lengkap**: Masukkan nama lengkap Anda.
   - **Email**: Masukkan email aktif (digunakan untuk login).
   - **Password**: Masukkan password aman.
   - **Nomor Telepon & Alamat**: Masukkan data kontak & alamat pengiriman utama.
4. Klik **Register**. Setelah berhasil, Anda dapat melakukan **Login** dengan email dan password tersebut.

---

### B. Jelajah Katalog & Pencarian Produk
1. Untuk mencari pakaian berdasarkan kategori atau gender (Pria/Wanita/Unisex), pilih menu **Shop** atau kategori pada navbar.
2. Gunakan kolom **Pencarian** di bagian atas untuk mengetikkan kata kunci produk (misal: `"Jaket Denim"`).
3. Klik pada gambar produk untuk melihat detail ukuran, varian warna, dan deskripsi produk.

---

### C. Menambahkan ke Keranjang & Checkout
1. Pada halaman detail produk, masukkan catatan/pesan khusus jika ada (misal: `"Warna Hitam Ukuran L"`), lalu klik **Tambah ke Keranjang**.
2. Buka halaman **Keranjang Belanja** (`/cart`) untuk memeriksa daftar barang dan kuantitas.
3. Klik tombol **Checkout** (`/checkout`).
4. Pada formulir pengiriman:
   - Isi Nama Penerima & Telepon.
   - Pilih **Provinsi** dan **Kota/Kabupaten** tujuan.
   - Pilih Kurir Ekspedisi (**JNE / POS / TIKI**).
   - Sistem akan menghitung otomatis ongkos kirim dan total tagihan.
5. Klik **Buat Pesanan**. Status pesanan Anda sekarang menjadi `WAITING`.

---

### D. Konfirmasi Pembayaran & Pelacakan Resi
1. Lakukan transfer pembayaran ke rekening bank toko yang tertera pada invoice.
2. Buka menu **Pesanan Saya** (`/myorder`), lalu pilih pesanan dengan status `WAITING`.
3. Klik tombol **Konfirmasi Pembayaran**.
4. Isi Nama Pemilik Rekening, Nominal Transfer, dan **Unggah Foto Bukti Transfer**. Klik **Kirim**.
5. Status pesanan akan berubah menjadi `PAID` (Menunggu verifikasi admin).
6. Setelah admin memproses dan memasukkan nomor resi, status berubah menjadi `PROCESS` dan nomor resi (*waybill*) akan muncul pada detail pesanan Anda.

---

## 2. Panduan Administrator Toko (Admin Manual)

### A. Login Dashboard Admin
1. Kunjungi URL khusus admin: `http://localhost/nomadenstuff/admin`.
2. Masukkan **Username** dan **Password** admin (Akun default: `admin` / `admin123`).
3. Anda akan masuk ke **Dashboard Utama** yang menampilkan statistik Total User, Total Produk, dan Ringkasan Transaksi.

---

### B. Mengelola Inventaris & Produk (CRUD Produk)
1. **Tambah Produk Baru**:
   - Pilih menu **Produk** -> Klik **Tambah Produk**.
   - Isi Judul Produk, Kategori, Harga (Rp), Target Gender (`L`/`W`/`U`), Ukuran, Warna, dan Deskripsi.
   - Unggah gambar produk (Format: `.jpg`, `.png`, `.jpeg`).
   - Pilih Ketersediaan Stok (`Ada` / `Habis`).
   - Klik **Simpan**.
2. **Edit / Soft Delete Produk**:
   - Klik ikon **Edit** untuk mengonstruksi ulang harga atau gambar produk.
   - Klik ikon **Hapus** untuk menghapus produk dari katalog publik (Soft delete).

---

### C. Mengelola Banner Slider Beranda
1. Pilih menu **Slider**.
2. Klik **Tambah Slider** untuk mengunggah banner promo baru.
3. Tentukan urutan tampilan (*sequence*) agar banner muncul secara berurutan di beranda depan.

---

### D. Verifikasi Pembayaran & Input Resi Pengiriman
1. Pilih menu **Orders** (`/admin/order`).
2. Klik tombol **Detail** pada pesanan yang berstatus `PAID`.
3. Periksa bukti transfer yang diunggah oleh pelanggan.
4. Jika dana sudah masuk:
   - Ubah status pesanan menjadi **`PROCESS`**.
   - Masukkan **Nomor Resi / Waybill** dari ekspedisi pengiriman (JNE/POS/TIKI).
   - Klik **Update Status**.
5. Ketika barang sudah terkonfirmasi sampai ke pelanggan, ubah status menjadi **`DONE`**.

---

### E. Mencetak Laporan Transaksi Keuangan PDF
1. Buka menu **Orders**.
2. Klik tombol **Cetak Laporan PDF** di bagian atas tabel.
3. Sistem akan secara otomatis memproses dan mengunduh berkas PDF berisi rekapitulasi seluruh transaksi penjualan toko.
