<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommisionTypesToZoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('zone_types')) {
            
            if (!Schema::hasColumn('zone_types', 'admin_commision_type')) {
                Schema::table('zone_types', function (Blueprint $table) {
                  $table->tinyInteger('admin_commision_type')->after('payment_type')->nullable();
                });
            }

            if (!Schema::hasColumn('zone_types', 'admin_commision')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->double('admin_commision',10,2)->after('admin_commision_type')->default(0);
                });
            }
            if (!Schema::hasColumn('zone_types', 'service_tax')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->double('service_tax',10,2)->after('admin_commision')->default(0);
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
        Schema::table('zone_types', function (Blueprint $table) {
            //
        });
    }
}
