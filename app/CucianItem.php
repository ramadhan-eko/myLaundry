<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CucianItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_kartu', 'id_service', 'produk', 'harga_satuan', 'quantity', 'total'
    ];

    protected $hidden = [];

    public function getDetailItem()
    {
        return $this->hasMany(ProdukService::class, 'id', 'id_service');
    }
}
