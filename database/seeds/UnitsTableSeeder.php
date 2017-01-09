<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Unit::truncate();

        $unit = new \App\Unit();
        $unit->text = 'Упаковка';
        $unit->scale = 1;
        $unit->save();

        $unit2 = new \App\Unit();
        $unit2->text = 'Таблетка';
        $unit2->scale = 10;
        $unit2->unit_id = $unit->id;
        $unit2->save();
    }
}
