<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'name', 'logo'
    ];
}
