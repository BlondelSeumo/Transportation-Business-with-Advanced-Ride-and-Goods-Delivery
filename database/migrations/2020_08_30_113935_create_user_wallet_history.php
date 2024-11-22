<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('user_id');
            $table->uuid('card_id')->nullable();
            $table->uuid('request_id')->nullable();
            $table->string('refferal_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->double('amount', 10, 2)->default(0);
            $table->string('conversion')->nullable();
            $table->string('merchant')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('is_credit')->default(0);
            $table->uuid('admin_id')->nullable();
            $table->timestamps();

            $table->foreign('card_id')
                    ->references('id')
                    ->on('card_info')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('admin_id')
                    ->references('id')
                    ->on('admin_details')
                    ->onDelete('cascade');

            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wallet_history');
    }
}
