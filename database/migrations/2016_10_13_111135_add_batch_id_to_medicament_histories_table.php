<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchIdToMedicamentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicament_histories', function (Blueprint $table) {
            $table->integer('medicament_batch_id')->unsigned()->nullable()->default(null);
            $table->foreign('medicament_batch_id')->references('id')->on('medicament_batches');
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
            $table->dropForeign(['medicament_batch_id']);
            $table->dropColumn('medicament_batch_id');
        });
    }
}
