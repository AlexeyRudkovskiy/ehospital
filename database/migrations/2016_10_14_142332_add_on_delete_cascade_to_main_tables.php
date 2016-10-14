<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToMainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cures', function (Blueprint $table) {
            $table->dropForeign([ 'patient_id' ]);
            $table->dropForeign([ 'department_id' ]);

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->dropForeign([ 'cure_id' ]);

            $table->foreign('cure_id')->references('id')->on('cures')->onDelete('cascade');
        });

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
        Schema::table('cures', function (Blueprint $table) {
            $table->dropForeign([ 'patient_id' ]);
            $table->dropForeign([ 'department_id' ]);

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('calendar_days', function (Blueprint $table) {
            $table->dropForeign([ 'cure_id' ]);

            $table->foreign('cure_id')->references('id')->on('cures');
        });

        Schema::table('cure_user', function (Blueprint $table) {
            $table->dropForeign([ 'user_id' ]);
            $table->dropForeign([ 'cure_id' ]);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cure_id')->references('id')->on('cures');
        });
    }
}
