<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDeliveryProofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_delivery_proofs', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->boolean('after_load')->default(false);
            $table->boolean('after_unload')->default(false);
            $table->string('proof_image');
            $table->timestamps();
            
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
        Schema::dropIfExists('request_delivery_proofs');
    }
}
