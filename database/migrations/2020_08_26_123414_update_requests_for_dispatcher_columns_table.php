<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsForDispatcherColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'dispatcher_id')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->uuid('dispatcher_id')->after('if_dispatch')->nullable();

                    $table->foreign('dispatcher_id')
                    ->references('id')
                    ->on('admin_details')
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
