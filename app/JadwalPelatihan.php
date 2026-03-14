<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelatihan extends Model
{

    protected $table = 'jadwal_pelatihan'; // Sesuaikan dengan tabel di database
    protected $fillable = [
        'nama_pelatihan',
        'tanggal',
        'durasi',
        'narasumber',
        'biaya',
        'lokasi',
        'metode',
        'deskripsi',
        'cover',
        'link_pendaftaran',
        'uuid'
    ];
}
