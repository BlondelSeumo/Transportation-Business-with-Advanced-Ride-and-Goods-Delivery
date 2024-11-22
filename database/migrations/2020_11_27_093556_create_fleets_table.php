<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('fleet_id');
            $table->text('qr_image')->nullable();
            $table->unsignedInteger('owner_id');
            $table->integer('brand')->unsigned()->nullable();
            $table->integer('model')->unsigned()->nullable();
            $table->string('license_number');
            $table->string('permission_number');
            $table->uuid('vehicle_type');
            // $table->string('chassis');
            // $table->integer('seats');
            // $table->integer('luggage');
            $table->boolean('class_one')->default(false);
            $table->boolean('class_two')->default(false);
            $table->boolean('active')->default(true);
            $table->boolean('approve')->default(false);
            $table->text('reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('vehicle_type')
                    ->references('id')
                    ->on('vehicle_types')
                    ->onDelete('cascade');

            $table->foreign('brand')
                    ->references('id')
                    ->on('car_makes')
                    ->onDelete('cascade');

            $table->foreign('model')
                    ->references('id')
                    ->on('car_models')
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
        Schema::dropIfExists('fleets');
    }
}
