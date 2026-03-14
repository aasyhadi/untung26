<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $user = DB::table('users')->where('username', 'admin')->first();
        $role = DB::table('role')->where('id_role', 1)->first();

        if (!$user || !$role) {
            throw new RuntimeException('User admin atau role Administrator belum ada.');
        }

        $existing = DB::table('user_role')
            ->where('id_user', $user->id)
            ->where('id_role', $role->id_role)
            ->first();

        if (!$existing) {
            DB::table('user_role')->insert([
                'id_user' => $user->id,
                'id_role' => $role->id_role,
                'uuid' => (string) Str::uuid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
