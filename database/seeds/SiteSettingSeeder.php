<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('site_settings')->count() > 0) {
            return;
        }

        DB::table('site_settings')->insert([
            'site_name' => 'Untung Yasril',
            'site_domain_text' => 'untungyasril.com',
            'lokasi' => 'Kota Jambi, Indonesia',
            'email' => 'untunguy29@gmail.com',
            'whatsapp_number' => '6281234567890',
            'whatsapp_default_message' => 'Halo Pak Untung, saya ingin berkonsultasi.',
            'hero_title' => 'Solusi jasa konstruksi yang lebih rapi, aman, dan menguntungkan.',
            'hero_subtitle' => 'Mendampingi pelaku jasa konstruksi, instansi, mahasiswa, dan umum melalui konsultasi, pelatihan, sertifikasi, serta materi pendukung yang aplikatif.',
            'profil_ringkas' => 'Konsultan konstruksi profesional yang fokus pada konsultasi, pelatihan, sertifikasi, dan pendampingan teknis.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
