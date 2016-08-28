<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePatientStatusesTableAddedNewStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_statuses', function (Blueprint $table) {
//            $table->dropColumn('type');
//            $table->enum('type', ['income', 'outcome', 'move'])->nullable()->default(null);
            DB::statement("ALTER TABLE patient_statuses MODIFY COLUMN `type` ENUM('hospitalization', 'extract', 'unauthorized_leaving_the_hospital', 'cancellation_extract', 'cancellation_of_hospitalization', 'patient_transfer')");
            $table->integer('made_by_id')->unsigned()->nullable()->default(null);
            $table->integer('department_id')->unsigned()->nullable()->default(null);

            $table->foreign('made_by_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_statuses', function (Blueprint $table) {
//            $table->dropColumn('type');
//            $table->enum('type', ['income', 'outcome'])->nullable()->default(null);
            DB::statement("ALTER TABLE patient_statuses MODIFY COLUMN `type` ENUM('income', 'outcome')");
            $table->dropForeign([ 'made_by_id' ]);
            $table->dropColumn('made_by_id');

            $table->dropForeign([ 'department_id' ]);
            $table->dropColumn('department_id');
        });
    }
}
