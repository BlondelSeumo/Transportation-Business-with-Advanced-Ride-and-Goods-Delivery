<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSNoToOnboardingScreenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onboarding_screen', function (Blueprint $table) {

            // Add the sn_o column back if it does not exist
            if (!Schema::hasColumn('onboarding_screen', 'sn_o')) {
                $table->integer('sn_o')->after('active')->default(0);
            }

            // Revert the order column to its original state
            $table->integer('order')->default(0)->change();

        });
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
