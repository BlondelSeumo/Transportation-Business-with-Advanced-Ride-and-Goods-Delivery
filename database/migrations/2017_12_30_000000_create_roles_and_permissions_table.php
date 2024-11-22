<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesAndPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::transaction(function () {

            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug', 50)->unique();
                $table->string('name', 50);
                $table->string('description', 150)->nullable();
                $table->boolean('all')->default(false);
                $table->boolean('locked')->default(false);
                $table->timestamps();
            });

            Schema::create('role_user', function (Blueprint $table) {
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('role_id');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');

                $table->primary(['user_id', 'role_id']);
            });

            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug', 50)->unique();
                $table->string('name', 50);
                $table->string('description', 150)->nullable();
                $table->string('main_menu')->nullable();
                $table->string('sub_menu')->nullable();
                $table->string('main_link')->nullable();
                $table->string('sub_link')->nullable();
                $table->integer('sort')->nullable();
                $table->string('icon')->nullable();
                $table->timestamps();
            });

            Schema::create('permission_role', function (Blueprint $table) {
                $table->unsignedInteger('role_id');
                $table->unsignedInteger('permission_id');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');

                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions')
                    ->onDelete('cascade');

                $table->primary(['role_id', 'permission_id']);
            });

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
