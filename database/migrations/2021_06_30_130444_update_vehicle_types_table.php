<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vehicle_types')) {
            if (!Schema::hasColumn('vehicle_types', 'description')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->text('description')->after('capacity')->nullable();
                    
                });
            }
            if (!Schema::hasColumn('vehicle_types', 'supported_vehicles')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->text('supported_vehicles')->after('description')->nullable();
                    
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
