<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('request_id');
            $table->double('base_price', 10, 2)->default(0);
            $table->integer('base_distance');
            $table->double('total_distance', 15, 8)->default(0);
            $table->double('total_time', 15, 2)->default(0);
            $table->double('price_per_distance', 10, 2)->default(0);
            $table->double('distance_price', 10, 2)->default(0);
            $table->double('price_per_time', 10, 2)->default(0);
            $table->double('time_price', 10, 2)->default(0);
            $table->double('waiting_charge', 10, 2)->default(0);
            $table->double('cancellation_fee', 10, 2)->default(0);
            $table->double('service_tax', 10, 2)->default(0);
            $table->integer('service_tax_percentage')->default(0);
            $table->double('promo_discount', 10, 2)->default(0);
            $table->double('admin_commision', 10, 2)->default(0);
            $table->double('admin_commision_with_tax', 10, 2)->default(0);
            $table->double('driver_commision', 10, 2)->default(0);
            $table->double('total_amount', 10, 2)->default(0);
            $table->string('requested_currency_code');

            $table->timestamps();

            $table->foreign('request_id')
                    ->references('id')
                    ->on('requests')
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
        Schema::dropIfExists('request_bills');
    }
}
