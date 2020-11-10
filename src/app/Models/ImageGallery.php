<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    //
    protected $table = 'image_gallery';


    protected $fillable = ['title', 'image', 'order', 'car_id'];


    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->order = ImageGallery::getLastOrderforCar($query->car_id);
        });
    }

    protected static function getLastOrderforCar($id)
    {
        $img = ImageGallery::where('car_id', $id)
            ->orderBy('order', 'desc')
            ->first();
        if ($img) {
            return $img->attributes['order'] + 1;
        } else {
            return 0;
        }
    }
}
