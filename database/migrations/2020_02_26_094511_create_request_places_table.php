<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_places', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->double('pick_lat', 15, 8)->nullable();
            $table->double('pick_lng', 15, 8)->nullable();
            $table->double('drop_lat', 15, 8)->nullable();
            $table->double('drop_lng', 15, 8)->nullable();
            $table->longText('request_path')->nullable();
            $table->string('pick_address')->nullable();
            $table->string('drop_address')->nullable();
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
        Schema::dropIfExists('request_places');
    }
}
