<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalendarDayNomenclatureSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_day_nomenclature_set', function (Blueprint $table) {
            $table->integer('calendar_day_id', false, true);
            $table->integer('nomenclature_set_id', false, true);
            $table->integer('user_id', false, true)->nullable()->default(null);
            $table->integer('amount', false, true);
            $table->boolean('took')->default(false);

            $table->foreign('calendar_day_id')->references('id')->on('calendar_days');
            $table->foreign('nomenclature_set_id')->references('id')->on('nomenclature_sets');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendar_day_nomenclature_set');
    }
}
