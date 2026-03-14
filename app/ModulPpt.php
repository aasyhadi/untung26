<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulPpt extends Model
{
    protected $table = 'modulppt'; // Sesuaikan dengan tabel di database
    protected $fillable = [
        'id_modul',
        'nama_modul',
        'harga',
        'deskripsi',
        'type_file',
        'cover',
        'modul_link',
        'landing_page_link',
        'uuid'
    ];
}
