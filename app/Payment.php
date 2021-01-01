<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_payment', 'pelanggan', 'kode_promo', 'diskon', 'kode_kartu', 'waktu_bayar', 'total_cuci', 'total_bayar'
    ];

    protected $hidden = [];
}
