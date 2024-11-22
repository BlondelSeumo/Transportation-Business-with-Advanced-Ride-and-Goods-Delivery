<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->double('pick_lat', 15, 8)->nullable();
            $table->double('pick_lng', 15, 8)->nullable();
            $table->double('drop_lat', 15, 8)->nullable();
            $table->double('drop_lng', 15, 8)->nullable();
            $table->string('pick_address')->nullable();
            $table->string('drop_address')->nullable();
            $table->string('address_name')->nullable();
            $table->string('landmark')->nullable();

            $table->timestamps();

             $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('favourite_locations');
    }
}
