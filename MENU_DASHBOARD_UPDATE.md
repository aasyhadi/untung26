Perubahan utama versi ini:
- Menu admin disederhanakan.
- Konten Website sekarang hanya berisi:
  - Master Artikel
  - Master Produk
  - Jadwal Pelatihan
  - Pengaturan Website
- Parent menu Layanan & Materi dihapus.
- Menu dan route admin Order eBook dihapus.
- Route admin Buku / Template / Modul PPT disembunyikan dari struktur aktif.
- Dashboard admin diisi ringkasan statistik, quick actions, lead terbaru, artikel terbaru, produk terbaru, dan jadwal terdekat.
- Halaman master artikel dirapikan dan diberi fallback error DataTable.

Saran update lokal:
1. composer install
2. php artisan key:generate
3. php artisan storage:link
4. php artisan migrate:fresh --seed
5. logout lalu login lagi ke /login

Jika tidak ingin migrate:fresh, minimal jalankan:
- php artisan db:seed --class=MenuSeeder
- php artisan db:seed --class=RoleMenuSeeder
Lalu logout-login agar session menu terbangun ulang.
