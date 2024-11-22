<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestBillForAdminCommissionForDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('request_bills')) {
            
            if (!Schema::hasColumn('request_bills', 'admin_commision_from_driver')) {
                Schema::table('request_bills', function (Blueprint $table) {
                    $table->double('admin_commision_from_driver', 10, 2)->after('admin_commision')->default(0);
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
