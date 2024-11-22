<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDriverColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('driver_documents')){
            if(!Schema::hasColumn('driver_documents','comment')){
                Schema::table('driver_documents', function (Blueprint $table) {
                    $table->text('comment')->after('expiry_date')->nullable();
                });
            }

            if(!Schema::hasColumn('driver_documents','document_status')){
                Schema::table('driver_documents', function (Blueprint $table) {
                    $table->integer('document_status')->after('comment')->default(2);
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
