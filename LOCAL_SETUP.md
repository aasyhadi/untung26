# Setup lokal

1. Copy environment:
   `cp .env.example .env`
2. Atur database di `.env`.
3. Pastikan driver file system public aktif:
   `FILESYSTEM_DRIVER=public`
4. Atur nomor WhatsApp situs di `.env`:
   `SITE_WHATSAPP_NUMBER=6281234567890`
5. Install dependency:
   `composer install`
6. Generate key:
   `php artisan key:generate`
7. Buat symbolic link storage:
   `php artisan storage:link`
8. Migrasi dan seed:
   `php artisan migrate:fresh --seed`
9. Jalankan server:
   `php artisan serve`

## Akun admin awal
- username: `admin`
- password: `Admin123!`

## URL publik
- Beranda publik: `/`
- Dashboard admin: `/dashboard`
- Artikel: `/artikel`
- Produk: `/produk`

## URL admin
- Login: `/login`
