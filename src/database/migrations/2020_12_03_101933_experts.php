<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Experts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('experts', function (Blueprint $table) {
            $table->increments('id');  
            $table->foreignId('brand_id')
                    ->index()
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('user_id')
                    ->index()
                    ->constrained()
                    ->onDelete('cascade');
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
        Schema::dropIfExists('experts');
    }
}
