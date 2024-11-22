<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestCycles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('request_cycles')) {
            if (!Schema::hasColumn('request_cycles', 'orderby_status')) {
                Schema::table('request_cycles', function (Blueprint $table) {
                    $table->string('orderby_status')->after('request_data')->default(0);
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
