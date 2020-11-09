<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([

            [
                'id' => 1,
                'name' => 'Aiways',
                'slug' => 'aiways',
                'logo' => 'aiways.svg',
            ],
            [
                'id' => 2,
                'name' => 'Audi',
                'slug' => 'audi',
                'logo' => 'audi.svg',
            ],
            [
                'id' => 3,
                'name' => 'BMW',
                'slug' => 'bmw',
                'logo' => 'bmw.svg',
            ],
            [
                'id' => 4,
                'name' => 'Byton',
                'slug' => 'byton',
                'logo' => 'byton.svg',
            ],
            [
                'id' => 5,
                'name' => 'Citroen',
                'slug' => 'citroen',
                'logo' => 'citroen.svg',
            ],
            [
                'id' => 6,
                'name' => 'CUPRA',
                'slug' => 'cupra',
                'logo' => 'cupra.svg',
            ],
            [
                'id' => 7,
                'name' => 'Dacia',
                'slug' => 'dacia',
                'logo' => 'dacia.svg',
            ],
            [
                'id' => 8,
                'name' => 'DS',
                'slug' => 'ds',
                'logo' => 'ds.svg',
            ],
            [
                'id' => 9,
                'name' => 'Fiat',
                'slug' => 'fiat',
                'logo' => 'fiat.svg',
            ],  [
                'id' => 10,
                'name' => 'Ford',
                'slug' => 'ford',
                'logo' => 'ford.svg',
            ],  [
                'id' => 11,
                'name' => 'Honda',
                'slug' => 'honda',
                'logo' => 'honda.svg',
            ],  [
                'id' => 12,
                'name' => 'Hyundai',
                'slug' => 'hyundai',
                'logo' => 'hyundai.svg',
            ],  [
                'id' => 13,
                'name' => 'Jaguar',
                'slug' => 'jaguar',
                'logo' => 'jaguar.svg',
            ],  [
                'id' => 14,
                'name' => 'Kia',
                'slug' => 'kia',
                'logo' => 'kia.svg',
            ],  [
                'id' => 15,
                'name' => 'Lexus',
                'slug' => 'lexus',
                'logo' => 'lexus.svg',
            ],  [
                'id' => 16,
                'name' => 'Lightyear',
                'slug' => 'lightyear',
                'logo' => 'lightyear.svg',
            ],  [
                'id' => 17,
                'name' => 'Lucid',
                'slug' => 'lucid',
                'logo' => 'lucid.svg',
            ],  [
                'id' => 18,
                'name' => 'Mazda',
                'slug' => 'mazda',
                'logo' => 'mazda.svg',
            ],  [
                'id' => 19,
                'name' => 'Mercedes',
                'slug' => 'mercedes',
                'logo' => 'mercedes.svg',
            ],  [
                'id' => 20,
                'name' => 'MG',
                'slug' => 'mg',
                'logo' => 'mg.svg',
            ],  [
                'id' => 21,
                'name' => 'Mini',
                'slug' => 'mini',
                'logo' => 'mini.svg',
            ],  [
                'id' => 22,
                'name' => 'Nissan',
                'slug' => 'nissan',
                'logo' => 'nissan.svg',
            ],  [
                'id' => 23,
                'name' => 'Opel',
                'slug' => 'opel',
                'logo' => 'opel.svg',
            ],  [
                'id' => 24,
                'name' => 'Peugeot',
                'slug' => 'peugeot',
                'logo' => 'peugeot.svg',
            ],  [
                'id' => 25,
                'name' => 'Polestar',
                'slug' => 'polestar',
                'logo' => 'polestar.svg',
            ],  [
                'id' => 26,
                'name' => 'Porsche',
                'slug' => 'porsche',
                'logo' => 'porsche.svg',
            ],  [
                'id' => 27,
                'name' => 'Renault',
                'slug' => 'renault',
                'logo' => 'renault.svg',
            ],  [
                'id' => 28,
                'name' => 'SEAT',
                'slug' => 'seat',
                'logo' => 'seat.svg',
            ],  [
                'id' => 29,
                'name' => 'Skoda',
                'slug' => 'skoda',
                'logo' => 'skoda.svg',
            ],  [
                'id' => 30,
                'name' => 'Smart',
                'slug' => 'smart',
                'logo' => 'smart.svg',
            ],  [
                'id' => 31,
                'name' => 'Sono',
                'slug' => 'sono',
                'logo' => 'sono.svg',
            ],  [
                'id' => 32,
                'name' => 'Tesla',
                'slug' => 'tesla',
                'logo' => 'tesla.svg',
            ],  [
                'id' => 33,
                'name' => 'Volkswagen',
                'slug' => 'volkswagen',
                'logo' => 'volkswagen.svg',
            ],  [
                'id' => 34,
                'name' => 'Volvo',
                'slug' => 'volvo',
                'logo' => 'volvo.svg',
            ],
        ]);
    }
}
