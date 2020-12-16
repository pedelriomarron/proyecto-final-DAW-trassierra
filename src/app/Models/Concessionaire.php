<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concessionaire extends Model
{

    protected $table = 'concessionaires';
    public $timestamps = true;
    protected $casts = [];
    protected $guarded = ['id'];



    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function findOrCreate($id)
    {
        $obj = static::where('user_id', $id)->first();
        return $obj ?: new static;
    }
}
