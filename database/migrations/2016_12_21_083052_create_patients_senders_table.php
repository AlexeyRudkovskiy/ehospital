<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_senders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->char('edrpou', 8);

            $table->timestamps();
        });

        Schema::table('cure_cards', function (Blueprint $table) {
            $table->integer('patient_sender_id', false, true);
            $table->foreign('patient_sender_id')->references('id')->on('patients_senders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cure_cards', function (Blueprint $table) {
            $table->dropForeign(['patient_sender_id']);
            $table->dropColumn('patient_sender_id');
        });

        Schema::dropIfExists('patients_senders');
    }
}
