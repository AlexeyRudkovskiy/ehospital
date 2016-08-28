<?php

use Illuminate\Database\Seeder;

class MedicamentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicament = factory(\App\Medicament::class)->create();
    }

}
