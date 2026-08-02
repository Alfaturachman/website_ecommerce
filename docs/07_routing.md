# 07. API & Routing Specification

## 1. Pemetaan Endpoint Publik & Customer

### A. Katalog & Pencarian Produk
| Method | Endpoint URI | Otorisasi | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` atau `/home` | Public | Halaman beranda (Slider banner & produk terbaru Pria/Wanita) | HTML View |
| `GET` | `/shop` | Public | Katalog seluruh produk dengan filter harga | HTML View |
| `GET` | `/shop/men` | Public | Katalog produk khusus Pria (`type = 'L'`) | HTML View |
| `GET` | `/shop/women` | Public | Katalog produk khusus Wanita (`type = 'W'`) | HTML View |
| `GET` | `/shop/unisex` | Public | Katalog produk Unisex (`type = 'U'`) | HTML View |
| `GET` | `/shop/category/{slug}` | Public | Katalog produk berdasarkan slug kategori | HTML View |
| `GET` | `/shop/{gender}/category/{slug}` | Public | Filter kombinasi gender dan kategori | HTML View |
| `GET/POST`| `/shop/search/{page?}` | Public | Parameter POST: `keyword`. Pencarian produk dengan pagination | HTML View |
| `GET` | `/shop/detail/{slug}` | Public | Halaman detail rincian produk | HTML View |

---

### B. Otentikasi & Profil Customer
| Method | Endpoint URI | Otorisasi | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- | :--- |
| `GET/POST`| `/login` | Guest Only | Parameter POST: `email`, `password` | HTML / Redirect |
| `GET/POST`| `/register` | Guest Only | Parameter POST: `name`, `email`, `password`, `phone`, `address` | HTML / Redirect |
| `GET` | `/logout` | User Login | Destruksi session login | Redirect `/` |
| `GET` | `/profile` | User Login | Halaman profil pengguna | HTML View |
| `POST` | `/profile/update/{id}` | User Login | Parameter POST: `name`, `email`, `password`, `phone`, `address`, `image` | HTML / Redirect |

---

### C. Keranjang Belanja & Checkout (AJAX & HTML)
| Method | Endpoint URI | Otorisasi | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/cart` | User Login | Tampilan item keranjang belanja pengguna | HTML View |
| `POST` | `/cart/add` | User Login | Parameter POST: `id_product`, `quantity`, `message` | Redirect `/cart` |
| `POST` | `/cart/update/{id}` | User Login | Parameter POST: `quantity` | Redirect `/cart` |
| `POST` | `/cart/updateMessage/{id}` | User Login | Parameter POST: `message` | Redirect `/cart` |
| `POST` | `/cart/delete/{id}` | User Login | Hapus item dari keranjang berdasar ID cart | Redirect `/cart` |
| `GET` | `/checkout` | User Login | Halaman formulir checkout & daftar provinsi | HTML View |
| `POST` | `/checkout/create` | User Login | Parameter POST: `name`, `address`, `phone`, `province`, `city`, `courier` | Redirect `/myorder` |
| `GET` | `/checkout/rajaongkir_cek_kabupaten` | User Login | Query Param: `prov_id`. Fetch daftar kota/kabupaten | JSON Response |
| `GET` | `/checkout/rajaongkir_cek_ongkir` | User Login | Query Param: `kab_id`, `courier`. Fetch biaya ongkos kirim | JSON Response |

#### Contoh Respon JSON AJAX Ongkir (`/checkout/rajaongkir_cek_ongkir`):
```json
{
  "rajaongkir": {
    "status": { "code": 200, "description": "OK" },
    "results": [
      {
        "code": "jne",
        "name": "Jalur Nugraha Ekakurir (JNE)",
        "costs": [
          {
            "service": "REG",
            "description": "Layanan Reguler",
            "cost": [
              {
                "value": 18000,
                "etd": "2-3",
                "note": ""
              }
            ]
          }
        ]
      }
    ]
  }
}
```

---

### D. Riwayat Pesanan Customer
| Method | Endpoint URI | Otorisasi | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/myorder/{status?}` | User Login | Daftar transaksi pesanan pengguna (`waiting`, `paid`, `process`, `done`, `cancel`) | HTML View |
| `GET` | `/myorder/detail/{invoice}` | User Login | Rincian detail pesanan berdasar kode invoice | HTML View |
| `GET/POST`| `/myorder/confirm/{invoice}`| User Login | Form & POST parameter: `account_name`, `nominal`, `note`, `image` | HTML / Redirect |
| `POST` | `/myorder/cancel/{invoice}` | User Login | Pembatalan pesanan oleh pembeli | Redirect `/myorder` |

---

## 2. Pemetaan Endpoint Administrator (`/admin/...`)

Seluruh endpoint berikut membutuhkan otorisasi session `username` admin (`_requireAdmin()`).

### A. Dashboard & Pelanggan
| Method | Endpoint URI | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- |
| `GET/POST`| `/admin` | Form & proses login administrator (`username`, `password`) | HTML / Redirect |
| `GET` | `/admin/dashboard` | Dashboard statistik toko | HTML View |
| `GET` | `/admin/customer/{page?}` | Daftar seluruh pelanggan terdaftar dengan pagination | HTML View |
| `POST` | `/admin/customer/create` | Tambah data customer oleh admin | Redirect |
| `POST` | `/admin/customer/edit/{id}` | Edit data customer | Redirect |
| `POST` | `/admin/customer/delete/{id}` | Hapus akun customer | Redirect |

---

### B. Kelola Produk, Kategori & Slider
| Method | Endpoint URI | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- |
| `GET` | `/admin/category` | Daftar kategori produk | HTML View |
| `POST` | `/admin/category/create` | Parameter POST: `title` | Redirect |
| `POST` | `/admin/category/edit/{id}` | Parameter POST: `title` | Redirect |
| `POST` | `/admin/category/delete/{id}` | Hapus kategori berdasar ID | Redirect |
| `GET` | `/admin/product` | Daftar produk di inventaris toko | HTML View |
| `POST` | `/admin/product/create` | POST: `title`, `id_category`, `price`, `type`, `size`, `color`, `image` | Redirect |
| `POST` | `/admin/product/edit/{id}` | Edit detail produk + upload gambar baru | Redirect |
| `POST` | `/admin/product/delete/{id}` | Soft delete produk (`delete = 0`) | Redirect |
| `GET` | `/admin/slider` | Daftar banner slider beranda | HTML View |
| `POST` | `/admin/slider/create` | Tambah banner slider baru | Redirect |
| `POST` | `/admin/slider/edit/{id}` | Edit banner slider | Redirect |
| `POST` | `/admin/slider/delete/{id}` | Hapus banner slider | Redirect |

---

### C. Kelola Pesanan & Laporan Keuangan
| Method | Endpoint URI | Deskripsi & Parameter Input | Respon Format |
| :--- | :--- | :--- | :--- |
| `GET` | `/admin/order` | Daftar seluruh pesanan dari pelanggan | HTML View |
| `GET` | `/admin/order/detail/{id}` | Rincian detail pesanan & bukti pembayaran transfer | HTML View |
| `POST` | `/admin/order/update/{id}` | Parameter POST: `status`, `waybill` (Nomor resi) | Redirect |
| `GET` | `/admin/order/report` | Export & download laporan pesanan format PDF (Dompdf) | PDF File Download |
