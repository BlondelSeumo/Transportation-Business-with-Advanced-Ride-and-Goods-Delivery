<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCycles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('request_cycles')) {        
        Schema::create('request_cycles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('request_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('driver_id')->nullable();  
            $table->text('request_data');  
            $table->timestamps();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_cycles');
    }
}
