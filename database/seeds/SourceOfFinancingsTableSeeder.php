<?php

use Illuminate\Database\Seeder;

class SourceOfFinancingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SourceOfFinancing::truncate();

        $sourceOfFinanctings = [
            'Благотворительность',
            'Бюджет',
            'Гуманитарная помощь'
        ];

        collect($sourceOfFinanctings)->each(function (string $item) {
            \App\SourceOfFinancing::create([
                'name' => $item
            ]);
        });
    }
}
