<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->enum('type', [ 'legal', 'private' ])->default('legal');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign([ 'organization_id' ]);
            $table->dropColumn('organization_id');
        });

        Schema::drop('organizations');
    }
}
