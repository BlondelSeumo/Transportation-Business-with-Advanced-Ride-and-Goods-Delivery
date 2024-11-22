<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('user_id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('country');
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->integer('pincode');
            $table->string('email', 150);
            $table->string('mobile', 14)->unique();
            $table->enum('team', ['android','ios','designing','server','testing']);
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
        Schema::dropIfExists('developers');
    }
}
