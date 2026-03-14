<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'ulasan',
        'harga',
        'nomor_wa_order',
        'foto',
        'status',
        'urutan',
        'uuid',
    ];
}
