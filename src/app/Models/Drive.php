<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{

    protected $table = 'drives';
    public $timestamps = true;
    protected $casts = [];
    protected $fillable = [
        'name', 'logo'
    ];

    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }
}
