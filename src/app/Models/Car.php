<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $table = 'cars';
    public $timestamps = true;
    protected $casts = [];
    protected $guarded = ['id'];

    public function getIMG()
    {
        try {
            $image = ImageGallery::where('car_id', '=', $this->id)->orderBy('order', 'ASC')->first();


            return $image->image;
        } catch (\Throwable $th) {
            return 'default.png';
        }
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function segment()
    {
        return $this->belongsTo('App\Models\Segment', 'segment_id');
    }

    public function bodystyle()
    {
        return $this->belongsTo('App\Models\Bodystyle', 'bodystyle_id');
    }
    public function drive()
    {
        return $this->belongsTo('App\Models\Drive', 'drive_id');
    }
}
