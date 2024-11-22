<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodeUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code_users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('promo_code_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->uuid('service_location_id');
            $table->timestamps();

            $table->foreign('promo_code_id')
                    ->references('id')
                    ->on('promo')
                    ->onDelete('cascade');

            $table->foreign('service_location_id')
                    ->references('id')
                    ->on('service_locations')
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
        Schema::dropIfExists('promo_code_users');
    }
}
