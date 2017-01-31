<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Manufacturer::create([ 'name' => 'Manufacturer #1' ]);
        \App\Manufacturer::create([ 'name' => 'Manufacturer #2' ]);
        \App\Manufacturer::create([ 'name' => 'Manufacturer #3' ]);
        \App\Manufacturer::create([ 'name' => 'Manufacturer #4' ]);
        \App\Manufacturer::create([ 'name' => 'Manufacturer #5' ]);
    }
}
