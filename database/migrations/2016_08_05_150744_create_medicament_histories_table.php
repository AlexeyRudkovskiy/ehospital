<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicament_histories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('medicament_id')->unsigned();
            $table->integer('calendar_day_id')->unsigned()->nullable()->default(null);
            $table->float('amount');
            $table->enum('status', ['armored', 'income', 'outgoing']);

            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('medicament_id')->references('id')->on('medicaments');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('calendar_day_id')->references('id')->on('calendar_days');
        });

        Schema::table('calendar_day_medicament', function (Blueprint $table) {
            $table->integer('medicament_history_id')->unsigned()->nullable()->default(null);
            $table->foreign('medicament_history_id')->references('id')->on('medicament_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_day_medicament', function (Blueprint $table) {
            $table->dropForeign([ 'medicament_history_id' ]);
            $table->dropColumn('medicament_history_id');
        });

        Schema::drop('medicament_histories');
    }
}
