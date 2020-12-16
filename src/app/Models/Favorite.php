<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $table = 'favorites';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'user_id', 'car_id'
    ];
    public function car()
    {
        return $this->belongsTo('App\Models\Brand', 'car_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function findOrCreate($id, $userId)
    {
        $obj = static::where([
            ['car_id', '=', $id],
            ['user_id', '=', $userId]
        ])->first();
        //return $obj ?: new static;
        return $obj ?: false;
    }
}
