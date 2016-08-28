<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');

            $table->json('changedFrom');
            $table->json('changedTo');
            $table->string('keys');

            $table->morphs('revisionable', 'revisionable_id');

            $table->integer('made_by_id')->unsigned();

            $table->timestamps();

            $table->foreign('made_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('revisions');
    }
}
