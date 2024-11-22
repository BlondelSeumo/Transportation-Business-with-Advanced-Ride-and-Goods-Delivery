<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypesForShortDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vehicle_types')) {
            if (!Schema::hasColumn('vehicle_types', 'short_description')) {
                Schema::table('vehicle_types', function (Blueprint $table) {
                    $table->text('short_description')->after('description')->nullable();
                    
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
