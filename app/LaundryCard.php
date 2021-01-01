<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_kartu', 'id_pelanggan', 'waktu_masuk', 'waktu_selesai', 'waktu_diambil', 'pembayaran', 'status', 'total_harga'
    ];

    protected $hidden = [];

    public function datacuci()
    {
        return $this->belongsTo(Customer::class, 'id_pelanggan', 'id');
    }

    public function sedangCuci()
    {
        return $this->belongsTo(Customer::class, 'id_pelanggan', 'id')->where('status', 'cuci');
    }

    public function itemCucian()
    {
        return $this->belongsTo(CucianItem::class, 'kode_kartu', 'kode_kartu');
    }
}
