<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCureIdColumnToNomenclatureRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomenclature_requests', function (Blueprint $table) {
            $table->integer('cure_id')->unsigned();
            $table->foreign('cure_id')->references('id')->on('cures');

            $table->boolean('done')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomenclature_requests', function (Blueprint $table) {
            $table->dropForeign(['cure_id']);
            $table->dropColumn('cure_id');
            $table->dropColumn('done');
        });
    }
}
