<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestForBookOtherFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'book_for_other')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('book_for_other')->after('is_later')->default(0);
                    
                });
            }
             if (!Schema::hasColumn('requests', 'book_for_other_contact')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->string('book_for_other_contact')->after('book_for_other')->default(0);
                    
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
