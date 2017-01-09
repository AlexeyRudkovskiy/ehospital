<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuresUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cures_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('cure_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cure_id')->references('id')->on('cures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cures_users');
    }
}
