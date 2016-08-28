<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Patient::class, 50)->create()->each(function (\App\Patient $patient) {
            $patient->addresses()->create(factory(\App\Address::class)->make()->toArray());

            $cure = $patient->cures()->create([
                'department_id' => \App\Department::inRandomOrder()->get()->first()->id
            ]);
        });
    }
}
