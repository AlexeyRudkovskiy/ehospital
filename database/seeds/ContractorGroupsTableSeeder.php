<?php

use Illuminate\Database\Seeder;

class ContractorGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ContractorGroup::class)->create();
    }
}
