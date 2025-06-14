# Laravel + Vue 3 + Socialite Starter Kit

Starter kit ini menyediakan fondasi untuk proyek Laravel dengan autentikasi Socialite.

**Fitur:**
- Laravel 11
- Vue 3 (via Vite)
- Tailwind CSS
- Laravel Breeze untuk autentikasi email/password
- Laravel Socialite terintegrasi (contoh dengan Google)

## Buat credential OAuth pada Google Cloud Console
1. **Dapatkan Client ID dan Client Secret**
2. **Copy pada .env**
    ```bash
    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=

## Cara Penggunaan

1.  **Gunakan sebagai Template:** Klik tombol "Use this template" di halaman GitHub untuk membuat repositori baru dari template ini.
2.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/USERNAME/NAMA-REPO-BARU.git](https://github.com/USERNAME/NAMA-REPO-BARU.git)
    cd NAMA-REPO-BARU
    ```
3.  **Setup Awal:**
    ```bash
    cp .env.example .env
    composer install
    php artisan key:generate
    ```
4.  **Konfigurasi Database & Socialite:**
    Buka file `.env` dan isi konfigurasi database (`DB_*`) serta kredensial Socialite (`GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`).
5.  **Install Dependensi Frontend & Migrasi:**
    ```bash
    npm install
    php artisan migrate
    ```
6.  **Jalankan Server:**
    ```bash
    # Di terminal 1
    npm run dev
    # Di terminal 2
    php artisan serve
    ```
