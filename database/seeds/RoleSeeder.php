<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $role = DB::table('role')->where('id_role', 1)->orWhere('nama_role', 'Administrator')->first();

        if (!$role) {
            DB::table('role')->insert([
                'id_role' => 1,
                'nama_role' => 'Administrator',
                'uuid' => (string) Str::uuid(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            DB::table('role')->where('id_role', $role->id_role)->update([
                'nama_role' => 'Administrator',
                'updated_at' => $now,
            ]);
        }
    }
}
