<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomenclature_batches', function (Blueprint $table) {
            $table->dropColumn('expiration_date');
            $table->dropColumn('batch_number');

            $table->string('batch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomenclature_batches', function (Blueprint $table) {
            $table->dropColumn('batch');

            $table->date('expiration_date');
            $table->integer('batch_number', false, true);
        });
    }
}
