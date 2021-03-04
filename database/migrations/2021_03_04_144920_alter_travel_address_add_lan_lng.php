<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTravelAddressAddLanLng extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_address', function (Blueprint $table) {
            $table->decimal('lat', 10, 7)->after('coord')->nullable()->index();
            $table->decimal('lng', 10, 7)->after('coord')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_address', function (Blueprint $table) {
            $table->dropColumn(['lat', 'lng']);
        });
    }
}
