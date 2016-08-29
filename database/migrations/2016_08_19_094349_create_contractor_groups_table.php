<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_groups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('code')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable()->default(null);

            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('contractor_groups');
        });

        Schema::table('contractors', function (Blueprint $table) {
            $table->integer('contractor_group_id')->unsigned();
            $table->foreign('contractor_group_id')->references('id')->on('contractor_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contractors', function (Blueprint $table) {
            $table->dropForeign([ 'contractor_group_id' ]);
            $table->dropColumn('contractor_group_id');
        });

        Schema::drop('contractor_groups');
    }
}
