<?php

use Illuminate\Database\Seeder;

class NomenclaturesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomenclature = factory(\App\Nomenclature::class)->create();
    }

}
