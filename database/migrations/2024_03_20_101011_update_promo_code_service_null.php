<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePromoCodeServiceNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->dropForeign(['service_location_id']);
        });


        Schema::table('promo', function (Blueprint $table) {
            $table->unsignedBigInteger('service_location_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->foreign('service_location_id')->references('id')->on('service_locations')->onDelete('cascade');
        });
    }
}
