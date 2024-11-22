<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountTypeToDriverNeededDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          if (Schema::hasTable('driver_needed_documents')) {
            if (!Schema::hasColumn('driver_needed_documents', 'account_type')) {
                Schema::table('driver_needed_documents', function (Blueprint $table) {
               $table->enum('account_type',['individual','fleet_driver','both',])->after('identify_number_locale_key')->nullable();

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
