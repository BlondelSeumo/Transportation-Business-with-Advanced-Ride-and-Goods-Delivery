<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypesandtypepriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('vehicle_types')){
            if (Schema::hasColumn('vehicle_types', 'service_location_id'))
            {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->dropForeign('vehicle_types_service_location_id_foreign');
                    $table->dropColumn('service_location_id');
                    // $table->string('service_location_id')->nullable()->change();
                });
            }
        }

        if(Schema::hasTable('zone_types')){
            if (Schema::hasColumn('zone_types', 'payment_type'))
            {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->string('payment_type')->change();
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
