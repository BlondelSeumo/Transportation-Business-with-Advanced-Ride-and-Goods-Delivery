<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFleetForCustomMakeAndModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('fleets')) {
            if (!Schema::hasColumn('fleets', 'custom_make')) {
                Schema::table('fleets', function (Blueprint $table) {
                    $table->string('custom_make')->after('brand')->nullable();
                });
            }
            if (!Schema::hasColumn('fleets', 'custom_model')) {
                Schema::table('fleets', function (Blueprint $table) {
                    $table->string('custom_model')->after('model')->nullable();
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
