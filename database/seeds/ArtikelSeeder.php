<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('artikel')->count() > 0) {
            return;
        }

        DB::table('artikel')->insert([
            'judul' => 'Strategi dasar pengendalian kontrak pekerjaan konstruksi',
            'slug' => 'strategi-dasar-pengendalian-kontrak-pekerjaan-konstruksi',
            'ringkasan' => 'Catatan singkat tentang hal-hal praktis yang perlu diperhatikan saat mengendalikan kontrak pekerjaan konstruksi.',
            'isi_artikel' => 'Pengendalian kontrak pekerjaan konstruksi membutuhkan kedisiplinan pada administrasi, dokumen pendukung, pengukuran progres, dan komunikasi antarpihak. Artikel contoh ini dapat diganti dari akun admin.',
            'foto' => null,
            'teks_foto' => 'Contoh artikel awal',
            'penulis' => 'Untung Yasril',
            'status' => 'publish',
            'published_at' => now(),
            'uuid' => (string) Str::uuid(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
