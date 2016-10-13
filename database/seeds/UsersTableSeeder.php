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
        $user->regenerateApiToken();
        $user->save();

        $user2 = factory(\App\User::class)->make();
        $user2->regenerateApiToken();
        $user2->save();
    }
}
