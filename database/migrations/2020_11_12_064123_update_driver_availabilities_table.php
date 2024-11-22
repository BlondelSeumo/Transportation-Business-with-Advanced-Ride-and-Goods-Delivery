<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriverAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('driver_availabilities')) {
            if (!Schema::hasColumn('driver_availabilities', 'online_at')) {
                Schema::table('driver_availabilities', function (Blueprint $table) {
                    $table->timestamp('online_at')->after('is_online');
                    $table->timestamp('offline_at')->after('online_at')->nullable();
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
