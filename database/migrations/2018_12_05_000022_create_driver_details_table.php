<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('driver_id');
            $table->double('latitude', 15, 8)->nullable();
            $table->double('longitude', 15, 8)->nullable();
            $table->double('bearing', 15, 2)->nullable();
            $table->boolean('is_socket_connected')->default(false);
            $table->uuid('current_zone')->nullable();
            $table->double('rating', 10, 2)->default(0);
            $table->integer('rated_by')->default(0);
            $table->boolean('is_company_driver')->default(0);
            $table->uuid('company')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company')
                    ->references('id')
                    ->on('companies')
                    ->onDelete('set null');

            $table->foreign('current_zone')
                    ->references('id')
                    ->on('zones')
                    ->onDelete('set null');


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
        Schema::dropIfExists('driver_details');
    }
}
