<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserPosition::truncate();

        $doctor = new \App\UserPosition;
        $doctor->name = 'Врач';
        $doctor->save();

        $headNurse = new \App\UserPosition;
        $headNurse->name = 'Старшая медсестра';
        $headNurse->save();
    }
}
