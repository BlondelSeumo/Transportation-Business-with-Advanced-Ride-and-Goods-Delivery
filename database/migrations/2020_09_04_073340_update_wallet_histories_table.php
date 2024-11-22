<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('driver_wallet_history')) {
            if (!Schema::hasColumn('driver_wallet_history', 'is_credit')) {
                Schema::table('driver_wallet_history', function (Blueprint $table) {
                    $table->boolean('is_credit')->after('remarks')->default(0);
                });
            }
        }
        if (Schema::hasTable('user_wallet_history')) {
            if (!Schema::hasColumn('user_wallet_history', 'is_credit')) {
                Schema::table('user_wallet_history', function (Blueprint $table) {
                    $table->boolean('is_credit')->after('remarks')->default(0);
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
