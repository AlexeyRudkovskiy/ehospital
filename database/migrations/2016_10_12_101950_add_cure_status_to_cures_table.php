<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCureStatusToCuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cures', function (Blueprint $table) {
            $table->integer('cure_status_id')->unsigned()->nullable()->default(null);
            $table->foreign('cure_status_id')->references('id')->on('cure_statuses')->onDelete('cascade');
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
            $table->dropForeign([ 'cure_status_id' ]);
            $table->dropColumn('cure_status_id');
        });
    }
}
