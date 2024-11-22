<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('countries')) {
            if (!Schema::hasColumn('countries', 'dial_min_length')) {
                Schema::table('countries', function (Blueprint $table) {
                    $table->integer('dial_min_length')->after('dial_code')->default(0);
                    
                });
            }
             if (!Schema::hasColumn('countries', 'dial_max_length')) {
                Schema::table('countries', function (Blueprint $table) {
                    $table->integer('dial_max_length')->after('dial_min_length')->default(0);
                    
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
