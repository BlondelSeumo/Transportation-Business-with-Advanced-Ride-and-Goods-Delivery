<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIsIndividualToDriverNeededDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('driver_needed_documents')) {
            
            if (Schema::hasColumn('driver_needed_documents', 'is_individual')) {
                Schema::table('driver_needed_documents', function (Blueprint $table) {
                  $table->dropColumn('is_individual');

                });
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver_needed_documents', function (Blueprint $table) {
            //
        });
    }
}
