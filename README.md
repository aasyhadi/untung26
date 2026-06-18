# UNTUNG25

Website Konsultasi, Pelatihan, Sertifikasi, Artikel, Produk Digital dan Manajemen Layanan Terintegrasi.

---

## Tentang Aplikasi

UNTUNG25 merupakan aplikasi berbasis web yang digunakan untuk mengelola layanan konsultasi, pelatihan, sertifikasi, publikasi artikel, pemasaran produk digital, dan pengelolaan website dalam satu platform terintegrasi.

Aplikasi dibangun menggunakan framework Laravel dan dirancang agar mudah digunakan oleh administrator maupun pengunjung website.

---

# Fitur Utama

## Website Publik

### Homepage

Menampilkan informasi utama website, layanan, artikel terbaru, dan produk unggulan.

### Profil

Menampilkan profil organisasi, visi, misi, dan informasi pendukung lainnya.

### Artikel

Publikasi artikel, berita, dan informasi edukatif.

### Produk

Katalog produk yang dapat ditampilkan kepada pengunjung.

### Konsultasi Online

Pengunjung dapat mengirimkan pertanyaan atau konsultasi secara online.

### Pelatihan

Informasi program pelatihan yang tersedia.

### Sertifikasi

Informasi layanan sertifikasi.

### Narasumber

Profil narasumber atau tenaga ahli.

### Karya Tulis

Publikasi karya tulis, jurnal, atau dokumen lainnya.

### Hubungi Kami

Formulir kontak dan informasi komunikasi.

---

# Modul Administrator

## Dashboard

Menampilkan ringkasan informasi sistem seperti:

* Jumlah artikel
* Jumlah produk
* Jumlah konsultasi masuk
* Jumlah konsultasi terjawab
* Statistik layanan

---

## Manajemen Artikel

Fitur:

* Tambah artikel
* Edit artikel
* Hapus artikel
* Upload gambar artikel
* Publikasi artikel

---

## Manajemen Produk

Fitur:

* Tambah produk
* Edit produk
* Hapus produk
* Upload gambar produk
* Pengelolaan deskripsi produk

---

## Manajemen Konsultasi

### Order Konsultasi

Menampilkan daftar konsultasi yang masuk dari pengunjung.

Fitur:

* Lihat detail konsultasi
* Memberikan jawaban konsultasi
* Monitoring status konsultasi

### Konsultasi Terjawab

Menampilkan daftar konsultasi yang telah selesai dijawab.

---

## Jadwal Pelayanan

Mengelola jadwal layanan konsultasi atau kegiatan lainnya.

Fitur:

* Tambah jadwal
* Edit jadwal
* Hapus jadwal

---

## Pengaturan Website

Mengelola:

* Nama website
* Logo website
* Informasi kontak
* Sosial media
* Footer website
* Informasi perusahaan

---

## Pengaturan Menu

Mengelola menu aplikasi secara dinamis.

Fitur:

* Tambah menu
* Edit menu
* Hapus menu
* Pengaturan urutan menu

---

## Pengaturan Role dan Hak Akses

Fitur:

* Manajemen role
* Hak akses per menu
* Pengaturan izin pengguna

---

# Teknologi yang Digunakan

## Backend

* PHP
* Laravel
* MySQL

## Frontend

* HTML5
* CSS3
* Bootstrap
* JavaScript
* jQuery

## Library Pendukung

* DataTables
* SweetAlert
* CKEditor
* Laravel Authentication

---

# Struktur Aplikasi

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── FrontPageController
│   │   ├── KonsultasiController
│   │   ├── MasterArtikelController
│   │   ├── MasterProdukController
│   │   ├── OrderKonsultasiController
│   │   ├── KonsulTerjawabController
│   │   ├── JadwalPelayananController
│   │   ├── SettingMenuController
│   │   ├── SettingRoleController
│   │   └── WebsiteSettingController
│
resources/
├── views/
│
routes/
├── web.php
│
database/
├── migrations/
```

---

# Instalasi

## Clone Repository

```bash
git clone https://github.com/your-repository/untung25.git
```

Masuk ke folder project:

```bash
cd untung25
```

---

## Install Dependency

```bash
composer install
```

---

## Copy File Environment

```bash
cp .env.example .env
```

atau pada Windows:

```bash
copy .env.example .env
```

---

## Generate Application Key

```bash
php artisan key:generate
```

---

## Konfigurasi Database

Edit file .env:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=untung25
DB_USERNAME=root
DB_PASSWORD=
```

---

## Jalankan Migration

```bash
php artisan migrate
```

---

## Jalankan Seeder (Jika Ada)

```bash
php artisan db:seed
```

---

## Menjalankan Aplikasi

```bash
php artisan serve
```

Akses melalui:

```text
http://127.0.0.1:8000
```

---

# Hak Akses Sistem

## Administrator

Memiliki akses penuh terhadap seluruh modul.

## Operator

Mengelola data operasional sesuai hak akses.

## Pengguna

Mengakses layanan publik website.

---

# Alur Konsultasi

```text
Pengunjung
    │
    ▼
Mengirim Konsultasi
    │
    ▼
Order Konsultasi
    │
    ▼
Admin Menjawab
    │
    ▼
Konsultasi Terjawab
```

---

# Keamanan Sistem

Menggunakan middleware:

```php
auth.login
auth.menu
```

Fungsi:

* Validasi login pengguna
* Pembatasan akses menu
* Pengaturan hak akses berdasarkan role

---

# Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan:

* Membership Premium
* Ebook Digital
* Modul PPT
* Marketplace Produk Digital
* Payment Gateway
* Integrasi WhatsApp
* Email Notification
* Sistem Lisensi Aplikasi
* Audit Log Aktivitas
* Dashboard Analitik

---

# Lisensi

Copyright © 2026

UNTUNG25

Seluruh hak cipta dilindungi undang-undang.

---

# Support

Jika mengalami kendala penggunaan aplikasi, silakan menghubungi administrator sistem.
