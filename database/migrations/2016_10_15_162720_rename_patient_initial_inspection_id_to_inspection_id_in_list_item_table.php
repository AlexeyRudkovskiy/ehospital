<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePatientInitialInspectionIdToInspectionIdInListItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_items', function (Blueprint $table) {
            $table->renameColumn('patient_initial_inspection_id', 'inspection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_items', function (Blueprint $table) {
            $table->renameColumn('inspection_id', 'patient_initial_inspection_id');
        });
    }
}
