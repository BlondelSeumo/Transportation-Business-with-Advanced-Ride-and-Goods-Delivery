<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsTableForEtaAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'request_eta_amount')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->double('request_eta_amount',15,2)->after('is_paid')->default(0);
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
