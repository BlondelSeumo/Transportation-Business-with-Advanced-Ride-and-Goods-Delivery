<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsForCompanyKeyUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_locations', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
        Schema::table('cancellation_reasons', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
        Schema::table('complaint_titles', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
        Schema::table('sos', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
        Schema::table('zones', function (Blueprint $table) {
            $table->string('company_key')->after('id')->nullable();
        });
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
