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


            $table->integer('range_city_cold')->default('0')->nullable(true);
            $table->integer('range_city_mild')->default('0')->nullable(true);
            $table->integer('range_highway_cold')->default('0')->nullable(true);
            $table->integer('range_highway_mild')->default('0')->nullable(true);
            $table->integer('range_combined_cold')->default('0')->nullable(true);
            $table->integer('range_combined_mild')->default('0')->nullable(true);


            $table->float('acceleration')->default('0')->nullable(true);
            $table->integer('topspeed')->default('0')->nullable(true);
            $table->integer('electricrange')->default('0')->nullable(true);
            $table->integer('totalpower')->default('0')->nullable(true);
            $table->integer('totaltorque')->default('0')->nullable(true);

            $table->float('batterycapacity')->default('0')->nullable(true);
            $table->float('batteryuseable')->default('0')->nullable(true);

            $table->integer('realrange')->default('0')->nullable(true);
            $table->integer('realco2emissions')->default('0')->nullable(true);
            $table->integer('realconsumption')->default('0')->nullable(true);
            $table->float('realfuelequivalent')->default('0')->nullable(true);

            $table->integer('wltprange')->default('0')->nullable(true);
            $table->integer('wltpco2emissions')->default('0')->nullable(true);
            $table->integer('wltpconsumption')->default('0')->nullable(true);
            $table->float('wltpfuelequivalent')->default('0')->nullable(true);


            $table->integer('energy_city_cold')->default('0')->nullable(true);
            $table->integer('energy_city_mild')->default('0')->nullable(true);
            $table->integer('energy_highway_cold')->default('0')->nullable(true);
            $table->integer('energy_highway_mild')->default('0')->nullable(true);
            $table->integer('energy_combined_cold')->default('0')->nullable(true);
            $table->integer('energy_combined_mild')->default('0')->nullable(true);

            $table->integer('length')->default('0')->nullable(true);
            $table->integer('width')->default('0')->nullable(true);
            $table->integer('height')->default('0')->nullable(true);
            $table->integer('wheelbase')->default('0')->nullable(true);
            $table->integer('weightunladen')->default('0')->nullable(true);
            $table->integer('gvwr')->default('0')->nullable(true);

            $table->integer('cargovolume')->default('0')->nullable(true);
            $table->integer('cargovolumemax')->default('0')->nullable(true);
            $table->integer('towingweightunbraked')->default('0')->nullable(true);
            $table->integer('towingweightbraked')->default('0')->nullable(true);
            $table->integer('roofload')->default('0')->nullable(true);
            $table->integer('maxpayload')->default('0')->nullable(true);

            $table->integer('seat')->default('0')->nullable(true);
            $table->integer('isofix')->default('0')->nullable(true);
            $table->integer('turningcircle')->default('0')->nullable(true);
            $table->boolean('roofrails')->default('0');

            $table->string('youtube')->nullable(true);


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
