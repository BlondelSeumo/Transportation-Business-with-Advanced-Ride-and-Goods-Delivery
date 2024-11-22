<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverRejectedRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_rejected_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->unsignedInteger('driver_id');
            $table->boolean('is_after_accept')->default(false);
            $table->uuid('reason')->nullable();
            $table->string('custom_reason')->nullable();
            $table->timestamps();

            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
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
        Schema::dropIfExists('driver_rejected_requests');
    }
}
