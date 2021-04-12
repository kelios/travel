<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTravelAddColumnYoutubeLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->string('youtube_link', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->dropColumn(['youtube_link']);
        });
    }
}
