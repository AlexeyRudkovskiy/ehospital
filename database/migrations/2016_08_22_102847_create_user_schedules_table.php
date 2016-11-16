<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_schedules', function (Blueprint $table) {
            $table->increments('id');

            $table->time('from');
            $table->time('to');
            $table->time('per_patient');
            $table->integer('user_id', false, true);

            $table->integer('day_of_week')->default(1);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_schedules');
    }
}
