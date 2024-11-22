<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_builds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name');
            $table->string('build_number');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('flavour_id');
            $table->enum('team', ['android','ios']);
            $table->string('version');
            $table->string('environment');
            $table->string('file_size');
            $table->string('download_link');
            $table->string('uploaded_by')->nullable();
            $table->string('additional_comments')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onDelete('cascade');

            $table->foreign('flavour_id')
                    ->references('id')
                    ->on('project_flavours')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_builds');
    }
}
