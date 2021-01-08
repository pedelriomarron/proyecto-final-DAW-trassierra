<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use App\Models\Bodystyle;
use App\Models\Segment;
use App\Models\Drive;
use App\Models\Brand;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;
use Illuminate\Support\Str;




$factory->define(Car::class, function (Faker $faker) {


    $seat = [2, 4, 5, 7];



    return [
        // 'status' => rand(0, 1),
        'segment_id' => Segment::all()->random()->id,
        'bodystyle_id' => Bodystyle::all()->random()->id,
        'brand_id' => Brand::all()->random()->id,
        'drive_id' => Drive::all()->random()->id,
        "name" => $faker->word,
        'range_city_cold' => rand(100, 600),
        'range_city_mild' => rand(100, 600),
        'range_highway_cold' => rand(100, 600),
        'range_highway_mild' => rand(100, 600),
        'range_combined_cold' => rand(100, 600),
        'range_combined_mild' => rand(100, 600),

        'acceleration' => rand(5, 17),

        'topspeed' => rand(111, 448),
        'totalpower' => rand(2, 300),
        'totaltorque' => rand(100, 500),

        'batterycapacity' => rand(10, 200),
        'batteryuseable' => rand(10, 200),

        'realrange' => rand(5, 1200),
        'realco2emissions' => rand(0, 100),
        'realconsumption' => rand(100, 300),
        'realfuelequivalent' => rand(1, 15),

        'wltprange' => rand(5, 1200),
        'wltpco2emissions' => rand(0, 100),
        'wltpconsumption' => rand(100, 300),
        'wltpfuelequivalent' => rand(1, 15),

        'energy_city_cold' => rand(100, 600),
        'energy_city_mild' => rand(100, 600),
        'energy_highway_cold' => rand(100, 600),
        'energy_highway_mild' => rand(100, 600),
        'energy_combined_cold' => rand(100, 600),
        'energy_combined_mild' => rand(100, 600),

        'length' => rand(1000, 6000),
        'width' => rand(1000, 4000),
        'height' => rand(1000, 3000),
        'wheelbase' => rand(1000, 5000),
        'weightunladen' => rand(1000, 6000),
        'gvwr' => rand(1000, 6000),

        'cargovolume' => rand(100, 500),
        'cargovolumemax' => rand(400, 12000),
        'towingweightunbraked' => rand(0, 100),
        'towingweightbraked' => rand(0, 100),
        'roofload' => rand(0, 100),
        'maxpayload' => rand(100, 1000),


        'seat' => Arr::random($seat),
        'isofix' => rand(0, 3),
        'turningcircle' => rand(3, 20),

        'youtube' => "https://www.youtube.com/watch?v=-5hDXft4-C4",









    ];
});
