<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
           
            $table->uuid('service_location_id');
             
            $table->string('name');
            $table->string('mobile');
            $table->string('email', 150);
            $table->string('address', 500)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->unsignedInteger('country');
            $table->string('postal_code')->nullable();
            $table->string('gender')->nullable();
            // $table->string('device_token')->nullable();
            // $table->string('social_unique_id')->nullable();
            // $table->enum('login_method',['manual','facebook','google'])->nullable();
            // $table->enum('login_by',['ios','andriod'])->nullable();
            $table->uuid('vehicle_type')->nullable();
            $table->unsignedInteger('car_make')->nullable();
            $table->unsignedInteger('car_model')->nullable();
            $table->string('car_color')->nullable();
            $table->string('car_number')->nullable();
            $table->integer('today_trip_count')->default(0);
            $table->integer('total_accept')->default(0);
            $table->integer('total_reject')->default(0);
            $table->integer('acceptance_ratio')->default(0);
            $table->timestamp('last_trip_date')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('approve')->default(false);
            $table->boolean('available')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('admin_id')
            //         ->references('id')
            //         ->on('users')
            //         ->onDelete('cascade');

            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('car_make')
                    ->references('id')
                    ->on('car_makes')
                    ->onDelete('cascade');

            $table->foreign('car_model')
                    ->references('id')
                    ->on('car_models')
                    ->onDelete('cascade');

            $table->foreign('country')
                    ->references('id')
                    ->on('countries')
                    ->onDelete('cascade');

            $table->foreign('vehicle_type')
                    ->references('id')
                    ->on('vehicle_types')
                    ->onDelete('cascade');

            $table->foreign('service_location_id')
                    ->references('id')
                    ->on('service_locations')
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
        Schema::dropIfExists('drivers');
    }
}
