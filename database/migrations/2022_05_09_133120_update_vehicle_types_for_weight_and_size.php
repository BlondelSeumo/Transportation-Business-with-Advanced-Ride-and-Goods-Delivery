<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehicleTypesForWeightAndSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vehicle_types')) {
            if (!Schema::hasColumn('vehicle_types', 'size')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->string('size')->after('capacity')->nullable();
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
