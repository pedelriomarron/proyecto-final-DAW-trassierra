<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'name', 'logo', 'slug'
    ];

    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }

      public function experts()
    {
        return $this->hasMany('App\Models\Expert');
    }
}
