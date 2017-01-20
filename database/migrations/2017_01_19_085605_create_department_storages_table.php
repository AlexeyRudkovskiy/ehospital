<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_storages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nomenclature_id', false, true);
            $table->integer('department_id', false, true);
            $table->json('data');

            $table->timestamps();

            $table->foreign('nomenclature_id')->references('id')->on('nomenclatures')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_storages');
    }
}
