# Sistem Pencatatan Kas (SIA)

Aplikasi berbasis web untuk mengelola dan mencatat transaksi kas masuk, kas keluar, serta rekapitulasi buku besar otomatis yang dibangun menggunakan **Laravel** dan **Bootstrap**.

## 🚀 Fitur Utama
* **Manajemen Kas Masuk & Keluar:** Form input transaksi lengkap dengan nomor referensi unik, tanggal, jumlah, dan keterangan.
* <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/9e147474-147c-4395-9b9d-fdfced8bca9f" />

* **Buku Besar Otomatis (*Ledger*):** Mutasi debit dan kredit tercatat secara otomatis beserta kalkulasi saldo berjalan (*running balance*).
* <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/b07e0fe0-b573-4835-9222-a0db4f2f2745" />

* **Filter Tanggal:** Memfilter riwayat laporan kas sesuai rentang waktu yang diinginkan.
* **Ekspor Laporan:** Mengunduh rekapitulasi buku besar lengkap dengan total akhir langsung ke format spreadsheet (CSV).

---

## 🛠️ Prasyarat (Requirements)
Sebelum melakukan *clone*, pastikan perangkat Anda telah terinstal:
* **PHP** (Versi 8.1 atau yang lebih baru)
* **Composer**
* **Git**
* **MySQL / MariaDB** (melalui Laragon, XAMPP, atau layanan database lainnya)

---

## 📥 Panduan Instalasi & Cloning Project

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

### 1. Clone Repository / download zip
Buka terminal atau command prompt, lalu jalankan perintah berikut untuk mengunduh proyek dari GitHub:
```bash
git clone https://github.com/username-anda/nama-repository.git
```
*(Catatan: Ganti URL di atas dengan link repository GitHub Anda yang sebenarnya)*

atau download zip nya

### 2. Masuk ke Direktori Proyek
```bash
cd nama-repository
```

### 3. Install Dependensi PHP (Composer)
Jalankan perintah ini untuk mengunduh seluruh package yang dibutuhkan oleh Laravel:
```bash
composer install
```

### 4. Konfigurasi File Environment (.env)
* Salin file konfigurasi contoh `.env.example` menjadi `.env`:
  ```bash
  cp .env.example .env
  ```
* Buka file `.env` menggunakan teks editor (seperti VS Code), lalu sesuaikan konfigurasi database Anda:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=db_pencatatan_kas
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### 5. Generate Application Key
Jalankan perintah berikut untuk membuat *encryption key* aplikasi:
```bash
php artisan key:generate
```

### 6. Migrasi Database
Pastikan Anda sudah membuat database kosong (misalnya dengan nama `db_pencatatan_kas`) di MySQL Anda. Setelah itu, jalankan perintah migrasi tabel:
```bash
php artisan migrate
```

### 7. Jalankan Server Lokal
Untuk mulai menjalankan aplikasi di development server lokal, ketik:
```bash
php artisan serve
```

### 8. Akses Aplikasi
Buka browser Anda dan akses tautan berikut:
```text
http://127.0.0.1:8000
```

---

## 👥 Kontributor
Proyek ini dikembangkan untuk kebutuhan Pemrograman Akuntansi. Silakan buat *Pull Request* atau *Issue* jika ada saran pengembangan lebih lanjut.
