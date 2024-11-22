<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePackageTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasTable('package_types')) {
            if (!Schema::hasColumn('package_types', 'short_description')) {
                Schema::table('package_types', function (Blueprint $table) {
                    $table->string('short_description')->after('active')->nullable();
                });
            }
             if (!Schema::hasColumn('package_types', 'description')) {
                Schema::table('package_types', function (Blueprint $table) {
                    $table->string('description')->after('short_description')->nullable();
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
