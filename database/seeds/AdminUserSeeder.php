<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $now = now();
        $pegawaiEmail = 'admin@untung25.local';
        $userEmail = 'admin@untung25.local';
        $username = 'admin';

        $pegawai = DB::table('tb_pegawairs')->where('email', $pegawaiEmail)->first();

        if (!$pegawai) {
            $idPegawai = DB::table('tb_pegawairs')->insertGetId([
                'uuid' => (string) Str::uuid(),
                'nama_pegawai' => 'Administrator',
                'email' => $pegawaiEmail,
                'telp' => '081234567890',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $idPegawai = $pegawai->id_pegawai;
            DB::table('tb_pegawairs')->where('id_pegawai', $idPegawai)->update([
                'nama_pegawai' => 'Administrator',
                'telp' => $pegawai->telp ?: '081234567890',
                'updated_at' => $now,
            ]);
        }

        $user = DB::table('users')->where('username', $username)->first();

        if (!$user) {
            DB::table('users')->insert([
                'id_pegawai' => $idPegawai,
                'uuid' => (string) Str::uuid(),
                'username' => $username,
                'nama_pengguna' => 'Administrator',
                'name' => 'Administrator',
                'email' => $userEmail,
                'telp' => '081234567890',
                'avatar' => 'avatars/avatar-5.jpg',
                'password' => Hash::make('Admin123!'),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            DB::table('users')->where('id', $user->id)->update([
                'id_pegawai' => $idPegawai,
                'nama_pengguna' => $user->nama_pengguna ?: 'Administrator',
                'name' => $user->name ?: 'Administrator',
                'email' => $user->email ?: $userEmail,
                'telp' => $user->telp ?: '081234567890',
                'avatar' => $user->avatar ?: 'avatars/avatar-5.jpg',
                'updated_at' => $now,
            ]);
        }
    }
}
