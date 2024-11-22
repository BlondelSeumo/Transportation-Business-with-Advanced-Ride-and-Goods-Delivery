<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneSurgePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_surge_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('zone_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('value')->comment('In percentage');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('zone_id')
                    ->references('id')
                    ->on('zones')
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
        Schema::dropIfExists('zone_surge_prices');
    }
}
