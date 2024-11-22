<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users')){
            if(!Schema::hasColumn('users','country')){
                Schema::table('users', function (Blueprint $table) {
                    $table->unsignedInteger('country')->after('profile_picture')->nullable();

                    $table->foreign('country')
                        ->references('id')
                        ->on('countries')
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
        //
    }
}
