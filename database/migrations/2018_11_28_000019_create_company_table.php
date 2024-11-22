<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('admin_id');
            $table->string('name');
            $table->string('owner_name');
            $table->string('vat_number')->nullable();
            $table->string('mobile');
            $table->string('landline', 14)->nullable();
            $table->string('email', 150);
            $table->string('address', 500)->nullable();
            $table->string('postal_code', 500)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->unsignedInteger('country');
            $table->string('icon')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')
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
        Schema::dropIfExists('companies');
    }
}
