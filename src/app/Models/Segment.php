<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{

    protected $table = 'segments';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'name', 'logo', 'letter'
    ];
}
