# Nomadenstuff E-Commerce System

Platform e-commerce toko online ritel busana dan gaya hidup berbasis PHP CodeIgniter 3 (MVC) yang dilengkapi dengan sistem integrasi ongkos kirim otomatis (RajaOngkir API), konfirmasi pembayaran transfer bank, ekspor laporan pesanan PDF (Dompdf), serta proteksi keamanan yang telah diaudit dan diperkuat (Post-Audit Hardened).

---

## Project Documentation (docs/)

Proyek ini dilengkapi dengan modul dokumentasi terstruktur yang dapat diakses di folder `docs/`:

- **[Documentation Index (README.md)](docs/README.md)** - Hub utama dokumentasi proyek.
- **[01. Business Requirement Document (BRD)](docs/01_brd.md)** - Mengapa proyek ini dibuat & target bisnis.
- **[02. Product Requirement Document (PRD)](docs/02_prd.md)** - Fitur apa saja yang akan dibangun (User Story & Flow).
- **[03. Software Requirement Specification (SRS)](docs/03_srs.md)** - Detail teknis fungsi fitur & batasan sistem.
- **[04. System Architecture](docs/04_architecture.md)** - Diagram sistem, infra cloud, & tech stack.
- **[05. Database Schema](docs/05_database.md)** - Skema ERD & Kamus Data (tipe data tiap kolom).
- **[06. Design & UI Guide](docs/06_desain.md)** - Tautan Figma, Wireframe, & Panduan Gaya UI.
- **[07. API & Routing](docs/07_routing.md)** - Dokumentasi API Endpoint (Request & Response).
- **[08. QA & Testing Report](docs/08_testing.md)** - Skenario pengujian QA (Test Cases & Hasil UAT).
- **[09. User & Admin Manual](docs/09_user_manual.md)** - Panduan cara pakai aplikasi untuk pengguna/admin.
- **[10. Deployment & CI/CD](docs/10_deployment.md)** - Docker setup, Environment (.env), & CI/CD Pipeline.
- **[11. Security Architecture](docs/11_security.md)** - Aspek keamanan aplikasi, OWASP Top 10, & Security Log.
- **[12. Architectural Decision Log](docs/12_decision_log.md)** - Alasan di balik keputusan teknis & arsitektur (ADR).
- **[13. System Changelog](docs/13_changelog.md)** - Riwayat perubahan versi sistem (SemVer v1.0.0).

---

## Tech Stack and Dependencies

| Layer | Teknologi |
| :--- | :--- |
| **Backend Framework** | PHP 7.4 - 8.2+ / CodeIgniter 3 (MVC Architecture) |
| **Database** | MySQL / MariaDB (MySQLi driver) |
| **Frontend UI** | Bootstrap 4, jQuery, FontAwesome |
| **Logistics API** | RajaOngkir API (Starter Plan: JNE, POS, TIKI) |
| **PDF Reporting** | Dompdf ^2.0 (via Composer) |
| **Security and Auth** | Bcrypt (`password_hash`), Session HttpOnly, CSRF Protection, Server-side Price Verification |

---

## Keamanan dan Auditing (Post-Audit Hardened)

Aplikasi ini telah melalui audit keamanan menyeluruh dan dilengkapi dengan fitur proteksi:
1. **Server-Side Price Calculation**: Mencegah manipulasi harga checkout (Price Tampering) dengan menghitung ulang subtotal dan tarif ongkir di server.
2. **Proteksi IDOR**: Membatasi otorisasi akses data sensitif (Profile, Cart, Order) sesuai `id_user` session yang sedang login.
3. **Session HttpOnly dan CSRF Protection**: Mencegah pencurian cookie session via XSS dan melindungi form dari serangan Cross-Site Request Forgery.
4. **Pencarian dan Pagination Terisolasi**: Penanganan keyword pencarian berbasis Session agar pagination aman pada HTTP GET/POST.

---

## Directory Structure Overview

```text
nomadenstuff/
├── application/
│   ├── config/          # Database, routes, security, and RajaOngkir configs
│   ├── controllers/     # Public/Customer controllers (Home, Shop, Cart, Checkout, Myorder, Profile)
│   │   └── admin/       # Admin controllers (Dashboard, Product, Order, Customer, Slider, Setting)
│   ├── core/            # Core extensions (MY_Controller.php, MY_Model.php)
│   ├── helpers/         # Helper functions (ciolshop_helper.php)
│   ├── libraries/       # Image_uploader.php, Rajaongkir.php, Pdfgenerator.php
│   ├── models/          # Data Models (Register_model, Product_model, Order_model, etc.)
│   └── views/           # Layouts (user/admin) and Page views
├── assets/              # Static assets (CSS, JS, Fonts, Vendors)
├── docs/                # Project Documentation (PRD, BRD, Architecture, ERD, Security, API)
├── images/              # Upload directories (product/, profile/, slider/, confirm/)
├── system/              # CodeIgniter Framework Core
└── vendor/              # Composer packages (Dompdf, etc.)
```

---

## Quick Start and Installation

### Option A: Local Web Server (Laragon / XAMPP / WAMP)
1. **Clone and Setup Web Server**:
   Letakkan repositori di dalam folder web server (misal: `C:/laragon/www/nomadenstuff` atau `htdocs/nomadenstuff`).

2. **Environment Variables**:
   Salin `.env.example` menjadi `.env` dan sesuaikan kredensial lokal Anda:
   ```bash
   cp .env.example .env
   ```

3. **Inisialisasi Database**:
   Impor file `database/schema.sql` dan `database/seeds/initial_seeds.sql` ke dalam database MySQL Anda (`nomadenstuff`).

4. **Akses Aplikasi**:
   - **Toko Front-end**: `http://localhost/nomadenstuff/`
   - **Panel Admin**: `http://localhost/nomadenstuff/admin`

---

### Option B: Docker Containerization
Jalankan seluruh stack (PHP 8.2 + Apache + MySQL 8.0) dengan satu perintah:
```bash
docker-compose up -d
```
- **Akses Web**: `http://localhost:8080`
- **Akses Admin**: `http://localhost:8080/admin`

---

## CI/CD Pipeline and Code Quality

- **Automated CI/CD**: Terintegrasi dengan GitHub Actions (`.github/workflows/ci.yml`) yang otomatis menjalankan linter sintaksis PHP dan test suite saat `push` atau `pull_request`.
- **Code Style Standard**: Menggunakan standar PSR-12 (`.php-cs-fixer.php` dan `.editorconfig`).
- **Running Tests**: Run `php tests/run_tests.php`

---

## Running Unit and Feature Tests

Proyek ini telah dilengkapi dengan suite pengujian otomatis (Unit and Feature Tests) di folder `tests/`.

Untuk menjalankan seluruh test suite:
```bash
php tests/run_tests.php
```

---

## Kredensial Default (Development)

- **Admin Account**: `admin` / `admin`
- **User Account**: Silakan lakukan pendaftaran akun baru pada halaman `/register`.

---

## Lisensi dan Kredit

Hak Cipta (c) 2026 Nomadenstuff Team. Dikembangkan dengan CodeIgniter 3 Framework.
