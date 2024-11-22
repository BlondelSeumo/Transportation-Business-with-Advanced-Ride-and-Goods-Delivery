<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehicleMakeForToCarMakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable('car_makes')) {
            if (!Schema::hasColumn('car_makes', 'vehicle_make_for')) {
                Schema::table('car_makes', function (Blueprint $table) {
                $table->enum('vehicle_make_for',['taxi','motor_bike','truck'])->after('name')->nullable();
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
        Schema::table('car_makes', function (Blueprint $table) {
            //
        });
    }
}
