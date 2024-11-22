<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdhocUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adhoc_users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->string('name', 50);
            $table->string('email', 150)->nullable();
            $table->string('mobile', 14)->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('adhoc_users');
    }
}
