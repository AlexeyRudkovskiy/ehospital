<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Country::truncate();
        $countries = collect(['Украина', 'Польша']);

        $countries->each(function ($item) {
            $country = new \App\Country([
                'name' => $item
            ]);
            $country->save();
        });
    }
}
