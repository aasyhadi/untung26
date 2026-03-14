<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBuku extends Model
{
    protected $table = 'order_ebook';
    protected $fillable = [
        'tanggal',
        'nama',
        'whatsapp',
        'email',
        'nama_ebook',
        'kirim_ebook',
        'status',
        'created_at',
        'updated_at',
        'uuid'
    ];
}
