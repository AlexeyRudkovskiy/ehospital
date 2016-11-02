<?php

use Illuminate\Database\Seeder;

class StoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Storage::truncate();

        factory(\App\Storage::class, 5)->create();
    }

}
