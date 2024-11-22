<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneTypePackagePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_type_package_prices', function (Blueprint $table) {
           $table->uuid('id')->primary();
            $table->uuid('zone_type_id');
            $table->string('package_type_id');
            $table->string('distance_price_per_km');
            $table->string('time_price_per_min');
            $table->string('cancellation_fee');
            $table->string('free_distance');
            $table->string('free_min');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('zone_type_id')
                    ->references('id')
                    ->on('zone_types')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zone_type_package_prices');
    }
}
