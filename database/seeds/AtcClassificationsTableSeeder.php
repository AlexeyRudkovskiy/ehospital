<?php

use Illuminate\Database\Seeder;

class AtcClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AtcClassification::create([
            'name_ua' => 'Classification #1',
            'name_en' => 'Classification #1',
            'parent_id' => null
        ]);

        \App\AtcClassification::create([
            'name_ua' => 'Classification #2',
            'name_en' => 'Classification #2',
            'parent_id' => null
        ]);
    }
}
