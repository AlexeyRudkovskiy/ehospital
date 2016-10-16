<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientInitialInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_initial_inspections', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('blood_group')->unsigned();
            $table->boolean('rh_factor');
            $table->integer('patient_id')->unsigned();

            $table->string('diabetes')->nullable();
            $table->string('allergic_history')->nullable();

            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_initial_inspections');
    }
}
