<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_id')->unsigned()->nullable()->default(null);
            $table->foreign('patient_id')->references('id')->on('patients');

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
        Schema::drop('patient_cards');
    }
}
