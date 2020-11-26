<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{

    protected $table = 'api';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
