<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('drivers')) {
            if (!Schema::hasColumn('drivers', 'uuid')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->uuid('uuid')->after('id')->nullable();
                });
            }
            if (!Schema::hasColumn('drivers', 'owner_id')) {
                Schema::table('drivers', function (Blueprint $table) {
                    $table->uuid('owner_id')->after('user_id')->nullable();

                    $table->foreign('owner_id')
                    ->references('id')
                    ->on('owners')
                    ->onDelete('cascade');
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
