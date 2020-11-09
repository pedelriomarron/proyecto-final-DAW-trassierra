<?php

use Illuminate\Database\Seeder;

class BodystylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        DB::table('bodystyles')->insert([

            [
                'id' => 1,
                'name' => 'Hatchback',
                'logo' => 'hatchback.svg',
            ],
            [
                'id' => 2,
                'name' => 'Sedán',
                'logo' => 'sedan.svg',
            ],
            [
                'id' => 3,
                'name' => 'SUV',
                'logo' => 'suv.svg',
            ],
            [
                'id' => 4,
                'name' => 'Monovolumen',
                'logo' => 'mpv.svg',
            ],
            [
                'id' => 5,
                'name' => 'Ranchera',
                'logo' => 'station.svg',
            ],
            [
                'id' => 6,
                'name' => 'Descapotable',
                'logo' => 'cabriolet.svg',
            ],
            [
                'id' => 7,
                'name' => 'Furgoneta',
                'logo' => 'smallvan.svg',
            ],
            [
                'id' => 8,
                'name' => 'Camioneta',
                'logo' => 'pickuptrack.svg',
            ],
        ]);
    }
}
