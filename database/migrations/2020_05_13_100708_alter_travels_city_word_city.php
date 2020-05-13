<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTravelsCityWordCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_city', function (Blueprint $table) {
            $table->bigInteger('city_id')->nullable()->unsigned()->change();

            $table->foreign('city_id')
                ->references('id')
                ->on('world_cities');
        });

        Schema::table('travel_country', function (Blueprint $table
        ) {

            $table->bigInteger('country_id')->nullable()->unsigned()->change();

            $table->foreign('country_id')
                ->references('id')
                ->on('world_countries');
        });

        Schema::create('travel_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('coord')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('city_id')
                ->references('id')
                ->on('world_countries');

            $table->foreign('country_id')
                ->references('id')
                ->on('world_cities');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_address');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
    }
}
