<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleMenuSeeder extends Seeder
{
    public function run()
    {
        $role = DB::table('role')->where('id_role', 1)->first();
        if (!$role) {
            throw new RuntimeException('Role Administrator belum ada. Jalankan RoleSeeder terlebih dahulu.');
        }

        $now = now();

        $permissions = [
            'setting-menu' => ['ucc' => 1, 'ucu' => 1, 'ucd' => 1],
            'setting-role' => ['ucc' => 1, 'ucu' => 1, 'ucd' => 1],
            'jadwal-pelayanan' => ['ucc' => 1, 'ucu' => 1, 'ucd' => 1],
            'order-konsultasi' => ['ucc' => 0, 'ucu' => 1, 'ucd' => 0],
            'konsul-terjawab' => ['ucc' => 0, 'ucu' => 1, 'ucd' => 0],
            'master-artikel' => ['ucc' => 1, 'ucu' => 1, 'ucd' => 1],
            'master-produk' => ['ucc' => 1, 'ucu' => 1, 'ucd' => 1],
            'pengaturan-website' => ['ucc' => 0, 'ucu' => 1, 'ucd' => 0],
        ];

        foreach ($permissions as $url => $perm) {
            $menu = DB::table('menu')->where('url', $url)->first();
            if (!$menu) {
                continue;
            }

            $existing = DB::table('role_menu')
                ->where('id_role', $role->id_role)
                ->where('id_menu', $menu->id_menu)
                ->first();

            $payload = [
                'ucc' => $perm['ucc'],
                'ucu' => $perm['ucu'],
                'ucd' => $perm['ucd'],
                'updated_at' => $now,
            ];

            if (!$existing) {
                $payload['id_role'] = $role->id_role;
                $payload['id_menu'] = $menu->id_menu;
                $payload['uuid'] = (string) Str::uuid();
                $payload['created_at'] = $now;
                DB::table('role_menu')->insert($payload);
            } else {
                DB::table('role_menu')->where('id_role_menu', $existing->id_role_menu)->update($payload);
            }
        }
    }
}
