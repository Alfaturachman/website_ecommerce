# 06. UI/UX Design System & Wireframe Guidelines

## 1. Tautan Desain & Prototip Figma

- **Figma Design File**: [Tautan Figma Wireframe & Prototype Nomadenstuff E-Commerce](https://www.figma.com/file/nomadenstuff-ecommerce-ui-design) *(Placeholder Reference)*
- **High-Fidelity Wireframe**: Mengacu pada tata letak Bootstrap 4 modern dengan estetika minimalis, clean typography, dan visual merchandising produk busana.

---

## 2. Palet Warna (Color Palette)

Aplikasi Nomadenstuff menggunakan sistem warna modern dengan kontras tinggi untuk kenyamanan membaca pengguna:

| Peran Warna | Kode Hex | Kelas CSS / Preview | Penggunaan |
| :--- | :--- | :--- | :--- |
| **Primary Color** | `#212529` | `bg-dark` / Dark Slate | Navbar, tombol utama, heading text |
| **Secondary Color** | `#6c757d` | `bg-secondary` / Cool Gray | Subtitle, border, disabled state |
| **Accent / Highlight** | `#007bff` | `btn-primary` / Ocean Blue | Link aktif, badge status, CTA checkout |
| **Success State** | `#28a745` | `badge-success` / Emerald | Status order `done` / `paid`, notifikasi sukses |
| **Warning State** | `#ffc107` | `badge-warning` / Amber | Status order `waiting`, peringatan stok |
| **Danger State** | `#dc3545` | `badge-danger` / Crimson | Status order `cancel`, tombol hapus |
| **Background Body** | `#f8f9fa` | `bg-light` / Soft Off-White | Latar belakang halaman aplikasi |

---

## 3. Tipografi & Font Family (Typography System)

- **Primary Font Family**: `'Roboto', 'Helvetica Neue', Arial, sans-serif`
- **Hierarki Ukuran Teks**:
  - `H1 / Title Utama`: 2.5rem (40px) - Bold (`font-weight: 700`)
  - `H2 / Section Title`: 2.0rem (32px) - Semi-Bold (`font-weight: 600`)
  - `H3 / Card Header`: 1.5rem (24px) - Medium (`font-weight: 500`)
  - `Body Text`: 1.0rem (16px) - Regular (`font-weight: 400`)
  - `Small / Badge Text`: 0.875rem (14px) - Regular / Muted

---

## 4. Panduan Komponen Antarmuka (UI Component Guidelines)

### A. Kartu Produk (Product Card Component)
- **Gambar Produk**: Aspect Ratio 1:1 (Square), `object-fit: cover`.
- **Badge Gender**: Badge warna terpisah (`Men`, `Women`, `Unisex`).
- **Judul Produk**: Truncate maksimal 2 baris agar tampilan grid seragam.
- **Harga**: Format mata uang Rupiah (`Rp 150.000`).

### B. Carousel Banner Beranda
- **Responsif**: Banner dinamis menyesuaikan lebar layar.
- **Navigasi Slider**: Indicator dot di bagian bawah dan kontrol panah kiri/kanan.

### C. Tabel Data & Status Badges
- Status pesanan disajikan menggunakan badge berwarna:
  - `WAITING`: Badge Amber (Kuning)
  - `PAID`: Badge Biru
  - `PROCESS`: Badge Cyan / Info
  - `DONE`: Badge Hijau
  - `CANCEL`: Badge Merah

---

## 5. Grid Breakdown & Responsive Breakpoints

Desain responsif mengikuti standar Bootstrap 4 Breakpoints:

| Device Category | Screen Width | Grid Columns | Penyesuaian Layout |
| :--- | :--- | :--- | :--- |
| **Mobile Extra Small** | `< 576px` | 1 Column | Catalog 1 kolom, full-width buttons |
| **Tablet Small** | `≥ 576px` | 2 Columns | Catalog 2 kolom, mobile navbar collapse |
| **Desktop Medium** | `≥ 768px` | 3 Columns | Catalog 3 kolom, sidebar filter aktif |
| **Desktop Large** | `≥ 992px` | 4 Columns | Catalog 4 kolom, navbar desktop penuh |
