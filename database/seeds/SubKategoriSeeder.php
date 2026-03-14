<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubKategoriSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $items = [
            ['id_kategori' => 2, 'nama_sub_kategori' => 'Online', 'urutan' => 1],
            ['id_kategori' => 2, 'nama_sub_kategori' => 'Offline', 'urutan' => 2],
            ['id_kategori' => 2, 'nama_sub_kategori' => 'Hybrid', 'urutan' => 3],
        ];

        foreach ($items as $item) {
            $existing = DB::table('sub_kategori')
                ->where('id_kategori', $item['id_kategori'])
                ->where('nama_sub_kategori', $item['nama_sub_kategori'])
                ->first();

            $payload = [
                'id_kategori' => $item['id_kategori'],
                'nama_sub_kategori' => $item['nama_sub_kategori'],
                'urutan' => $item['urutan'],
                'is_active' => 1,
                'updated_at' => $now,
            ];

            if (!$existing) {
                $payload['uuid'] = (string) Str::uuid();
                $payload['created_at'] = $now;
                DB::table('sub_kategori')->insert($payload);
            } else {
                DB::table('sub_kategori')->where('id', $existing->id)->update($payload);
            }
        }
    }
}
