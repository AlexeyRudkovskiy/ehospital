<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarDayMedicamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_day_medicament', function (Blueprint $table) {
            $table->integer('calendar_day_id')->unsigned();
            $table->integer('medicament_id')->unsigned();

            $table->foreign('calendar_day_id')->references('id')->on('calendar_days')->onDelete('cascade');
            $table->foreign('medicament_id')->references('id')->on('medicaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendar_day_medicament');
    }
}
