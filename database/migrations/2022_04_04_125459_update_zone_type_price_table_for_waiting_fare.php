<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZoneTypePriceTableForWaitingFare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('zone_type_price')) {
            if (!Schema::hasColumn('zone_type_price', 'free_waiting_time_in_mins_before_trip_start')) {
                Schema::table('zone_type_price', function (Blueprint $table) {
                    $table->integer('free_waiting_time_in_mins_before_trip_start')->after('price_per_distance')->default(0);
                });
            }
            if (!Schema::hasColumn('zone_type_price', 'free_waiting_time_in_mins_after_trip_start')) {
                Schema::table('zone_type_price', function (Blueprint $table) {
                    $table->integer('free_waiting_time_in_mins_after_trip_start')->after('free_waiting_time_in_mins_before_trip_start')->default(0);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
