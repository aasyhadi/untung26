<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    protected $fillable = [
        'tanggal',
        'nama',
        'whatsapp',
        'email',
        'pertanyaan',
        'jawaban',
        'status',
        'created_at',
        'updated_at',
        'uuid'
    ];
}
