<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalendarDayProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_day_procedure', function (Blueprint $table) {
            $table->integer('calendar_day_id', false, true);
            $table->integer('procedure_id', false, true);

            $table->string('result')->nullable()->default('');

            $table->primary(['calendar_day_id', 'procedure_id']);

            $table->foreign('calendar_day_id')->references('id')->on('calendar_days')->onDelete('cascade');
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendar_day_procedure');
    }
}
