<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{

    protected $table = 'experts';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'user_id', 'brand_id'
    ];
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
