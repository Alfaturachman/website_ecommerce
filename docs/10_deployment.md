# 10. Deployment, Docker, & CI/CD Pipeline Guide

## 1. Konfigurasi Lingkungan (Environment Configuration)

Aplikasi Nomadenstuff E-Commerce menggunakan berkas `.env` untuk mengisolasi variabel lingkungan sensitif di luar repositori kode.

### Berkas `.env.example`:
```ini
ENVIRONMENT=development

# Database Settings
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=nomadenstuff

# RajaOngkir API Integration
RAJAONGKIR_API_KEY=your_rajaongkir_api_key_here
RAJAONGKIR_ACCOUNT_TYPE=starter

# Application Encryption Key
ENCRYPTION_KEY=supersecret32characterstringkey!!
```

> [!IMPORTANT]
> Salin `.env.example` menjadi `.env` saat pertama kali memasang aplikasi dan pastikan file `.env` tidak pernah dikomit ke Git (`.gitignore`).

---

## 2. Pemasangan Berbasis Docker Containers (Recommended Deployment)

Aplikasi ini sudah dilengkapi dengan konfigurasi **Dockerfile** dan **docker-compose.yml** untuk kemudahan penggelaran (*deployment*) terisolasi.

### A. Berkas `Dockerfile`:
```dockerfile
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Working Directory
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html/

# Set permissions for webserver
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/images

EXPOSE 80
```

---

### B. Berkas `docker-compose.yml`:
```yaml
version: '3.8'

services:
  web:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: nomadenstuff_web
    ports:
      - "8080:80"
    environment:
      ENVIRONMENT: development
      DB_HOST: db
      DB_USER: nomaden_user
      DB_PASS: secret123
      DB_NAME: nomadenstuff
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:8.0
    container_name: nomadenstuff_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: rootsecret
      MYSQL_DATABASE: nomadenstuff
      MYSQL_USER: nomaden_user
      MYSQL_PASSWORD: secret123
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
      - ./database/schema.sql:/docker-entrypoint-initdb.d/1_schema.sql
      - ./database/seeds/initial_seeds.sql:/docker-entrypoint-initdb.d/2_seeds.sql

volumes:
  db_data:
```

---

### C. Perintah Eksekusi Docker Compose:

1. **Menjalankan Containers di Background**:
   ```bash
   docker-compose up -d --build
   ```
2. **Memeriksa Status Containers**:
   ```bash
   docker-compose ps
   ```
3. **Membuka Aplikasi di Browser**:
   - Web App: `http://localhost:8080/`
   - Admin Panel: `http://localhost:8080/admin`
4. **Menghentikan Containers**:
   ```bash
   docker-compose down
   ```

---

## 3. Deployment Standalone Server (Laragon / XAMPP / Apache VPS)

Jika ingin memasang tanpa Docker (misal di server Windows Laragon / Linux Ubuntu Nginx/Apache):

1. **Klon Repositori & Install Dependensi**:
   ```bash
   git clone https://github.com/Alfaturachman/website_ecommerce.git nomadenstuff
   cd nomadenstuff
   composer install
   ```
2. **Konfigurasi Database MySQL**:
   - Impor skema database dari `database/schema.sql`.
   - Impor data awal dari `database/seeds/initial_seeds.sql`.
3. **Pengaturan VirtualHost Apache (`httpd-vhosts.conf`)**:
   ```apache
   <VirtualHost *:80>
       ServerName nomadenstuff.local
       DocumentRoot "d:/laragon/www/nomadenstuff"
       <Directory "d:/laragon/www/nomadenstuff">
           Options Indexes FollowSymLinks MultiViews
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

---

## 4. Pipeline CI/CD (GitHub Actions)

Alur Integrasi Berkelanjutan (CI) dikonfigurasi dalam `.github/workflows/ci.yml`. Setiap ada pergerakan `push` atau `pull_request` ke branch `main` / `master`, GitHub Actions akan menjalankan pengujian otomatis.

### Konfigurasi `.github/workflows/ci.yml`:
```yaml
name: CI Pipeline

on:
  push:
    branches: [ main, master ]
  pull_request:
    branches: [ main, master ]

jobs:
  test:
    name: Build & Run Test Suite
    runs-on: ubuntu-latest

    steps:
      - name: Checkout Codebase
        uses: actions/checkout@v3

      - name: Setup PHP Environment
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, pdo, pdo_mysql, mysqli, gd, zip
          coverage: none

      - name: Validate PHP Syntax (Lint)
        run: |
          find application/ -type f -name "*.php" -exec php -l {} \;
          find system/ -type f -name "*.php" -exec php -l {} \;

      - name: Run Unit and Feature Test Suite
        run: php tests/run_tests.php
```

---

## 5. Security Hardening Panduan Production Deployment

- **Switch Environment**: Ubah `ENVIRONMENT = production` di `.env` atau `index.php` untuk menyembunyikan stack trace error PHP dari publik.
- **Set Directory Permissions**: Folder `images/` diberi permission `755` (`chown -R www-data:www-data images/`).
- **Enforce HTTPS**: Gunakan SSL Certificate (Let's Encrypt / Cloudflare) dan aktifkan `$config['cookie_secure'] = TRUE` di `application/config/config.php`.
