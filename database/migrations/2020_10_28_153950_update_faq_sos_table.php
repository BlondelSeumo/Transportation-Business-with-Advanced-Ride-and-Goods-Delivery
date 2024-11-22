<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFaqSosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sos')) {
            if (!Schema::hasColumn('sos', 'user_type')) {
                Schema::table('sos', function (Blueprint $table) {
                    $table->enum('user_type', ['admin','mobile-users']);
                });
            }
        }
        if (Schema::hasTable('faqs')) {
            if (!Schema::hasColumn('faqs', 'company_key')) {
                Schema::table('faqs', function (Blueprint $table) {
                    $table->string('company_key')->after('id')->nullable();
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
