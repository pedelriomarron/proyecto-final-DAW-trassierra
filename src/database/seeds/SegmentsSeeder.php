<?php

use Illuminate\Database\Seeder;

class SegmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('segments')->insert([

            [
                'id' => 1,
                'name' => 'Minicompacto',
                'letter' => 'A',
                'logo' => 'a.svg',
            ],
            [
                'id' => 2,
                'name' => 'Subcompacto',
                'letter' => 'B',
                'logo' => 'b.svg',
            ],
            [
                'id' => 3,
                'name' => 'Compacto',
                'letter' => 'C',
                'logo' => 'c.svg',
            ],
            [
                'id' => 4,
                'name' => 'Mediano',
                'letter' => 'D',
                'logo' => 'd.svg',
            ],
            [
                'id' => 5,
                'name' => 'Ejecutivos',
                'letter' => 'E',
                'logo' => 'e.svg',
            ],
            [
                'id' => 6,
                'name' => 'Berlina de lujo',
                'letter' => 'F',
                'logo' => 'f.svg',
            ],
            [
                'id' => 7,
                'name' => 'Comercial',
                'letter' => 'M',
                'logo' => 'm.svg',
            ],
            [
                'id' => 8,
                'name' => 'Deportivo',
                'letter' => 'S',
                'logo' => 's.svg',
            ],
        ]);
    }
}
