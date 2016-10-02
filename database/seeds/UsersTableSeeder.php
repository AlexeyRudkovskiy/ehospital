<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->make();
        $user->email = 'test@test.test';
        $user->password = 'password';
        $user->save();

        factory(\App\User::class)->create();
    }
}
