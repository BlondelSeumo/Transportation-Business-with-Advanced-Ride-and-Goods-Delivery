<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderToZoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('zone_types')) {
            if (!Schema::hasColumn('zone_types', 'order_number')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->string('order_number')->after('transport_type')->default(1);
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

        if (Schema::hasTable('zone_types')) {
            if (Schema::hasColumn('zone_types', 'order_number')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->dropColumn('order_number');
                });
            }
        }
    }
}
