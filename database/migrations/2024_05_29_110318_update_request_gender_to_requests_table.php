<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestGenderToRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'is_pet_available')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_pet_available')->after('is_cancelled')->default(0)->nullable();
                });
            }
            if (!Schema::hasColumn('requests', 'is_luggage_available')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_luggage_available')->after('is_pet_available')->default(0)->nullable();
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
        Schema::table('requests', function (Blueprint $table) {
            //
        });
    }
}
