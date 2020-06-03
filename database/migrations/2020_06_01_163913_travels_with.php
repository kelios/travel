<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TravelsWith extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companion', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('travel_companion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('travel_companion_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('travel_companion_id')
                ->references('id')
                ->on('companion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_companion');
        Schema::dropIfExists('companion');

    }
}
