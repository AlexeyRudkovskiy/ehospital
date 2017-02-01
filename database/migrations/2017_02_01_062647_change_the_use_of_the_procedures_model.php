<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTheUseOfTheProceduresModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procedures', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropColumn('filename');
            $table->dropColumn('comment');
            $table->dropColumn('date');

            $table->string('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procedures', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->string('filename')->nullable();
            $table->text('comment')->nullable();

            $table->date('date');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
