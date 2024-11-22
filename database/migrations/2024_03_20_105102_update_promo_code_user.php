<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePromoCodeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { //
        if (Schema::hasTable('promo')) {
            if (!Schema::hasColumn('promo', 'promo_code_users_availabe')) {
                Schema::table('promo', function (Blueprint $table) {
                    $table->enum('promo_code_users_availabe', ['yes','no'])->after('to')->nullable();
                });

    }}}

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
