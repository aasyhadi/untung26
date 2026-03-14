<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template'; // Sesuaikan dengan tabel di database
    protected $fillable = [
        'id_template',
        'nama_template',
        'harga',
        'deskripsi',
        'type_file',
        'cover',
        'template_link',
        'landing_page_link',
        'uuid'
    ];
}
