<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtikelViewLog extends Model
{
    protected $table = 'artikel_view_logs';

    protected $fillable = [
        'artikel_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    protected $dates = ['viewed_at'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }
}
