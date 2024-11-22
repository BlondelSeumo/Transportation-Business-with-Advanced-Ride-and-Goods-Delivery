<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsForOfferredRideFareUpdateUsersForBiddRideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests')) {
            
            if (!Schema::hasColumn('requests', 'offerred_ride_fare')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->double('offerred_ride_fare',15,2)->after('request_eta_amount')->default(0);
                });
            }

            if (!Schema::hasColumn('requests', 'accepted_ride_fare')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->double('accepted_ride_fare',15,2)->after('offerred_ride_fare')->default(0);
                });
            }

            if (!Schema::hasColumn('requests', 'is_bid_ride')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_bid_ride')->after('offerred_ride_fare')->default(false);
                });
            }
            
        }

        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'is_bid_app')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_bid_app')->after('social_provider')->default(false);
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
