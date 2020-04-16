<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Travels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedInteger('budget')->nullable()->index();
        $table->text('minus');
        $table->text('plus');
        $table->text('recommendation');
        $table->text('description');
        $table->boolean('publish')->default(false);
        $table->boolean('visa')->default(false);
        $table->timestamps();
    });

        Schema::create('user_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('trip_id')
                ->references('id')
                ->on('travels');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('category_travel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('publish')->default(true);
            $table->timestamps();
        });

        Schema::create('category_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('trip_id')
                ->references('id')
                ->on('travels');

            $table->foreign('category_id')
                ->references('id')
                ->on('category_travel');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');

        Schema::dropIfExists('');
        Schema::dropIfExists('');
        Schema::dropIfExists('');
    }
}
