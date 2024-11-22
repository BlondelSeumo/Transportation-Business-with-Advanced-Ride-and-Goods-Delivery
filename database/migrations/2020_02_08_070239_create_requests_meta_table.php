<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('driver_id');
            $table->boolean('active')->default(0);
            $table->enum('assign_method', [1,2])->comment('1 => one-by-one,2 => all');
            $table->boolean('is_later')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('requests_meta');
    }
}
