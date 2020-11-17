<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bodystyle extends Model
{

    protected $table = 'bodystyles';
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
