<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingScreen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('onboarding_screen')) {        

        Schema::create('onboarding_screen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('sn_o')->default(0);
            $table->enum('screen', ['driver','user']);
            $table->integer('order')->default(0);
            $table->string('title');
            $table->string('onboarding_image');
            $table->text('description');
            $table->boolean('active')->default(true);
            $table->timestamps();

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
        Schema::dropIfExists('onboarding_screen');
    }
}
