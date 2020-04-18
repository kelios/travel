<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TravelsEntity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('month_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('month_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('month_id')
                ->references('id')
                ->on('month');
        });

        Schema::create('over_night_stay', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('over_night_stay_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('over_night_stay_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('over_night_stay_id')
                ->references('id')
                ->on('over_night_stay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('month');
        Schema::dropIfExists('month_to_travel');
        Schema::dropIfExists('over_night_stay');
        Schema::dropIfExists('over_night_stay_to_travel');
    }
}
