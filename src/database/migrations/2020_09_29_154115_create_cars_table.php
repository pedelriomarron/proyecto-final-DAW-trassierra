<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
                ->index()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('bodystyle_id')
                ->index()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('drive_id')
                ->index()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('segment_id')
                ->index()
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');


            $table->integer('range_city_cold');
            $table->integer('range_city_mild');
            $table->integer('range_highway_cold');
            $table->integer('range_highway_mild');
            $table->integer('range_combined_cold');
            $table->integer('range_combined_mild');


            $table->float('acceleration');
            $table->integer('topspeed');
            $table->integer('electricrange');
            $table->integer('totalpower');
            $table->integer('totaltorque');

            $table->integer('batterycapacity');
            $table->integer('batteryuseable');

            $table->integer('realrange');
            $table->integer('realco2emissions');
            $table->integer('realconsumption');
            $table->integer('realfuelequivalent');

            $table->integer('wltprange');
            $table->integer('wltpco2emissions');
            $table->integer('wltpconsumption');
            $table->integer('wltpfuelequivalent');


            $table->integer('energy_city_cold');
            $table->integer('energy_city_mild');
            $table->integer('energy_highway_cold');
            $table->integer('energy_highway_mild');
            $table->integer('energy_combined_cold');
            $table->integer('energy_combined_mild');

            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('wheelbase');
            $table->integer('weightunladen');
            $table->integer('gvwr');

            $table->integer('cargovolume');
            $table->integer('cargovolumemax');
            $table->integer('towingweightunbraked');
            $table->integer('towingweightbraked');
            $table->integer('roofload');
            $table->integer('maxpayload');

            $table->integer('seat');
            $table->integer('isofix');
            $table->integer('turningcircle');
            $table->boolean('roofrails');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
