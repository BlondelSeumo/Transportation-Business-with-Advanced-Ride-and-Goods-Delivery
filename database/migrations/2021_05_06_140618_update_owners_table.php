<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('owners')) {
            if (!Schema::hasColumn('owners', 'ifsc')) {
                Schema::table('owners', function (Blueprint $table) {
                    $table->string('ifsc')->after('bank_name')->nullable();
                });
            }
            if (!Schema::hasColumn('owners', 'account_no')) {
                Schema::table('owners', function (Blueprint $table) {
                    $table->string('account_no')->after('ifsc')->nullable();

                   
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
