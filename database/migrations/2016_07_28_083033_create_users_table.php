<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');

            $table->integer('parent_id')->unsigned()->nullable()->default(null);

            $table->string('password');
            $table->string('email')->nullable();
            $table->string('phone');

            $table->string('cryptKey');
            $table->rememberToken();

            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
