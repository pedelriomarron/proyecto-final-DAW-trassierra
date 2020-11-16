<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $table = 'cars';
    public $timestamps = true;

    protected $casts = [];

    protected $fillable = [
        'name',
        'brand_id',
        'segment_id',
        'drive_id',
        'bodystyle_id'
    ];

    public function getIMG()
    {
        try {
            $image = ImageGallery::where('car_id', '=', $this->id)->orderBy('order', 'ASC')->first();


            return $image->image;
        } catch (\Throwable $th) {
            return 'dd';
        }
    }
}
