<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableForRefferal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'refferal_code')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('refferal_code')->after('apn_token')->nullable();
                });
            }
        }
        if (Schema::hasTable('user_wallet_history')) {
            if (!Schema::hasColumn('user_wallet_history', 'refferal_code')) {
                Schema::table('user_wallet_history', function (Blueprint $table) {
                    $table->string('refferal_code')->after('request_id')->nullable();
                });
            }
        }
        if (Schema::hasTable('driver_wallet_history')) {
            if (!Schema::hasColumn('driver_wallet_history', 'refferal_code')) {
                Schema::table('driver_wallet_history', function (Blueprint $table) {
                    $table->string('refferal_code')->after('request_id')->nullable();
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
