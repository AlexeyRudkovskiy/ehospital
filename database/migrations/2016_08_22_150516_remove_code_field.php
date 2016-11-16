<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCodeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('contractor_groups', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atc_classifications', function (Blueprint $table) {
            $table->string('code', 32);
        });

        Schema::table('contractor_groups', function (Blueprint $table) {
            $table->integer('code')->unsigned();
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->integer('code')->unsigned();
        });

        Schema::table('medicaments', function (Blueprint $table) {
            $table->integer('code');
        });
    }
}
