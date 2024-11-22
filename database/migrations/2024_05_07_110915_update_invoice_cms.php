<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvoiceCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landingpagecms', function (Blueprint $table) {

            $table->text('invoice_logo')->nullable();
            $table->text('privacy_policy_link')->nullable();
            $table->text('terms_and_conditions_link')->nullable();
            $table->text('invoice_email')->nullable();

        });
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
