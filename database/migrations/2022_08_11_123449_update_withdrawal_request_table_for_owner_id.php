<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWithdrawalRequestTableForOwnerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('wallet_withdrawal_requests')) {
            if (!Schema::hasColumn('wallet_withdrawal_requests', 'owner_id')) {
                Schema::table('wallet_withdrawal_requests', function (Blueprint $table) {
                    $table->uuid('owner_id')->after('driver_id')->nullable();

                    $table->foreign('owner_id')
                    ->references('id')
                    ->on('owners')
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
