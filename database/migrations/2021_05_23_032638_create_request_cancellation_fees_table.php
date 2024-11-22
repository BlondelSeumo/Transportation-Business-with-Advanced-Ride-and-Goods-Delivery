<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCancellationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('request_cancellation_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->double('cancellation_fee', 10, 2)->default(0);
            $table->boolean('is_paid')->default(0);
            $table->uuid('paid_request_id')->nullable();
            $table->timestamps();

            $table->foreign('paid_request_id')
                    ->references('id')
                    ->on('requests')
                    ->onDelete('cascade');

            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('driver_id')
                    ->references('id')
                    ->on('drivers')
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
        Schema::dropIfExists('request_cancellation_fees');
    }
}
