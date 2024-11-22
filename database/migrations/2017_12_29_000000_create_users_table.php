<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('username', 25)->unique()->nullable();
            $table->string('email', 150)->nullable();
            $table->string('password')->nullable();
            $table->string('mobile', 14);
            $table->string('profile_picture')->nullable();
            $table->unsignedInteger('country')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('email_confirmed')->default(false);
            $table->boolean('mobile_confirmed')->default(false);
            $table->string('email_confirmation_token')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('apn_token')->nullable();
            $table->string('refferal_code')->nullable();
            $table->unsignedInteger('referred_by')->nullable();
            $table->float('rating')->default(0);
            $table->string('lang')->nullable();
            $table->float('rating_total')->default(0);
            $table->integer('no_of_ratings')->default(0);
            $table->enum('login_by', ['android','ios'])->nullable();
            $table->rememberToken();
            $table->ipAddress('last_known_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('social_provider')->nullable();
            $table->string('social_nickname')->nullable();
            $table->string('social_id')->nullable();
            $table->longText('social_token')->nullable();
            $table->longText('social_token_secret')->nullable();
            $table->longText('social_refresh_token')->nullable();
            $table->string('social_expires_in')->nullable();
            $table->string('social_avatar')->nullable();
            $table->string('social_avatar_original')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
