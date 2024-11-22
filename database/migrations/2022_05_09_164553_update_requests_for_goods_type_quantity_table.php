<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsForGoodsTypeQuantityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  if (Schema::hasTable('requests')) {
        //     if (!Schema::hasColumn('requests', 'goods_type_quantity')) {
        //         Schema::table('requests', function (Blueprint $table) {
        //             $table->string('goods_type_quantity')->after('goods_type_id')->nullable();
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
