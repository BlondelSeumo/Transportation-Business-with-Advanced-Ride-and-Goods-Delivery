<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('request_bills')) {
            if (!Schema::hasColumn('request_bills', 'requested_currency_symbol')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->string('requested_currency_symbol')->after('requested_currency_code')->nullable();
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
