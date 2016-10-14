<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFirstUserIdToCreateByIdInPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->renameColumn('first_user_id', 'created_by_id');
            $table->dropForeign(['first_user_id']);
            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->renameColumn('created_by_id', 'first_user_id');
            $table->dropForeign(['created_by_id']);
            $table->foreign('first_user_id')->references('id')->on('users');
        });
    }
}
