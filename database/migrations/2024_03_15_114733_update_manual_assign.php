<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateManualAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'assign_method')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->string('assign_method')->after('is_later')->default(0);
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
