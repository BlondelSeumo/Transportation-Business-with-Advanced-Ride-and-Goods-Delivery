<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriversForCustomMakeModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('drivers')) {
            if (!Schema::hasColumn('drivers', 'custom_make')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->string('custom_make')->after('car_make')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'custom_model')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->string('custom_model')->after('car_model')->nullable();
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
