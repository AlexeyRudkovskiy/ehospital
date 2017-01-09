<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCuresUsersTableToCureUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('cures_users', 'cure_user');

        Schema::table('cure_user', function (Blueprint $table) {
            $table->dropForeign('cures_users_user_id_foreign');
            $table->dropForeign('cures_users_cure_id_foreign');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cure_id')->references('id')->on('cures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('cure_user', 'cures_users');
    }

}
