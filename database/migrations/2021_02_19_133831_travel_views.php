<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TravelViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("travel_views", function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->string("titleslug");
            $table->string("url");
            $table->string("session_id");
            $table->unsignedInteger('user_id')->nullable();
            $table->string("ip");
            $table->string("agent");
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_views');
    }
}
