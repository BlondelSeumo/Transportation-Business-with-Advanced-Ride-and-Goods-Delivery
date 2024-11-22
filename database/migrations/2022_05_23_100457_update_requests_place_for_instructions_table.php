<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsPlaceForInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('request_places')) {
            if (!Schema::hasColumn('request_places', 'pickup_poc_instruction')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('pickup_poc_instruction')->after('pickup_poc_mobile')->nullable();
                });
            }

             if (!Schema::hasColumn('request_places', 'drop_poc_instruction')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('drop_poc_instruction')->after('drop_poc_mobile')->nullable();
                });
            }

        }

         if (Schema::hasTable('request_stops')) {
            if (!Schema::hasColumn('request_stops', 'poc_instruction')) {
                Schema::table('request_stops', function (Blueprint $table) {
                    $table->string('poc_instruction')->after('poc_mobile')->nullable();
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
