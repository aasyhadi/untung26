<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi_artikel',
        'foto',
        'teks_foto',
        'penulis',
        'status',
        'published_at',
        'uuid',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}

