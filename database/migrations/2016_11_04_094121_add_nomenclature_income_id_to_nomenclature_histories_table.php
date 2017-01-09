<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomenclatureIncomeIdToNomenclatureHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->integer('nomenclature_income_id')->unsigned()->nullable()->default(null);

            $table->foreign('nomenclature_income_id')->references('id')->on('nomenclature_incomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->dropForeign(['nomenclature_income_id']);
            $table->dropColumn('nomenclature_income_id');
        });
    }
}
