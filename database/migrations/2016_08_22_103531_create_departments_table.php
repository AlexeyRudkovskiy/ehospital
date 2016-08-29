<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('leader_id', false, true)->nullable()->default(null);
            $table->integer('organization_id', false, true)->nullable()->default(null);
            $table->integer('department_code', false, true)->nullable();
            $table->integer('beds_amount', false, true)->nullable();
            $table->integer('beds_amount_in_repair', false, true)->nullable();
            $table->integer('female_beds_amount', false, true)->nullable();
            $table->integer('male_beds_amount', false, true)->nullable();

            $table->timestamps();

            $table->foreign('leader_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });

        Schema::table('patient_cards', function (Blueprint $table) {
            $table->integer('department_id', false, true);
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_cards', function (Blueprint $table) {
            $table->dropForeign([ 'department_id' ]);
            $table->dropColumn('department_id');
        });

        Schema::drop('departments');
    }
}
