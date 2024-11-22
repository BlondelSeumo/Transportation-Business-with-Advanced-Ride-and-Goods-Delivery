<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneTypePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_type_price', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('zone_type_id');
            $table->integer('price_type')->nullable()->comment('1 => Ridenow,2 => RideLater');
            $table->double('base_price', 10, 2)->default(0);
            $table->integer('base_distance');
            $table->double('price_per_distance', 10, 2)->default(0);
            $table->double('waiting_charge', 10, 2)->default(0);
            $table->double('price_per_time', 10, 2)->default(0);
            $table->double('cancellation_fee', 10, 2)->default(0);

            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('zone_type_price');
    }
}
