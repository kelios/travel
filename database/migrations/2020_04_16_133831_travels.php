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
            $table->unsignedInteger('number_peoples')->nullable()->index();
            $table->unsignedInteger('number_days')->nullable()->index();
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

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('category_travel', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('category_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('category_id')
                ->references('id')
                ->on('category_travel');
        });

        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('transport_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('transport_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('transport_id')
                ->references('id')
                ->on('transport');
        });

        Schema::create('complexity', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('complexity_to_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('complexity_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('complexity_id')
                ->references('id')
                ->on('transport');
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

        Schema::dropIfExists('user_to_travel');

        Schema::dropIfExists('category_travel');
        Schema::dropIfExists('category_to_travel');

        Schema::dropIfExists('transport');
        Schema::dropIfExists('transport_to_travel');

        Schema::dropIfExists('complexity');
        Schema::dropIfExists('complexity_to_travel');

    }
}
