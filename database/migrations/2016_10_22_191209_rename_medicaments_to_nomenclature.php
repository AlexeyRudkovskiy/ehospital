<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMedicamentsToNomenclature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::rename('medicaments', 'nomenclatures');

        Schema::table('medicament_batches', function (Blueprint $table) {
            $table->dropForeign(['medicament_id']);
            $table->renameColumn('medicament_id', 'nomenclature_id');
            $table->foreign('nomenclature_id')->references('id')->on('nomenclatures')->onDelete('cascade');
        });
        Schema::rename('medicament_batches', 'nomenclature_batches');

        Schema::table('medicament_histories', function (Blueprint $table) {
            $table->dropForeign(['medicament_id']);
            $table->dropForeign(['medicament_batch_id']);
            $table->renameColumn('medicament_id', 'nomenclature_id');
            $table->renameColumn('medicament_batch_id', 'nomenclature_batch_id');
            $table->foreign('nomenclature_id')->references('id')->on('nomenclatures')->onDelete('cascade');
            $table->foreign('nomenclature_batch_id')->references('id')->on('nomenclature_batches')->onDelete('cascade');
        });
        Schema::rename('medicament_histories', 'nomenclature_histories');

        Schema::table('calendar_day_medicament', function (Blueprint $table) {
            $table->dropForeign(['medicament_id']);
            $table->dropForeign(['medicament_history_id']);
            $table->renameColumn('medicament_id', 'nomenclature_id');
            $table->renameColumn('medicament_history_id', 'nomenclature_history_id');
            $table->foreign('nomenclature_id')->references('id')->on('nomenclatures')->onDelete('cascade');
            $table->foreign('nomenclature_history_id')->references('id')->on('nomenclature_histories')->onDelete('cascade');
        });
        Schema::rename('calendar_day_medicament', 'calendar_day_nomenclature');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::rename('nomenclatures', 'medicaments');

        Schema::table('nomenclature_batches', function (Blueprint $table) {
            $table->dropForeign(['nomenclature_id']);
            $table->renameColumn('nomenclature_id', 'medicament_id');
            $table->foreign('medicament_id')->references('id')->on('medicaments')->onDelete('cascade');
        });
        Schema::rename('nomenclature_batches', 'medicament_batches');

        Schema::table('nomenclature_histories', function (Blueprint $table) {
            $table->dropForeign(['nomenclature_id']);
            $table->dropForeign(['nomenclature_batch_id']);
            $table->renameColumn('nomenclature_id', 'medicament_id');
            $table->renameColumn('nomenclature_batch_id', 'medicament_batch_id');
            $table->foreign('medicament_id')->references('id')->on('medicaments')->onDelete('cascade');
            $table->foreign('medicament_batch_id')->references('id')->on('medicaments_batches')->onDelete('cascade');
        });
        Schema::rename('nomenclature_histories', 'medicament_histories');

        Schema::table('calendar_day_nomenclature', function (Blueprint $table) {
            $table->dropForeign(['nomenclature_id']);
            $table->dropForeign(['nomenclature_history_id']);
            $table->renameColumn('nomenclature_id', 'medicament_id');
            $table->renameColumn('nomenclature_history_id', 'medicament_history_id');
            $table->foreign('medicament_id')->references('id')->on('medicaments')->onDelete('cascade');
            $table->foreign('medicament_history_id')->references('id')->on('medicament_histories')->onDelete('cascade');
        });
        Schema::rename('calendar_day_nomenclature', 'calendar_day_medicament');
    }
}
