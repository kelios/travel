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
            $table->string('name')->nullable();
            $table->unsignedInteger('budget')->nullable()->index();
            $table->unsignedInteger('year')->nullable()->index();
            $table->unsignedInteger('number_peoples')->nullable()->index();
            $table->unsignedInteger('number_days')->nullable()->index();
            $table->text('minus')->nullable();
            $table->text('plus')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('description')->nullable();
            $table->boolean('publish')->default(false);
            $table->boolean('visa')->default(false);
            $table->timestamps();
        });

        Schema::create('travel_user', function (Blueprint $table) {
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

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('travel_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });

        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('travel_transport', function (Blueprint $table) {
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
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('travel_complexity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('complexity_id');
            $table->timestamps();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels');

            $table->foreign('complexity_id')
                ->references('id')
                ->on('complexity');
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

        Schema::dropIfExists('travel_user');

        Schema::dropIfExists('categories');
        Schema::dropIfExists('travel_category');

        Schema::dropIfExists('transport');
        Schema::dropIfExists('travel_transport');

        Schema::dropIfExists('complexity');
        Schema::dropIfExists('travel_complexity');

    }
}
