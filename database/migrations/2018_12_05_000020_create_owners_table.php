<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('user_id');
            $table->uuid('service_location_id');
            $table->string('company_name');
            $table->string('owner_name');
            $table->string('name', 25)->nullable();
            $table->string('surname')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('password')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
          
            $table->integer('postal_code')->nullable();
            $table->string('city', 50)->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('no_of_vehicles')->default(0);
            $table->string('tax_number');
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('approve')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('owners');
    }
}
