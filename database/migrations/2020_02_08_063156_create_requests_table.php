<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('request_number');
            $table->boolean('is_later')->default(0);
            $table->integer('attempt_for_schedule')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->uuid('service_location_id');
            $table->uuid('zone_type_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->timestamp('trip_start_time')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('is_driver_started')->default(0);
            $table->boolean('is_driver_arrived')->default(0);
            $table->boolean('is_trip_start')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_cancelled')->default(0);
            $table->uuid('reason')->nullable();
            $table->string('custom_reason')->nullable();
            $table->enum('cancel_method', [0,1,2,3])->comment('0 => Automatic,1 => User,2 => Driver,3=> Dispatcher');
            $table->double('total_distance', 15, 2)->default(0);
            $table->double('total_time', 15, 2)->default(0);
            $table->string('payment_opt')->comment('0 => card,1 => cash,2 => wallet,3=>wallet/cash');
            $table->boolean('is_paid')->default(0);
            $table->boolean('user_rated')->default(0);
            $table->boolean('driver_rated')->default(0);
            $table->uuid('promo_id')->nullable();
            $table->string('timezone')->nullable();
            $table->string('requested_currency_code')->nullable();
            $table->string('requested_currency_symbol')->nullable();
            $table->enum('unit', [1,2])->comment('1 => kilometers,2 => miles');
            $table->boolean('if_dispatch')->default(0);
            $table->uuid('dispatcher_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('promo_id')
                    ->references('id')
                    ->on('promo')
                    ->onDelete('cascade');

            $table->foreign('dispatcher_id')
                    ->references('id')
                    ->on('admin_details')
                    ->onDelete('cascade');

            $table->foreign('zone_type_id')
                    ->references('id')
                    ->on('zone_types')
                    ->onDelete('cascade');

            $table->foreign('driver_id')
                    ->references('id')
                    ->on('drivers')
                    ->onDelete('cascade');

            $table->foreign('service_location_id')
                    ->references('id')
                    ->on('service_locations')
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
        Schema::dropIfExists('requests');
    }
}
