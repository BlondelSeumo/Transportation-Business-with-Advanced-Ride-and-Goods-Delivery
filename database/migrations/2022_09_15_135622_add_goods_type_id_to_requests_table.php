<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoodsTypeIdToRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            if (Schema::hasTable('requests')) {
                    if (!Schema::hasColumn('requests', 'goods_type_id')) {
                        Schema::table('requests', function (Blueprint $table) {
                            $table->unsignedInteger('goods_type_id')->after('user_id')->nullable();
        
                            $table->foreign('goods_type_id')
                            ->references('id')
                            ->on('goods_types')
                            ->onDelete('cascade');
        
                        });
                    }
                    if (Schema::hasTable('requests')) {
                        if (!Schema::hasColumn('requests', 'goods_type_quantity')) {
                            Schema::table('requests', function (Blueprint $table) {
                                $table->string('goods_type_quantity')->after('goods_type_id')->nullable();
                            });
                        }
            
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
        Schema::table('requests', function (Blueprint $table) {
            //
        });
    }
}
