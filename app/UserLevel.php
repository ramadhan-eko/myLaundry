<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLevel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'level','point_cuci', 'diskon'
    ];

    protected $hidden = [];

}