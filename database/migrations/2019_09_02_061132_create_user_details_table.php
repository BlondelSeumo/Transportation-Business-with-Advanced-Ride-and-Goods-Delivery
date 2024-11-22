<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('mobile');
            $table->string('email', 150);
            $table->string('address', 500)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->unsignedInteger('country');
            $table->string('country_code')->nullable();
            $table->enum('gender', ['male','fe-male','others']);
            $table->string('profile')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('token_expiry')->nullable();
            $table->string('device_token')->nullable();
            $table->string('login_by')->nullable();

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');


            $table->foreign('country')
                    ->references('id')
                    ->on('countries')
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
        Schema::dropIfExists('user_details');
    }
}
