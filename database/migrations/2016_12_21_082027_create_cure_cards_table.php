<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCureCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cure_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('hospitalization_date');
            $table->char('gender', 1);

            $table->string('patient_full_name');
            $table->date('birthday');
            $table->enum('identification_document', [ 'passport' ]);
            $table->string('id_document_number');

            $table->integer('country_code');
            $table->char('place_of_residence', 1);
            $table->string('region');
            $table->string('street_and_house');

            $table->string('work_address');

            // начиная с 9-го пункта

            // те, которых сдесь нет, беруться или из БД или автоматически вычисляются в ходе лечения
            $table->char('hospitalization_type', 1);
            $table->tinyInteger('readmission', false, true)->default(1);
            $table->tinyInteger('readmission_30_days', false, true)->default(2);

            // начиная с 22-го

            $table->tinyInteger('complication_of_primary_diagnosis', false, true)->default(1);
            $table->tinyInteger('resistance', false, true)->default(1);

            $table->integer('cure_id', false, true);

            $table->timestamps();

            $table->foreign('cure_id')->references('id')->on('cures');
        });

        Schema::table('cures', function (Blueprint $table) {
            $table->integer('cure_card_id', false, true)->nullable()->default(null);
            $table->foreign('cure_card_id')->references('id')->on('cure_cards');
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
            $table->dropForeign(['cure_card_id']);
            $table->dropColumn('cure_card_id');
        });

        Schema::dropIfExists('cure_cards');
    }
}
