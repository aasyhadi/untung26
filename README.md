# Untung25 schema + seed pack

Paket ini berisi:
- migration full untuk tabel yang benar-benar terdeteksi dari repo
- seeder awal supaya aplikasi bisa langsung login dan sidebar admin bisa tampil

## Seeder yang disertakan
- `AdminUserSeeder`
- `RoleSeeder`
- `MenuSeeder`
- `RoleMenuSeeder`
- `UserRoleSeeder`
- `SubKategoriSeeder`

## Kredensial awal
- username: `admin`
- password: `Admin123!`

Segera ganti password setelah login pertama.

## Urutan pakai
1. Ganti folder `database/migrations` dengan migration dari paket ini.
2. Tambahkan isi folder `database/seeds` dari paket ini.
3. Jalankan:

```bash
php artisan migrate:fresh --seed
```

Kalau tidak ingin hapus semua data, jalankan:

```bash
php artisan migrate
php artisan db:seed
```

## Menu yang diseed
Hanya menu admin yang benar-benar aktif dan punya controller/view yang ada:
- setting-menu
- setting-role
- master-buku
- master-form-template
- master-modul-ppt
- jadwal-pelayanan
- order-konsultasi
- konsul-terjawab
- order-ebook

Menu yang belum selesai di repo asli sengaja tidak diseed:
- kirim-ebook
- order-template
- kirim-template
- order-modul
- kirim-modul

## Catatan
- Seeder ini idempotent secara praktis: aman dijalankan ulang karena memakai cek data yang sudah ada.
- Role default hanya `Administrator` (id_role = 1) karena helper akses di repo menganggap role 1 sebagai admin sistem.
- `sub_kategori` hanya diisi data yang dipakai view jadwal pelatihan (`id_kategori = 2`).
