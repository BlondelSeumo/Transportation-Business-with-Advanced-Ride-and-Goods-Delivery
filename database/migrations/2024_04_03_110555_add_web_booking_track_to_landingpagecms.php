<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWebBookingTrackToLandingpagecms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landingpagecms', function (Blueprint $table) {
            $table->text('web_booking_track')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landingpagecms', function (Blueprint $table) {
            $table->dropColumn('web_booking_track');
        });
    }
}
