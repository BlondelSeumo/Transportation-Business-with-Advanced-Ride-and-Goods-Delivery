<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompletedAtToRequestsStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('request_stops')) {
            if (!Schema::hasColumn('request_stops', 'completed_at')) {
                Schema::table('request_stops', function (Blueprint $table) {
                    $table->timestamp('completed_at')->after('poc_instruction')->nullable();
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
        Schema::table('request_stops', function (Blueprint $table) {
            //
        });
    }
}
