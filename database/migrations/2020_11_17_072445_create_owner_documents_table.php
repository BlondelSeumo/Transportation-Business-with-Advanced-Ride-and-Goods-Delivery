<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('owner_id');
            $table->unsignedInteger('document_id');
            $table->string('image');
            $table->string('identify_number')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->text('comment')->nullable();
            $table->integer('document_status')->default(2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')
                    ->references('id')
                    ->on('owners')
                    ->onDelete('cascade');

            $table->foreign('document_id')
                    ->references('id')
                    ->on('owner_needed_documents')
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
        Schema::dropIfExists('owner_documents');
    }
}
