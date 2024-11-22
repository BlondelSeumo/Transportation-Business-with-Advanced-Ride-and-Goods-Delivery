<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDispatchTypeToVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vehicle_types')) {
            
            if (!Schema::hasColumn('vehicle_types', 'trip_dispatch_type')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->enum('trip_dispatch_type',['bidding','normal'])->after('icon_types_for')->nullable();
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
        Schema::table('vehicle_types', function (Blueprint $table) {
            //
        });
    }
}
