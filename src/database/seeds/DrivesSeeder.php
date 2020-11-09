<?php

use Illuminate\Database\Seeder;

class DrivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('drives')->insert([

            [
                'id' => 1,
                'name' => 'Delantera',
                'logo' => 'front.svg',
            ],
            [
                'id' => 2,
                'name' => 'Trasera',
                'logo' => 'rear.svg',
            ],
            [
                'id' => 3,
                'name' => 'AWD',
                'logo' => 'awd.svg',
            ],
        ]);
    }
}
