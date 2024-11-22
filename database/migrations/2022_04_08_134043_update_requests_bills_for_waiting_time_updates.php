<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsBillsForWaitingTimeUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('request_bills')) {
            if (!Schema::hasColumn('request_bills', 'calculated_waiting_time')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->integer('calculated_waiting_time')->after('time_price')->default(0);
                });
            }
              if (!Schema::hasColumn('request_bills', 'waiting_charge_per_min')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->integer('waiting_charge_per_min')->after('time_price')->default(0);
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
