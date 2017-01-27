<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclatureSetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclature_set_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nomenclature_id', false, true);
            $table->integer('nomenclature_set_id', false, true);
            $table->float('amount');

            $table->foreign('nomenclature_id')->references('id')->on('nomenclatures')->onDelete('cascade');
            $table->foreign('nomenclature_set_id')->references('id')->on('nomenclature_sets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclature_set_items');
    }
}
