<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFaqsLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('faqs')) {
            if (!Schema::hasColumn('faqs', 'service_location_id')) {
                Schema::table('faqs', function (Blueprint $table) {
                    $table->string('service_location_id')->after('id')->nullable();
                    
                    $table->foreign('service_location_id')
                            ->references('id')
                            ->on('service_locations')
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
