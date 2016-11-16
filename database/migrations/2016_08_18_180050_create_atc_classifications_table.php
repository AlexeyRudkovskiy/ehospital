<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtcClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atc_classifications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->string('code', 32);
            $table->string('name_ua');
            $table->string('name_en');

            $table->timestamps();
        });

        Schema::table('medicaments', function (Blueprint $table) {
            $table->integer('atc_classification_id')->unsigned();
            $table->foreign('atc_classification_id')->references('id')->on('atc_classifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropForeign(['atc_classification_id']);
            $table->dropColumn('atc_classification_id');
        });

        Schema::drop('atc_classifications');
    }
}
