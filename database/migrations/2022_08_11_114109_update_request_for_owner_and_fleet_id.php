<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestForOwnerAndFleetId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'owner_id')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->uuid('owner_id')->after('driver_id')->nullable();

                    $table->foreign('owner_id')
                    ->references('id')
                    ->on('owners')
                    ->onDelete('cascade');

                });
            }
             if (!Schema::hasColumn('requests', 'fleet_id')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->uuid('fleet_id')->after('driver_id')->nullable();

                    $table->foreign('fleet_id')
                    ->references('id')
                    ->on('fleets')
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
