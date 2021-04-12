<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryTravelAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_travel_address', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('travel_address_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_address_id');
            $table->unsignedBigInteger('category_travel_address_id');
            $table->timestamps();

            $table->foreign('travel_address_id')
                ->references('id')
                ->on('travel_address')
                ->onDelete('cascade');

            $table->foreign('category_travel_address_id')
                ->references('id')
                ->on('category_travel_address');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_travel_address');
        Schema::dropIfExists('travel_address_category');
    }
}
