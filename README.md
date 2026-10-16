# Project Setup

## 1. Requirements

Pastikan perangkat sudah memiliki:

- PHP sesuai versi yang dibutuhkan project
- Composer
- Node.js dan NPM
- Database yang digunakan oleh aplikasi

## 2. Installation

Clone repository dan masuk ke direktori project:

```bash
git clone <repository-url>
cd <project-directory>
```

Install dependencies PHP:

```bash
composer install
```

Install dependencies frontend:

```bash
npm install
```

## 3. Environment Configuration

Salin file environment:

```bash
cp .env.example .env
```

Untuk Windows Command Prompt, gunakan:

```cmd
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Sesuaikan konfigurasi database pada file `.env`.

## 4. Database Migration

Jalankan migration untuk membuat tabel database:

```bash
php artisan migrate
```

## 5. Run Application

Jalankan Vite untuk kebutuhan frontend pada terminal:

```bash
npm run dev
```

Jalankan aplikasi menggunakan **Laravel Herd** dengan langkah berikut:

1. Pastikan Laravel Herd sudah terinstal dan berjalan.
2. Tambahkan direktori project ke Herd atau simpan project di direktori yang sudah terdeteksi oleh Herd.
3. Pastikan konfigurasi `.env` sudah sesuai.
4. Akses aplikasi melalui domain lokal yang disediakan oleh Herd, misalnya:

   `http://nama-project.test`

   atau gunakan HTTPS jika sudah diaktifkan:

   `https://nama-project.test`

**Note:** Gunakan domain lokal Laravel Herd (`.test`) untuk mengakses aplikasi agar konsisten dengan konfigurasi origin dan menghindari masalah CORS akibat perbedaan host atau protokol. Pastikan URL frontend dan backend sesuai dengan konfigurasi aplikasi.

## 6. Alternative Setup

Jika `composer.json` menyediakan script `setup`, proses instalasi dapat dilakukan menggunakan:

```bash
composer run setup
```

Pastikan konfigurasi `.env` dan database sudah sesuai dengan kebutuhan project sebelum menjalankan aplikasi.

---

Developed with Laravel.