<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDayToZoneSurgePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('zone_surge_prices')) {
            if (!Schema::hasColumn('zone_surge_prices', 'day')) {
                Schema::table('zone_surge_prices', function (Blueprint $table) {
                    $table->string('day')->after('end_time')->nullable();
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
        Schema::table('zone_surge_prices', function (Blueprint $table) {
            //
        });
    }
}
