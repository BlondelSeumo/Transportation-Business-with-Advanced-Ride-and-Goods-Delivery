<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsBillForAirportFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('request_bills')) {
            if (!Schema::hasColumn('request_bills', 'airport_surge_fee')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->double('airport_surge_fee',10, 2)->after('time_price')->default(0);
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
