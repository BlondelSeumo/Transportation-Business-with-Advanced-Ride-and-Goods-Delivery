<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePackageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('zone_type_package_prices')) {
            if (!Schema::hasColumn('zone_type_package_prices', 'base_price')) {
                Schema::table('zone_type_package_prices', function (Blueprint $table) {
                    $table->double('base_price', 10, 2)->after('zone_type_id')->default(0);
                    
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
