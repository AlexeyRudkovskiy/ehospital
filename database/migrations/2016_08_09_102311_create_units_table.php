<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');

            $table->string('text');
            $table->integer('unit_id')->unsigned()->nullable()->default(null);
            $table->float('scale');

            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
        });

        Schema::table('medicaments', function (Blueprint $table) {
            $table->integer('base_unit_id')->unsigned()->nullable()->default(null);
            $table->foreign('base_unit_id')->references('id')->on('units');

            $table->integer('basic_unit_id')->unsigned()->nullable()->default(null);
            $table->foreign('basic_unit_id')->references('id')->on('units');
        });

        Schema::table('medicament_histories', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned()->nullable()->default(null);
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicament_histories', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });

        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropForeign([ 'base_unit_id' ]);
            $table->dropColumn('base_unit_id');

            $table->dropForeign([ 'basic_unit_id' ]);
            $table->dropColumn('basic_unit_id');
        });
        Schema::drop('units');
    }
}
