<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug', 'kd_promo', 'deskripsi', 'diskon'
    ];

    protected $hidden = [];
}
