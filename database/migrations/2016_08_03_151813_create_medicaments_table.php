<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('code');

            $table->string('name');
            $table->string('name_for_department');
            $table->string('small_name');

            $table->float('amount_in_a_package');
            $table->boolean('keep_records_by_series');
            $table->float('nds');
            $table->string('barcode', 13);

//            $table->integer('atc_id')->unsigned()->nullable()->default(null);
//            $table->integer('inn_id')->unsigned()->nullable()->default(null);
            $table->integer('morion_code');

//            $table->integer('registration_id')->unsigned()->nullable()->default(null);
//            $table->integer('composition_id')->unsigned()->nullable()->default(null);

            $table->integer('set_id')->unsigned()->nullable()->default(null);

            $table->timestamps();
            $table->foreign('set_id')->references('id')->on('medicaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicaments');
    }
}
