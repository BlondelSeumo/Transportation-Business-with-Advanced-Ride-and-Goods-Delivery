<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIconTypesForVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vehicle_types')) {
            if (!Schema::hasColumn('vehicle_types', 'icon_types_for')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                       $table->enum('icon_types_for',['taxi','truck' , 'motor_bike'])->after('icon')->nullable();
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
