<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_location_id');
            $table->string('code');
            $table->integer('minimum_trip_amount')->default(0);
            $table->integer('maximum_discount_amount')->default(0);
            $table->integer('discount_percent')->default(0);
            $table->integer('total_uses')->default(0);
            $table->integer('uses_per_user')->default(0);
            $table->dateTime('from');
            $table->dateTime('to');
            $table->boolean('active')->default(true);

            $table->timestamps();

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
        Schema::dropIfExists('promo');
    }
}
