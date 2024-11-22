<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsBillTableForWaitingTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('request_bills')) {
            if (!Schema::hasColumn('request_bills', 'before_trip_start_waiting_time')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->integer('before_trip_start_waiting_time')->after('time_price')->default(0);
                });
            }
             if (!Schema::hasColumn('request_bills', 'after_trip_start_waiting_time')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->integer('after_trip_start_waiting_time')->after('time_price')->default(0);
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
