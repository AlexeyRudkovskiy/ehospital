<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToMainModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('cures', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('cures', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
