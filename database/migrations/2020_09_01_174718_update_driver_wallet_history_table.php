<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriverWalletHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('driver_wallet_history')) {
            if (!Schema::hasColumn('driver_wallet_history', 'remarks')) {
                Schema::table('driver_wallet_history', function (Blueprint $table) {
                    $table->string('remarks')->after('merchant')->nullable();
                });
            }
        }
        if (Schema::hasTable('user_wallet_history')) {
            if (!Schema::hasColumn('user_wallet_history', 'remarks')) {
                Schema::table('user_wallet_history', function (Blueprint $table) {
                    $table->string('remarks')->after('merchant')->nullable();
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
