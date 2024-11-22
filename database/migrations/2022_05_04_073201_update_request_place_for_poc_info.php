<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestPlaceForPocInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('request_places')) {
            if (!Schema::hasColumn('request_places', 'pickup_poc_name')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('pickup_poc_name')->after('drop_address')->nullable();
                });
            }
            if (!Schema::hasColumn('request_places', 'pickup_poc_mobile')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('pickup_poc_mobile')->after('pickup_poc_name')->nullable();
                });
            }
            if (!Schema::hasColumn('request_places', 'drop_poc_name')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('drop_poc_name')->after('pickup_poc_name')->nullable();
                });
            }
            if (!Schema::hasColumn('request_places', 'drop_poc_mobile')) {
                Schema::table('request_places', function (Blueprint $table) {
                    $table->string('drop_poc_mobile')->after('pickup_poc_mobile')->nullable();
                });
            }

        }

        // if (Schema::hasTable('requests')) {
        //     if (!Schema::hasColumn('requests', 'goods_type_id')) {
        //         Schema::table('requests', function (Blueprint $table) {
        //             $table->unsignedInteger('goods_type_id')->after('user_id')->nullable();

        //             $table->foreign('goods_type_id')
        //             ->references('id')
        //             ->on('goods_types')
        //             ->onDelete('cascade');

        //         });
        //     }

        // }

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
