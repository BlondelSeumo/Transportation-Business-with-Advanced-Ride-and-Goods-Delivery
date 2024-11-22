<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsForRentalOutStation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          if (Schema::hasTable('requests')) {
            if (!Schema::hasColumn('requests', 'is_rental')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_rental')->after('is_later')->default(false);
                    
                });
            }
             if (!Schema::hasColumn('requests', 'rental_package_id')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->unsignedInteger('rental_package_id')->after('is_rental')->nullable();
                    
                    $table->foreign('rental_package_id')
                    ->references('id')
                    ->on('package_types')
                    ->onDelete('cascade');
                    
                });

            }

              if (!Schema::hasColumn('requests', 'is_out_station')) {
                Schema::table('requests', function (Blueprint $table) {
                    $table->boolean('is_out_station')->after('rental_package_id')->default(false);
                    
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
