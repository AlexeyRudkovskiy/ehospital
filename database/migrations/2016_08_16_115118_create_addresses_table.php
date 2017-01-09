<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('country');                  // город
            $table->string('region');                   // область
            $table->string('city');                     // город
            $table->string('street');                   // улица
            $table->string('house_number');             // номер дома
            $table->string('apartment', 10)->nullable();    // квартира

            $table->morphs('addressable', 'addressable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
