<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistanceMatrixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distance_matrixes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin_addresses');
            $table->double('origin_lat', 15, 8)->default(0);
            $table->double('origin_lng', 15, 8)->default(0);
            $table->string('destination_addresses');
            $table->double('destination_lat', 15, 8)->default(0);
            $table->double('destination_lng', 15, 8)->default(0);
            $table->string('distance');
            $table->string('duration');
            $table->text('json_result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distance_matrixes');
    }
}
