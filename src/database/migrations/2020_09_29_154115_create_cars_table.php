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


            $table->integer('range_city_cold')->nullable();
            $table->integer('range_city_mild')->nullable();
            $table->integer('range_highway_cold')->nullable();
            $table->integer('range_highway_mild')->nullable();
            $table->integer('range_combined_cold')->nullable();
            $table->integer('range_combined_mild')->nullable();


            $table->float('acceleration')->nullable();
            $table->integer('topspeed')->nullable();
            $table->integer('electricrange')->nullable();
            $table->integer('totalpower')->nullable();
            $table->integer('totaltorque')->nullable();

            $table->integer('batterycapacity')->nullable();
            $table->integer('batteryuseable')->nullable();

            $table->integer('realrange')->nullable();
            $table->integer('realco2emissions')->nullable();
            $table->integer('realconsumption')->nullable();
            $table->integer('realfuelequivalent')->nullable();

            $table->integer('wltprange')->nullable();
            $table->integer('wltpco2emissions')->nullable();
            $table->integer('wltpconsumption')->nullable();
            $table->integer('wltpfuelequivalent')->nullable();


            $table->integer('energy_city_cold')->nullable();
            $table->integer('energy_city_mild')->nullable();
            $table->integer('energy_highway_cold')->nullable();
            $table->integer('energy_highway_mild')->nullable();
            $table->integer('energy_combined_cold')->nullable();
            $table->integer('energy_combined_mild')->nullable();

            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('wheelbase')->nullable();
            $table->integer('weightunladen')->nullable();
            $table->integer('gvwr')->nullable();

            $table->integer('cargovolume')->nullable();
            $table->integer('cargovolumemax')->nullable();
            $table->integer('towingweightunbraked')->nullable();
            $table->integer('towingweightbraked')->nullable();
            $table->integer('roofload')->nullable();
            $table->integer('maxpayload')->nullable();

            $table->integer('seat')->nullable();
            $table->integer('isofix')->nullable();
            $table->integer('turningcircle')->nullable();
            $table->boolean('roofrails')->nullable();



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
