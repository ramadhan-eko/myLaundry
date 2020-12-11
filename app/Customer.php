<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username', 'nama_lengkap', 'alamat', 'hp', 'email', 'id_level', 'point', 'waktu_join'
    ];

    protected $hidden = [];

    public function level_user() {
        return $this->hasOne(UserLevel::class, 'id', 'id_level');
    }
    public function datacuci()
    {
        return $this->hasMany(LaundryCard::class, 'id_pelanggan', 'id');
    }

    public function sedangCuci()
    {
        return $this->hasMany(LaundryCard::class, 'id_pelanggan', 'id')->where('status', 'Cuci');
    }
}
