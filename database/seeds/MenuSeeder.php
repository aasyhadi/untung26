<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $obsoleteUrls = [
            'master-buku',
            'master-form-template',
            'master-modul-ppt',
            'order-ebook',
        ];

        DB::table('menu')->whereIn('url', $obsoleteUrls)->delete();
        DB::table('menu')->where('id_menu_induk', 0)->where('nama_menu', 'Layanan & Materi')->delete();

        $parents = [
            ['nama_menu' => 'Konten Website', 'urutan' => 1, 'icon' => 'layout'],
            ['nama_menu' => 'Transaksi & Interaksi', 'urutan' => 2, 'icon' => 'message-circle'],
            ['nama_menu' => 'Pengaturan Sistem', 'urutan' => 3, 'icon' => 'settings'],
        ];

        $parentIds = [];
        foreach ($parents as $parent) {
            $existing = DB::table('menu')
                ->where('id_menu_induk', 0)
                ->where('nama_menu', $parent['nama_menu'])
                ->first();

            if (!$existing) {
                $id = DB::table('menu')->insertGetId([
                    'id_menu_induk' => 0,
                    'nama_menu' => $parent['nama_menu'],
                    'url' => null,
                    'urutan' => $parent['urutan'],
                    'icon' => $parent['icon'],
                    'uuid' => (string) Str::uuid(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            } else {
                DB::table('menu')->where('id_menu', $existing->id_menu)->update([
                    'urutan' => $parent['urutan'],
                    'icon' => $parent['icon'],
                    'updated_at' => $now,
                ]);
                $id = $existing->id_menu;
            }

            $parentIds[$parent['nama_menu']] = $id;
        }

        $children = [
            ['parent' => 'Konten Website', 'nama_menu' => 'Master Artikel', 'url' => 'master-artikel', 'urutan' => 1],
            ['parent' => 'Konten Website', 'nama_menu' => 'Master Produk', 'url' => 'master-produk', 'urutan' => 2],
            ['parent' => 'Konten Website', 'nama_menu' => 'Jadwal Pelatihan', 'url' => 'jadwal-pelayanan', 'urutan' => 3],
            ['parent' => 'Konten Website', 'nama_menu' => 'Pengaturan Website', 'url' => 'pengaturan-website', 'urutan' => 4],

            ['parent' => 'Transaksi & Interaksi', 'nama_menu' => 'Order Konsultasi', 'url' => 'order-konsultasi', 'urutan' => 1],
            ['parent' => 'Transaksi & Interaksi', 'nama_menu' => 'Konsultasi Terjawab', 'url' => 'konsul-terjawab', 'urutan' => 2],

            ['parent' => 'Pengaturan Sistem', 'nama_menu' => 'Setting Menu', 'url' => 'setting-menu', 'urutan' => 1],
            ['parent' => 'Pengaturan Sistem', 'nama_menu' => 'Setting Role', 'url' => 'setting-role', 'urutan' => 2],
        ];

        foreach ($children as $child) {
            $existing = DB::table('menu')
                ->where('id_menu_induk', $parentIds[$child['parent']])
                ->where('nama_menu', $child['nama_menu'])
                ->first();

            $payload = [
                'id_menu_induk' => $parentIds[$child['parent']],
                'nama_menu' => $child['nama_menu'],
                'url' => $child['url'],
                'urutan' => $child['urutan'],
                'icon' => null,
                'updated_at' => $now,
            ];

            if (!$existing) {
                $payload['uuid'] = (string) Str::uuid();
                $payload['created_at'] = $now;
                DB::table('menu')->insert($payload);
            } else {
                DB::table('menu')->where('id_menu', $existing->id_menu)->update($payload);
            }
        }
    }
}
