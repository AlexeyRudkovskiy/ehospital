<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicament_batches', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('medicament_id')->unsigned();
            $table->date('expiration_date');
            $table->integer('batch_number');
            $table->float('price');

            $table->timestamps();

            $table->foreign('medicament_id')->references('id')->on('medicaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicament_batches');
    }
}
