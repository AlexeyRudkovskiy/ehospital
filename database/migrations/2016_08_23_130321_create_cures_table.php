<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cures', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->dropForeign(['patient_card_id']);
            $table->dropColumn('patient_card_id');

            $table->integer('cure_id')->unsigned();
            $table->foreign('cure_id')->references('id')->on('cures');
        });

        Schema::drop('patient_cards');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('patient_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->dropForeign(['cure_id']);
            $table->dropColumn('cure_id');

            $table->integer('patient_card_id')->unsigned();
            $table->foreign('patient_card_id')->references('id')->on('patient_cards');
        });

        Schema::drop('cures');
    }
}
