<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclatureIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclature_incomes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('source_of_financing_id')->unsigned();
            $table->integer('contractor_id')->unsigned();
            $table->integer('agreement_id')->unsigned();
            $table->integer('storage_id')->unsigned();
            $table->integer('created_by')->unsigned();

            $table->json('nomenclatures');

            $table->timestamps();

            $table->foreign('source_of_financing_id')->references('id')->on('source_of_financings')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade');
            $table->foreign('agreement_id')->references('id')->on('agreements')->onDelete('cascade');
            $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nomenclature_incomes');
    }
}
