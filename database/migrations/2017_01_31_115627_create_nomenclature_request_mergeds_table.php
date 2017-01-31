<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomenclatureRequestMergedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclature_request_mergeds', function (Blueprint $table) {
            $table->increments('id');

            $table->json('requested');
            $table->json('accepted')->nullable();

            $table->integer('department_id', false, true)->nullable()->default(null);
            $table->integer('pharmacist_id', false, true)->nullable()->default(null);

            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('pharmacist_id')->references('id')->on('users');
        });

        Schema::table('nomenclature_requests', function (Blueprint $table) {
            $table->integer('nomenclature_request_merged_id', false, true)->nullable()->default(null);
            $table->foreign('nomenclature_request_merged_id')->references('id')->on('nomenclature_request_mergeds');
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
            $table->dropForeign(['nomenclature_request_merged_id']);
            $table->dropColumn('nomenclature_request_merged_id');
        });

        Schema::dropIfExists('nomenclature_request_mergeds');
    }
}
