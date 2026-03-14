<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('produk')->count() > 0) {
            return;
        }

        DB::table('produk')->insert([
            'judul' => 'Buku Pengendalian Kontrak Konstruksi',
            'slug' => 'buku-pengendalian-kontrak-konstruksi',
            'ringkasan' => 'Produk contoh untuk demo katalog dan order via WhatsApp.',
            'ulasan' => 'Produk ini dirancang sebagai contoh katalog publik. Silakan ubah judul, foto, harga, dan ulasannya dari akun admin.',
            'harga' => 150000,
            'nomor_wa_order' => normalize_wa_number(site_setting('whatsapp_number')),
            'foto' => null,
            'status' => 'publish',
            'urutan' => 1,
            'uuid' => (string) Str::uuid(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
