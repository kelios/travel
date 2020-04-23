<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TravelsCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_country', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->integer('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });

        Schema::create('travel_city', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_city');
        Schema::dropIfExists('travel_country');
    }
}
