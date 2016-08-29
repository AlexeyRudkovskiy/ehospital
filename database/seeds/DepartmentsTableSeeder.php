<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Department::class, 10)->create()->each(function (\App\Department $department) {
            $department->leader()->associate(\App\User::inRandomOrder()->get()->first());
        });
    }
}
