<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequestedIdToNomenclatureHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->integer('nomenclature_request_id')->unsigned()->nullable()->default(null);

            $table->foreign('nomenclature_request_id')->references('id')->on('nomenclature_requests');
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
            $table->dropForeign(['nomenclature_request_id']);
            $table->dropColumn('nomenclature_request_id');
        });
    }
}
