<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug', 'produk', 'deskripsi', 'harga', 'total_transaksi'
    ];

    protected $hidden = [];
}
