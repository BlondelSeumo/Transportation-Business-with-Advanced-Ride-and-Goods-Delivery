<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDocumentIdToFleetDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fleet_documents', function (Blueprint $table) {
            $table->unsignedInteger('document_id');

        $table->foreign('document_id')
                    ->references('id')
                    ->on('fleet_needed_documents')
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
        Schema::table('fleet_documents', function (Blueprint $table) {
            //
        });
    }
}
