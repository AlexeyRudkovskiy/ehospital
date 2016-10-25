<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUnusedTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('agreements', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('armored_times', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('contractor_groups', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('cure_statuses', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('cures', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('list_items', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('manufacturers', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('nomenclature_batches', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('patient_statuses', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('source_of_financings', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('user_positions', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('user_schedules', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('agreements', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('armored_times', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('contractor_groups', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('cure_statuses', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('cures', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('list_items', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('manufacturers', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('nomenclature_batches', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('patient_statuses', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('source_of_financings', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('user_positions', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('user_schedules', function (Blueprint $table) {
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
