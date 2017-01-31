<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveBackToUnitIdFromMeasureId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendar_day_nomenclature', function (Blueprint $table) {
            $table->dropForeign(['measure_id']);
            $table->dropColumn('measure_id');

            $table->integer('unit_id', false, true);
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
        Schema::table('calendar_day_nomenclature', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');

            $table->integer('measure_id', false, true);
            $table->foreign('measure_id')->references('id')->on('units');
        });
    }
}
