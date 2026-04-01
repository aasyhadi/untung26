<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukViewLog extends Model
{
    protected $table = 'produk_view_logs';

    protected $fillable = [
        'produk_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    protected $dates = ['viewed_at'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
