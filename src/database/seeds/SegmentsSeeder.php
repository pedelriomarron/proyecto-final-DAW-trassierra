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
                'name' => 'Coche de ciudad/Minicompacto',
                'letter' => 'A',
                'logo' => 'a.svg',
            ],
            [
                'id' => 2,
                'name' => 'Supermini/Subcompacto',
                'letter' => 'B',
                'logo' => 'b.svg',
            ],
            [
                'id' => 3,
                'name' => 'Compacto/Familiar pequeño',
                'letter' => 'C',
                'logo' => 'c.svg',
            ],
            [
                'id' => 4,
                'name' => 'Compacto/Mediano',
                'letter' => 'D',
                'logo' => 'd.svg',
            ],
            [
                'id' => 5,
                'name' => 'Ejecutivos/Automóvil largo',
                'letter' => 'E',
                'logo' => 'e.svg',
            ],
            [
                'id' => 6,
                'name' => 'Berlina de lujo/Largo de lujo',
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
