<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZoneTypePackagePricesTableForZoneId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('zone_type_package_prices')) {
            if (!Schema::hasColumn('zone_type_package_prices', 'zone_id')) {
                Schema::table('zone_type_package_prices', function (Blueprint $table) {
                    $table->uuid('zone_id')->after('zone_type_id')->nullable();
                    $table->foreign('zone_id')
                    ->references('id')
                    ->on('zones')
                    ->onDelete('cascade');
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

