<?php

use Illuminate\Database\Seeder;

class ContractorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Contractor::truncate();
        factory(\App\Contractor::class, 30)->create();
    }
}
