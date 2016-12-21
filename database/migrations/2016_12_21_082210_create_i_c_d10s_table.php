<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateICD10sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_c_d10s', function (Blueprint $table) {
            $table->increments('id');



            $table->timestamps();
        });

        Schema::table('cure_cards', function (Blueprint $table) {
            $table->integer('hospitalization_i_c_d10_id', false, true);
            $table->foreign('hospitalization_i_c_d10_id')->references('id')->on('i_c_d10s');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cure_cards', function (Blueprint $table) {
            $table->dropForeign(['hospitalization_i_c_d10_id']);
            $table->dropColumn('hospitalization_i_c_d10_id');
        });

        Schema::dropIfExists('i_c_d10s');
    }
}
