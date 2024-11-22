<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGoodsTypesForToGoodsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('goods_types')) {
            if (!Schema::hasColumn('goods_types', 'goods_types_for')) {
                Schema::table('goods_types', function (Blueprint $table) {
                $table->enum('goods_types_for',['truck' , 'motor_bike'])->after('goods_type_name')->nullable();
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
        Schema::table('goods_types', function (Blueprint $table) {
            //
        });
    }
}
