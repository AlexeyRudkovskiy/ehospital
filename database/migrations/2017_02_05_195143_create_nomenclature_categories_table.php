<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclatureCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclature_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('parent_id', false, true)->nullable()->default(null);

            $table->foreign('parent_id')->references('id')->on('nomenclature_categories')->onDelete('cascade');
        });

        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->integer('nomenclature_category_id', false, true)->nullable()->default(null);
            $table
                ->foreign('nomenclature_category_id')
                ->references('id')
                ->on('nomenclature_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->dropForeign(['nomenclature_category_id']);
            $table->dropColumn('nomenclature_category_id');
        });

        Schema::dropIfExists('nomenclature_categories');
    }
}
