<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriversForMyRouteBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('drivers')) {
            if (!Schema::hasColumn('drivers', 'route_coordinates')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->lineString('route_coordinates')->after('vehicle_type')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'my_route_address')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->string('my_route_address')->after('route_coordinates')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'my_route_lat')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->double('my_route_lat',15,8)->after('my_route_address')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'my_route_lng')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->double('my_route_lng',15,8)->after('my_route_lat')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'enable_my_route_booking')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->boolean('enable_my_route_booking')->after('my_route_lng')->default(0);
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
