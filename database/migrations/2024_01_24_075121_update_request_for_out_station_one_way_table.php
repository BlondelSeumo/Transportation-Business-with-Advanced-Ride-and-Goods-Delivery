<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestForOutStationOneWayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'is_round_trip')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_round_trip')->after('return_time')->nullable();
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
