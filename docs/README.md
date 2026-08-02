# Dokumentasi Proyek Nomadenstuff E-Commerce

Dokumentasi resmi untuk pengembangan, arsitektur sistem, kebutuhan fungsional, skema database, pengujian, panduan penggunaan, arsitektur keamanan, rekam keputusan arsitektur (ADR), riwayat perubahan (Changelog), serta panduan penggelaran (*deployment*) aplikasi toko online Nomadenstuff (PHP CodeIgniter 3).

---

## Modul Dokumentasi Terstruktur (13 Dokumen Standard)

Dokumentasi ini dibagi menjadi 13 modul utama yang saling melengkapi:

1. **[01_brd.md](01_brd.md) - Business Requirement Document**
   - Mengapa proyek ini dibuat, visi & target bisnis (KPI), siklus pesanan (*Order Lifecycle*), serta aturan perhitungan diskon dan ongkos kirim.

2. **[02_prd.md](02_prd.md) - Product Requirement Document**
   - Fitur apa saja yang dibangun, target persona pengguna, *User Stories*, *User Flow Diagram*, dan Matriks Kebutuhan Fungsional.

3. **[03_srs.md](03_srs.md) - Software Requirement Specification**
   - Detail teknis fungsi fitur, batasan sistem (*system constraints* PHP/MySQL/Memory), antarmuka eksternal (RajaOngkir & Dompdf), serta atribut kualitas sistem.

4. **[04_architecture.md](04_architecture.md) - System Architecture**
   - Diagram arsitektur sistem (Mermaid), infra cloud, *tech stack*, struktur direktori, ekstensi `MY_Controller` & `MY_Model`, serta pustaka integrasi.

5. **[05_database.md](05_database.md) - Database Schema & ERD**
   - Diagram Relasi Entitas (ERD) dan Kamus Data terperinci untuk 9 tabel database (`user`, `admin`, `category`, `product`, `cart`, `orders`, `order_detail`, `order_confirm`, `slider`).

6. **[06_desain.md](06_desain.md) - Design System & Wireframe**
   - Tautan prototip Figma, palet warna (*Color Palette*), tipografi, panduan komponen UI (Card, Badges, Carousel), serta *Responsive Grid Breakpoints*.

7. **[07_routing.md](07_routing.md) - API & Routing Specification**
   - Dokumentasi lengkap endpoint HTTP request, metode HTTP (`GET`/`POST`), hak akses otorisasi (Public, Customer, Admin), parameter input, dan contoh respon JSON/HTML.

8. **[08_testing.md](08_testing.md) - QA Testing & UAT Report**
   - Strategi pengujian otomatis berbasis `php tests/run_tests.php`, matriks *Automated Test Cases*, skenario *User Acceptance Testing (UAT)* manual, serta log mitigasi keamanan.

9. **[09_user_manual.md](09_user_manual.md) - User & Administrator Manual**
   - Panduan praktis langkah demi langkah pengoperasian aplikasi untuk pengguna/pembeli (Customer) dan pengelola toko (Admin).

10. **[10_deployment.md](10_deployment.md) - Deployment, Docker & CI/CD**
    - Konfigurasi environment (`.env`), Docker setup (`Dockerfile` & `docker-compose.yml`), instalasi server standalone, serta pipeline CI/CD GitHub Actions (`ci.yml`).

11. **[11_security.md](11_security.md) - Security Architecture & Audit Report**
    - Aspek keamanan aplikasi (OWASP Top 10), mitigasi *Price Tampering*, proteksi IDOR, enkripsi Bcrypt, CSRF protection, & cookie *HttpOnly*.

12. **[12_decision_log.md](12_decision_log.md) - Architectural Decision Log (ADR)**
    - Rekam alasan di balik keputusan teknis dan arsitektur (CI3 Core Extensions, Server-side calculation, RajaOngkir integration, Soft Delete, Docker containerization).

13. **[13_changelog.md](13_changelog.md) - System Version History**
    - Catatan riwayat perubahan versi sistem (SemVer v1.0.0 Production Release & Security Hardening Log).

---

## Quick Start / Cara Menjalankan Aplikasi

### Pilihan A: Menggunakan Docker Compose (Rekomendasi)
```bash
docker-compose up -d --build
```
- URL Aplikasi Publik: `http://localhost:8080/`
- URL Dashboard Admin: `http://localhost:8080/admin`

### Pilihan B: Menggunakan Laragon / XAMPP
1. Pastikan Web Server Apache & MySQL aktif (PHP 7.4 - 8.2+).
2. Impor database SQL dari `database/schema.sql` dan `database/seeds/initial_seeds.sql` ke MySQL.
3. Akses URL:
   - URL Aplikasi Publik: `http://localhost/nomadenstuff/`
   - URL Dashboard Admin: `http://localhost/nomadenstuff/admin`
