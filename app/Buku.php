<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku'; // Sesuaikan dengan tabel di database
    protected $fillable = [
        'id_buku',
        'judul',
        'penulis',
        'penerbit',
        'isbn',
        'harga',
        'tahun_terbit',
        'harga_ebook',
        'deskripsi',
        'cover',
        'ebook_link',
        'landing_page_link',
        'uuid'
    ];
}
