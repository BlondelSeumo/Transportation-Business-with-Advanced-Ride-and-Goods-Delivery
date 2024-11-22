<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsTableForInstantRide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'instant_ride')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('instant_ride')->after('is_later')->default(false);
                    
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
