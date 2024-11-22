<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOwnerCommissionInZoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('zone_types')){
            if(!Schema::hasColumn('zone_types','admin_commission_type_from_owner')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->boolean('admin_commission_type_from_owner')->after('admin_commision')->nullable();
                });
            }
            if(!Schema::hasColumn('zone_types','admin_commission_from_owner')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->double('admin_commission_from_owner',10,2)->after('admin_commission_type_from_owner')->default(0);
                });
            }
            if(!Schema::hasColumn('zone_types','admin_commission_type_from_driver')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->boolean('admin_commission_type_from_driver')->after('admin_commission_from_owner')->nullable();
                });
            }
            if(!Schema::hasColumn('zone_types','admin_commission_from_driver')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->double('admin_commission_from_driver',10,2)->after('admin_commission_type_from_driver')->default(0);
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
        if(Schema::hasTable('zone_types')){
            if(Schema::hasColumn('zone_types','admin_commission_from_owner')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->dropColumn('admin_commission_from_owner');
                });
            }
            if(Schema::hasColumn('zone_types','admin_commission_type_from_owner')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->dropColumn('admin_commission_type_from_owner');
                });
            }
            if(Schema::hasColumn('zone_types','admin_commission_from_driver')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->dropColumn('admin_commission_from_driver');
                });
            }
            if(Schema::hasColumn('zone_types','admin_commission_type_from_driver')) {
                Schema::table('zone_types', function (Blueprint $table) {
                    $table->dropColumn('admin_commission_type_from_driver');
                });
            }
        }
    }
}
