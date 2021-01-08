<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $cars = factory(App\Car::class, 20)->create();
        $cars->each(function ($car) {


            DB::table('image_gallery')->insert([['car_id' => $car->id, "title" => "_", "order" => 0, "image" => str_pad(rand(11, 99), 5, "0", STR_PAD_LEFT) . ".jpg"]]);
        });
    }
}
