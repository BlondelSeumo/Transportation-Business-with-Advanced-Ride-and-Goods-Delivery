<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePromoCodeServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('promo')) {
            if (!Schema::hasColumn('promo', 'promo_code_users_available')) {
                Schema::table('promo', function (Blueprint $table) {
                 $table->string('promo_code_users_available')->nullable()->after('to');
                });
            }
            if (!Schema::hasColumn('promo', 'service_ids')) {
                Schema::table('promo', function (Blueprint $table) {
               $table->text('service_ids')->after('total_uses')->nullable();
                });
            }
            if (!Schema::hasColumn('promo', 'user_id')) {
                Schema::table('promo', function (Blueprint $table) {
                    $table->unsignedInteger('user_id')->after('promo_code_users_available')->nullable();
                    $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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

    }
}
