# Sistem Informasi Pengelolaan PKL

Aplikasi web berbasis Laravel untuk membantu sekolah mengelola kegiatan Praktik Kerja Lapangan (PKL) secara terpusat.

Sistem ini menyediakan akses dan fitur berbeda untuk tiga jenis pengguna:

- **Admin**
- **Guru Pembimbing**
- **Siswa**

## Fitur Utama

### Admin

- Melihat dashboard administrasi.
- Mengelola data siswa.
- Mengelola data guru pembimbing.
- Mengelola data tempat PKL atau perusahaan mitra.
- Mengelola dan menyeleksi pengajuan PKL siswa.

### Guru Pembimbing

- Melihat dashboard guru.
- Melihat jurnal PKL siswa.
- Meninjau jurnal PKL.
- Memperbarui status jurnal PKL.
- Memberikan penilaian kepada siswa.
- Melihat, mengubah, dan menghapus penilaian siswa.

### Siswa

- Melihat dashboard siswa.
- Mengajukan tempat PKL.
- Melihat status pengajuan PKL.
- Mengisi jurnal harian PKL.
- Mengubah dan menghapus jurnal.
- Mengunggah foto pendukung jurnal.
- Melihat hasil penilaian PKL.

### Fitur Umum

- Autentikasi pengguna.
- Otorisasi berdasarkan role pengguna.
- Pengelolaan profil pengguna.
- Penyimpanan file menggunakan Laravel Storage.
- Pembuatan dokumen PDF menggunakan Dompdf.
- Dukungan autentikasi sosial menggunakan Laravel Socialite.

## Teknologi yang Digunakan

- PHP `^8.3`
- Laravel `^13.8`
- Blade Template
- Laravel Breeze
- MySQL atau SQLite
- Composer
- Node.js dan npm
- Vite
- Tailwind CSS
- Bootstrap
- Alpine.js
- Laravel Socialite
- barryvdh/laravel-dompdf

## Persyaratan Sistem

Pastikan perangkat telah terpasang:

- PHP 8.3 atau versi lebih baru
- Composer
- Node.js dan npm
- MySQL 8.0 atau SQLite
- Git
- Ekstensi PHP yang dibutuhkan Laravel, seperti:
  - `mbstring`
  - `openssl`
  - `pdo`
  - `pdo_mysql` atau `pdo_sqlite`
  - `tokenizer`
  - `xml`
  - `ctype`
  - `json`
  - `fileinfo`

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/nurulsyafiqa307-wq/sistem_informasi_pengelolaan-pkl.git
cd sistem_informasi_pengelolaan-pkl
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Siapkan File Environment

Salin file `.env.example` menjadi `.env`.

Linux atau macOS:

```bash
cp .env.example .env
```

Windows:

```powershell
copy .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

## Konfigurasi Database

### Menggunakan MySQL

Buat database baru, misalnya:

```sql
CREATE DATABASE jurnal_pkl;
```

Kemudian sesuaikan konfigurasi database pada file `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jurnal_pkl
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi database:

```bash
php artisan migrate
```

Jika diperlukan, repository juga menyediakan file `setup.sql` yang dapat di-import melalui MySQL atau phpMyAdmin untuk menyiapkan struktur dan data contoh.

> Tinjau isi `setup.sql` terlebih dahulu dan jangan menggunakan data demo atau credential bawaan untuk production.

### Menggunakan SQLite

Buat file database SQLite:

Linux atau macOS:

```bash
touch database/database.sqlite
```

Windows PowerShell:

```powershell
New-Item database/database.sqlite -ItemType File
```

Kemudian ubah konfigurasi pada `.env`:

```dotenv
DB_CONNECTION=sqlite
```

Jalankan migrasi:

```bash
php artisan migrate
```

## Install Dependency Frontend

```bash
npm install
```

Untuk membuat asset production:

```bash
npm run build
```

## Storage Link

Buat symbolic link untuk file yang disimpan pada storage publik:

```bash
php artisan storage:link
```

## Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://localhost:8000
```

Untuk menjalankan Vite dalam mode development, buka terminal lain lalu jalankan:

```bash
npm run dev
```

## Menjalankan Seluruh Service Development

Repository menyediakan script Composer untuk menjalankan beberapa service development secara bersamaan:

```bash
composer run dev
```

Script tersebut menjalankan beberapa proses, antara lain:

- Laravel development server
- Queue listener
- Laravel Pail
- Vite development server

## Perintah Penting

### Membersihkan Cache

```bash
php artisan optimize:clear
```

### Menjalankan Migrasi Ulang

```bash
php artisan migrate:fresh
```

> Gunakan perintah ini dengan hati-hati karena akan menghapus seluruh tabel database.

### Menjalankan Seeder

```bash
php artisan db:seed
```

### Menjalankan Test

```bash
php artisan test
```

Atau:

```bash
composer test
```

### Memeriksa Route

```bash
php artisan route:list
```

## Struktur Direktori

```text
app/
├── Http/
│   └── Controllers/
│       ├── Admin/
│       ├── Guru/
│       └── Siswa/
├── Models/
└── Providers/

bootstrap/
config/
database/
├── factories/
├── migrations/
└── seeders/

public/
resources/
├── css/
├── js/
└── views/

routes/
├── auth.php
└── web.php

storage/
tests/
setup.sql
```

## Role Pengguna

Aplikasi menggunakan tiga role utama:

| Role | Keterangan |
|---|---|
| `admin` | Mengelola data utama dan pengajuan PKL |
| `guru` | Membimbing, meninjau jurnal, dan menilai siswa |
| `siswa` | Mengajukan PKL, mengisi jurnal, dan melihat penilaian |

Setiap pengguna harus memiliki role yang sesuai agar dapat mengakses dashboard dan fitur yang tersedia.

## Konfigurasi Environment

Beberapa konfigurasi penting pada file `.env`:

```dotenv
APP_NAME="Sistem Informasi Pengelolaan PKL"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jurnal_pkl
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=local
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Untuk lingkungan production:

```dotenv
APP_ENV=production
APP_DEBUG=false
```

Jangan membagikan atau melakukan commit terhadap file `.env` karena dapat berisi informasi sensitif.

## Data Demo

File `setup.sql` berisi struktur tabel dan data contoh aplikasi, termasuk data pengguna, siswa, guru, tempat PKL, jurnal, pengajuan, dan penilaian.

Gunakan data tersebut hanya untuk kebutuhan development atau demo. Untuk production, buat data dan credential baru yang aman.

## Catatan Keamanan

- Jangan mengaktifkan `APP_DEBUG=true` pada production.
- Jangan menyimpan password atau credential asli di repository.
- Jangan membagikan file `.env`.
- Ganti seluruh credential demo sebelum deployment.
- Pastikan konfigurasi database production menggunakan password yang kuat.
- Validasi file upload sebelum disimpan.
- Gunakan HTTPS pada lingkungan production.
- Jalankan perintah optimasi Laravel setelah konfigurasi production selesai:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Kontribusi

Kontribusi dipersilakan. Untuk berkontribusi:

1. Fork repository.
2. Buat branch baru:

   ```bash
   git checkout -b feature/nama-fitur
   ```

3. Lakukan perubahan yang diperlukan.
4. Jalankan pengujian:

   ```bash
   php artisan test
   ```

5. Commit perubahan:

   ```bash
   git commit -m "feat: menambahkan fitur baru"
   ```

6. Push branch ke repository fork.
7. Buat Pull Request.

## Lisensi

Project ini menggunakan lisensi MIT.
