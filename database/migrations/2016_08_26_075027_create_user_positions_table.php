<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_positions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_position_id')->unsigned()->nullable()->default(null);

            $table->foreign('user_position_id')->references('id')->on('user_positions');
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
            $table->dropForeign([ 'user_position_id' ]);
            $table->dropColumn('user_position_id');
        });

        Schema::drop('user_positions');
    }
}
