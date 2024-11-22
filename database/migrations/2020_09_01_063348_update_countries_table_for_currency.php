<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTableForCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('countries')) {
            if (!Schema::hasColumn('countries', 'currency_name')) {
                Schema::table('countries', function (Blueprint $table) {
                    $table->string('currency_name')->after('code')->nullable();
                });
            }
        }

        if (Schema::hasTable('countries')) {
            if (!Schema::hasColumn('countries', 'currency_code')) {
                Schema::table('countries', function (Blueprint $table) {
                    $table->string('currency_code')->after('currency_name')->nullable();
                });
            }
        }

        if (Schema::hasTable('countries')) {
            if (!Schema::hasColumn('countries', 'currency_symbol')) {
                Schema::table('countries', function (Blueprint $table) {
                    $table->string('currency_symbol')->after('currency_code')->nullable();
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
