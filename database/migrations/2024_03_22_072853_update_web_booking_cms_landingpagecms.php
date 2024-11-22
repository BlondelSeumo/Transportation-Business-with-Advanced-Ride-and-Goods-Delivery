<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWebBookingCmsLandingpagecms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landingpagecms', function (Blueprint $table) {

            $table->text('web_booking_logo')->nullable();
            $table->text('web_booking_taxi')->nullable();
            $table->text('web_booking_rental')->nullable();
            $table->text('web_booking_delivery')->nullable();
            $table->text('web_booking_history')->nullable();
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
            $table->dropColumn(['web_booking_logo', 'web_booking_taxi', 'web_booking_rental', 'web_booking_delivery', 'web_booking_history']);
        });
    }
}
