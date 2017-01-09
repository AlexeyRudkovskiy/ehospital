<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclatureRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclature_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->json('requested');
            $table->json('accepted')->nullable();

            $table->integer('doctor_id')->unsigned();
            $table->integer('head_nurse_id')->unsigned()->nullable()->default(null);
            $table->integer('chief_medical_officer_id')->unsigned()->nullable()->default(null);
            $table->integer('pharmacist_id')->unsigned()->nullable()->default(null);

            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('users');
            $table->foreign('head_nurse_id')->references('id')->on('users');
            $table->foreign('chief_medical_officer_id')->references('id')->on('users');
            $table->foreign('pharmacist_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nomenclature_requests');
    }
}
