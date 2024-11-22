<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('requests_meta')) {
            
            if (!Schema::hasColumn('requests_meta', 'distance_to_pickup')) {
                Schema::table('requests_meta', function (Blueprint $table) {
                    $table->double('distance_to_pickup',15,8)->after('is_later')->default(0);
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
        //
    }
}
