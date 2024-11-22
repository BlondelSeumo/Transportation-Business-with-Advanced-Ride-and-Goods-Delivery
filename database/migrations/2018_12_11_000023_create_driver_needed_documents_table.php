<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverNeededDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_needed_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('doc_type')->default('image');
            $table->boolean('has_identify_number')->default(false);
            $table->string('identify_number_locale_key')->nullable();
            $table->boolean('has_expiry_date')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_needed_documents');
    }
}
