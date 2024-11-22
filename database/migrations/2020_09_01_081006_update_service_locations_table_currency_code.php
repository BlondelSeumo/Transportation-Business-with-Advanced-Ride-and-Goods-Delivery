<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateServiceLocationsTableCurrencyCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('service_locations')) {
            if (!Schema::hasColumn('service_locations', 'currency_code')) {
                Schema::table('service_locations', function (Blueprint $table) {
                    $table->string('currency_code')->after('currency_name')->nullable();

                    $table->string('currency_name')->nullable()->change();
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
        //
    }
}
